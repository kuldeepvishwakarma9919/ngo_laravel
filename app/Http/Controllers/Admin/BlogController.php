<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class BlogController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:blog_view', only: ['index']),
            new Middleware('permission:blog_add', only: ['create', 'store']),
            new Middleware('permission:blog_edit', only: ['status', 'edit', 'update']),
            new Middleware('permission:blog_delete', only: ['destroy']),
        ];
    }

    public function index()
    {
        $query = Blog::with('blog_categories');
        if (request()->filled('search')) {
            $query->where('title', 'like', '%' . request()->search . '%');
        }

        if (request()->filled('from_date')) {
            $query->whereDate('created_at', '>=', request()->from_date);
        }

        if (request()->filled('to_date')) {
            $query->whereDate('created_at', '<=', request()->to_date);
        }

        if (request()->filled('status')) {
            $query->where('status', request()->status);
        }

        $blogs = $query->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.blogs.index', compact('blogs'));
    }



    /* ================= CREATE ================= */
    public function create()
    {
        $categories = BlogCategory::where('is_active', 1)->get();
        return view('admin.blogs.create', compact('categories'));
    }

    /* ================= STORE ================= */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:image,video',
            'file'        => 'required',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        /* IMAGE / VIDEO UPLOAD */
        if ($request->type == 'image' && $request->hasFile('file')) {
            $image = $request->file('file');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $name);
            $data['featured_image'] = $name;
        }

        if ($request->type == 'video') {
            $data['video_url'] = $request->file;
        }

        Blog::create($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog created successfully');
    }

    /* ================= EDIT ================= */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        $categories = BlogCategory::where('is_active', 1)->get();
        return view('admin.blogs.edit', compact('blog', 'categories'));
    }

    /* ================= UPDATE ================= */
    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'category_id' => 'required',
            'title'       => 'required|string|max:255',
            'type'        => 'required|in:image,video',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        /* IMAGE UPDATE */
        if ($request->type == 'image' && $request->hasFile('file')) {
            if ($blog->featured_image && file_exists(public_path('uploads/blogs/' . $blog->featured_image))) {
                unlink(public_path('uploads/blogs/' . $blog->featured_image));
            }

            $image = $request->file('file');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blogs'), $name);
            $data['featured_image'] = $name;
            $data['video_url'] = null;
        }

        /* VIDEO UPDATE */
        if ($request->type == 'video') {
            $data['video_url'] = $request->file;
            $data['featured_image'] = null;
        }

        $blog->update($data);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog updated successfully');
    }

    /* ================= DELETE ================= */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);

        if ($blog->featured_image && file_exists(public_path('uploads/blogs/' . $blog->featured_image))) {
            unlink(public_path('uploads/blogs/' . $blog->featured_image));
        }

        $blog->delete();

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog deleted successfully');
    }
}
