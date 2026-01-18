<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventController extends Controller
{
    public function index()
    {
        $query = Event::query();

        if (request()->filled('search')) {
            $query->where(function ($q) {
                $search = request('search');
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('location', 'like', '%' . $search . '%');
            });
        }

        if (request()->filled('from_date')) {
            $query->whereDate('event_date', '>=', request('from_date'));
        }

        if (request()->filled('to_date')) {
            $query->whereDate('event_date', '<=', request('to_date'));
        }

        if (request()->filled('status')) {
            if (request('status') == 1) {
                $query->where('status', 'active');
            } elseif (request('status') == 0) {
                $query->where('status', 'closed');
            }
        }

        $events = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.events.index', compact('events'));
    }
    public function create()
    {
        $events = Event::all();
        return view('admin.events.create', compact('events'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'location'    => 'required|string|max:255',
            'description' => 'required',
            'status'      => 'required|in:active,inactive',
            'file'        => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        $imageName = null;
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/events'), $imageName);
        }
        Event::create([
            'title'       => $request->title,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $imageName,
        ]);

        return redirect()->route('admin.events.index')->with('success', 'Event added successfully');
    }



    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'event_date'  => 'required|date',
            'location'    => 'required|string|max:255',
            'description' => 'required',
            'status'      => 'required|in:active,inactive',
            'file'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = $event->image;
        if ($request->hasFile('file')) {
            if ($event->image && file_exists(public_path('uploads/events/' . $event->image))) {
                unlink(public_path('uploads/events/' . $event->image));
            }

            $image = $request->file('file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/events'), $imageName);
        }

        $event->update([
            'title'       => $request->title,
            'event_date'  => $request->event_date,
            'location'    => $request->location,
            'description' => $request->description,
            'status'      => $request->status,
            'image'       => $imageName,
        ]);

        return redirect()->route('admin.events.index')
            ->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        if ($event->image && file_exists(public_path('uploads/events/' . $event->image))) {
            unlink(public_path('uploads/events/' . $event->image));
        }

        $event->delete();

        return redirect()->route('admin.events.index')
            ->with('success', 'Event deleted successfully');
    }




    public function registrations(Request $request)
    {
        $query = DB::table('event_registrations')
            ->join('events', 'event_registrations.event_id', '=', 'events.id')
            ->select(
                'event_registrations.*',
                'events.title as event_title',
                'events.status as event_status', // active / closed
                'events.event_date'
            );

        // Search by event title
        if ($request->search) {
            $query->where('events.title', 'like', '%' . $request->search . '%');
        }

        // From Date
        if ($request->from_date) {
            $query->whereDate('event_registrations.created_at', '>=', $request->from_date);
        }

        // To Date
        if ($request->to_date) {
            $query->whereDate('event_registrations.created_at', '<=', $request->to_date);
        }

        // Filter by Status (Paid / Unpaid)
        if ($request->status !== null && $request->status !== '') {
            $query->where('event_registrations.status', $request->status);
        }

        // Pagination (10 per page)
        $registrations = $query->orderBy('event_registrations.id', 'desc')->paginate(10)->withQueryString();

        return view('admin.events.registrations', compact('registrations'));
    }



    public function exportCSV()
    {
        $fileName = 'event_registrations.csv';

        $registrations = DB::table('event_registrations')
            ->join('events', 'event_registrations.event_id', '=', 'events.id')
            ->select(
                'events.title',
                'event_registrations.name',
                'event_registrations.mobile',
                'event_registrations.email',
                'event_registrations.city',
                'event_registrations.participants',
                // 'event_registrations.amount',
                // 'event_registrations.payment_status',
                'event_registrations.created_at'
            )
            ->get();

        $headers = [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        ];

        $callback = function () use ($registrations) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Event',
                'Name',
                'Mobile',
                'Email',
                'City',
                'Participants',
                // 'Amount',
                // 'Payment Status',
                'Date'
            ]);

            foreach ($registrations as $row) {
                fputcsv($file, [
                    $row->title,
                    $row->name,
                    $row->mobile,
                    $row->email,
                    $row->city,
                    $row->participants,
                    // $row->amount,
                    // $row->payment_status,
                    date('d-m-Y', strtotime($row->created_at))
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
