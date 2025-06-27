<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;

class AdminMaterialController extends Controller
{
    // list materi
    public function index(Course $course)
    {
        $materials = $course->materials()->latest()->paginate(10);
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
            'video_file' => 'nullable|required_if:type,video|file|mimes:mp4|max:51200', // max 50MB
            'video_link' => 'nullable|required_if:type,link|url',
        ]);

        $data = [
            'title' => $request->title,
            'type' => $request->type,
            'content' => $request->type === 'text' ? $request->content : null,
            'video_link' => $request->type === 'link' ? $request->video_link : null,
        ];

        if ($request->type === 'video' && $request->hasFile('video_file')) {
            $data['video_path'] = $request->file('video_file')->store('videos', 'public');
        }

        $course->materials()->create($data);

        return redirect()->route('admin.courses.materials.index', $course->id)
            ->with('success', 'Materi berhasil ditambahkan!');
    }

    public function show(Course $course, Material $material)
    {
        abort_unless($material->course_id === $course->id, 404);
        return view('admin.materials.show', compact('course', 'material'));
    }

    public function edit(Course $course, Material $material)
    {
        abort_unless($material->course_id === $course->id, 404);
        return view('admin.materials.edit', compact('course', 'material'));
    }

    public function update(Request $request, Course $course, Material $material)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:text,video,link',
            'content' => 'nullable|required_if:type,text|string',
            'video_file' => 'nullable|required_if:type,video|file|mimes:mp4|max:51200',
            'video_link' => 'nullable|required_if:type,link|url'
        ]);

        $material->title = $request->title;
        $material->type = $request->type;
        $material->content = $request->type === 'text' ? $request->content : null;
        $material->video_link = $request->type === 'link' ? $request->video_link : null;

        if ($request->type === 'video' && $request->hasFile('video_file')) {
            // hapus video lama
            if ($material->video_path && \Storage::disk('public')->exists($material->video_path)) {
                \Storage::disk('public')->delete($material->video_path);
            }
            $material->video_path = $request->file('video_file')->store('videos', 'public');
        }

        $material->save();

        return redirect()->route('admin.courses.materials.index', $course->id)->with('success', 'Materi berhasil diperbarui!');
    }
}
