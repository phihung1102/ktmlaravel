<?php

namespace App\Http\Controllers;

use App\Models\Slide;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::all();
        return view('admin.slides.slide_list', compact('slides'));
    }

    public function create()
    {
        return view('admin.slides.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $image = $request->file('image');
        $imageName = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('images'), $imageName);
        $path = $imageName;

        Slide::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'image' => $path,
            'status' => $request->has('status'),
        ]);

        return redirect()->route('admin.slides.index')->with('success', 'Thêm slide thành công');
    }


    public function edit(Slide $slide)
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, Slide $slide)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif',
        ]);
        

        $data = $request->only(['title', 'description', 'link']);
        $data['status'] = $request->has('status');

        if ($request->hasFile('image')) {
            if ($slide->image && file_exists(public_path($slide->image))) {
                unlink(public_path($slide->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $slide->update($data);

        return redirect()->route('admin.slides.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy(Slide $slide)
    {
        Storage::disk('public')->delete($slide->image);
        $slide->delete();
        return redirect()->route('admin.slides.index')->with('success', 'Xóa thành công');
    }
}

