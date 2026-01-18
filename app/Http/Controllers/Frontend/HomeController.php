<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Event;
use App\Models\Member;
use Illuminate\Support\Facades\Cache;
use App\Models\Gallery;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        $events = Event::where('status', 'active')->orderBy('event_date', 'desc')->take(3)->get(); 
        $galleries = Gallery::orderBy('created_at', 'desc')->take(3)->get();
        return view('home.index', compact('galleries', 'events'));
    }

    public function about()
    {

        return view('home.about');
    }

    public function contact()
    {
        return view('home.contact');
    }

    public function member_apply()
    {
        return view('home.member_apply');
    }

    public function download_card()
    {
        return view('home.download_card');
    }

    public function verifications()
    {
        return view('home.verifications');
    }


    public function donate()
    {
        return view('home.donates');
    }

    public function crowdfunding()
    {
        $campaigns = Campaign::where('status', 'active')->get();
        return view('home.crowdfunding', compact('campaigns'));
    }

    public function gallery()
    {
        $galleries = Cache::remember('gallery_list', now()->addMinutes(15), function () {
            return Gallery::where('status', 'active')
                ->orderBy('id', 'desc')
                ->get();
        });
        return view('home.gallery', compact('galleries'));
    }

    public function audit_report()
    {
        return view('home.audit_report');
    }
    public function contact_submit(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:100',
            'email'   => 'required|email',
            'phone'   => 'required|digits_between:10,12',
            'subject' => 'required|string|max:150',
            'message' => 'required|string|max:500',
        ]);
        $cacheKey = 'contact_submit_' . md5($request->email . $request->phone);
        if (Cache::has($cacheKey)) {
            return back()->with('error', 'Please wait before submitting again.');
        }
        Contact::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);
        Cache::put($cacheKey, true, now()->addMinutes(2));

        return back()->with('success', 'Your message has been sent successfully!');
    }





    public function verifyMember(Request $request)
    {
        $memberId = $request->member_id;

        $member = Cache::remember(
            'verified_member_' . $memberId,
            now()->addMinutes(30), // cache time
            function () use ($memberId) {
                return Member::with('user')
                    ->where('id_card_no', $memberId)
                    ->where('status', 1)
                    ->first();
            }
        );

        if ($member) {
            return response()->json([
                'status' => true,
                'data' => [
                    'id'    => $member->id_card_no,
                    'name'  => $member->user->name ?? null,
                    'role'  => $member->occupation,
                    'photo' => asset('storage/' . $member->photo),
                ]
            ]);
        }

        return response()->json([
            'status' => false
        ]);
    }


    public function upcomming_event()
    {
        $events = DB::table('events')
            ->where('status', 'active')
            ->whereDate('event_date', '>=', Carbon::today())
            ->orderBy('event_date', 'asc')
            ->get();

        return view('upcomming_event', compact('events'));
    }


    public function event_detail($id)
    {
        $event = DB::table('events')->where('id', $id)->first();
        $sideEvents = DB::table('events')
            ->where('id', '!=', $id)
            ->orderBy('event_date', 'asc')
            ->limit(5)
            ->get();
        return view('event_detail', compact('event', 'sideEvents'));
    }

    public function store_event_registration(Request $request)
    {
        DB::table('event_registrations')->insert([
            'event_id' => $request->event_id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'city' => $request->city,
            'participants' => $request->participants,
            'status' => 'pending',
            'created_at' => now()
        ]);

        return redirect()->back()->with('success', 'Registration Successful');
    }


    public function team_member()
    {
        $members = Member::with('user.role')
            ->where('status', 1)
            ->whereHas('user.role', function ($q) {
                $q->where('name', 'Member');
            })
            ->get();

        return view('team_member', compact('members'));
    }
}
