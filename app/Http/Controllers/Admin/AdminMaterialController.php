<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminMaterialController extends Controller
{
    // list materi
    public function index(Course $course)
    {
        $materials = $course->materials;
        return view('admin.materials.index', compact('course', 'materials'));
    }

    // menampilkan form tambah materi
    public function create(Course $course)
    {
        return view('admin.materials.create', compact('course'));
    }

    // fungsi menambah materi
    public function store(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,video,link',
            'content' => 'nullable|required_if:type,text|string',
            'video_path' => 'nullable|required_if:type,video|file|mimes:mp4|max:102400',
            'video_link' => 'nullable|required_if:type,link|url'
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'content' => $request->type === 'text' ? $request->content : null,
            'video_link' => $request->type === 'link' ? $request->video_link : null
        ];

        if ($request->type === 'video' && $request->hasFile('video_path')) {
            $data['video_path'] = $request->file('video_path')->store('videos', 'public');
        }

        $course->materials()->create($data);

        return redirect()->route('admin.courses.materials.index', $course->id)->with('success', 'Materi berhasil ditambahkan!');
    }
}
