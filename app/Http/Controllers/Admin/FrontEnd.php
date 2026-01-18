<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;

class FrontEnd extends Controller
{
    public function about()
    {
        // Pehla record uthayega, agar nahi hai toh empty object bhejega
        $about = About::first();
        return view('admin.frontend.about', compact('about'));
    }

    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable',
            'banner_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
            'about_image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        // updateOrCreate() function use karein
        $about = About::updateOrCreate(
            ['id' => $request->id], // Is ID se check karega (agar id null hai toh naya banayega)
            $request->except(['_token', 'banner_image', 'about_image'])
        );

        // Image Handling
        if ($request->hasFile('banner_image')) {
            $about->banner_image = $request->file('banner_image')->store('uploads/about', 'public');
        }
        if ($request->hasFile('about_image')) {
            $about->about_image = $request->file('about_image')->store('uploads/about', 'public');
        }

        $about->save();

        return back()->with('success', 'About Us updated successfully!');
    }
}
