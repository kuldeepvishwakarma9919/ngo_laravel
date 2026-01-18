<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class GalleryController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:gallery_view', only: ['index']),
            new Middleware('permission:gallery_add', only: ['create', 'store']),
            new Middleware('permission:gallery_edit', only: ['status', 'edit', 'update']),
            new Middleware('permission:gallery_delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $query = Gallery::query();
        if (request()->filled('search')) {
            $query->where(function ($q) {
                $search = request()->search;
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%');
            });
        }

        if (request()->filled('from_date')) {
            $query->whereDate('created_at', '>=', request()->from_date);
        }

        if (request()->filled('to_date')) {
            $query->whereDate('created_at', '<=', request()->to_date);
        }

        if (request()->filled('status')) {
            $status = request()->status == 1 ? 'active' : 'inactive';
            $query->where('status', $status);
        }

        $galleries = $query->latest()->paginate(3)->withQueryString();

        return view('admin.gallery.index', compact('galleries'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type'  => 'required|in:image,video',
            'file'  => 'required|mimes:jpg,jpeg,png,webp,mp4,mov,avi|max:10240',
        ]);

        // Upload file
        $fileName = time() . '_' . $request->file->getClientOriginalName();
        $request->file->move(public_path('uploads/gallery'), $fileName);

        Gallery::create([
            'title'       => $request->title,
            'type'        => $request->type,
            'file_path'   => 'uploads/gallery/' . $fileName,
            'description' => $request->description,
            'status'      => $request->status,
        ]);

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // File delete
        if ($gallery->file_path && file_exists(public_path($gallery->file_path))) {
            unlink(public_path($gallery->file_path));
        }

        // Record delete
        $gallery->delete();

        return redirect()->route('admin.gallery.index')
            ->with('success', 'Gallery deleted successfully');
    }


    public function status($id)
    {
        $gallery = Gallery::findOrFail($id);

        $gallery->status = $gallery->status === 'active' ? 'inactive' : 'active';
        $gallery->save();

        return redirect()->back()->with('success', 'Status updated successfully');
    }
}
