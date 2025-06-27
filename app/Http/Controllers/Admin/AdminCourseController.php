<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;

class AdminCourseController extends Controller
{
    // daftar kursus
    public function index()
    {
        $courses = Course::with('category')->latest()->paginate(10);
        return view('admin.courses.index', compact('courses'));
    }

    // form tambah kursus
    public function create()
    {
        $categories = Category::all();
        return view('admin.courses.create', compact('categories'));
    }

    // fungsi untuk menyimpan data
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:haikal_categories,id',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only('title', 'category_id', 'description');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        Course::create($data);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil ditambahkan!');
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
    public function destroy(string $id)
    {
        //
    }
}
