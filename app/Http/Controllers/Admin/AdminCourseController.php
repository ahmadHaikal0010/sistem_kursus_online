<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use Exception;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;

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
            'thumbnail' => 'required|image|mimes:jpg,jpeg,png|max:2048'
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

    // menampilkan form edit
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $categories = Category::all();

        return view('admin.courses.edit', compact('course', 'categories'));
    }

    // update data
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:haikal_categories,id',
            'description' => 'required|string',
            'thumbnail' => 'nullable|image|mimes::jpg,jpeg,png|max:2048'
        ]);

        $data = $request->only('title', 'category_id', 'description');

        if ($request->hasFile('thumbnail')) {
            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $course->update($data);

        return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil diperbarui.');
    }

    // menghapus data
    public function destroy($id)
    {
        try {
            $course = Course::findOrFail($id);

            $course->delete();

            if ($course->thumbnail && Storage::disk('public')->exists($course->thumbnail)) {
                Storage::disk('public')->delete($course->thumbnail);
            }

            return redirect()->route('admin.courses.index')->with('success', 'Kursus berhasil dihapus.');
        } catch (QueryException $e) {
            // cek error code mysql
            $errorCode = $e->errorInfo[1] ?? null;

            if ($errorCode == 1451 || $errorCode == 1452 || $errorCode == '23503' || $errorCode == 19) {
                return redirect()->route('admin.courses.index')->with('info', 'Kursus tidak dapat dihapus karena masih terkait dengan data lain (misalnya, ada siswa yang terdaftar di kursus ini atau ada materi yang belum dihapus).');
            }

            // jika terjadi error yang lain
            return redirect()->route('admin.courses.index')->with('error', 'Terjadi kesalahan saat menghapus kursus.');
        } catch (Exception $e) {
            return redirect()->route('admin.courses.index')->with('error', 'Terjadi kesalahan tidak terduga saat menghapus kursus.');
        }
    }
}
