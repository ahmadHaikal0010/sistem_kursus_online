<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalCourses = Course::count();
        $totalUsers = User::count();
        $totalEnrollments = DB::table('haikal_course_user')->count();
        $totalMaterials = Material::count();

        // Ambil data enroll per bulan selama 6 bulan terakhir
        $enrollments = DB::table('haikal_course_user')
            ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->where('created_at', '>=', now()->subMonths(6)->startOfMonth())
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('total', 'month');

        // Siapkan data untuk Chart.js
        $months = collect(range(1, 6))->map(function ($i) {
            return Carbon::now()->subMonths(6 - $i)->format('M');
        });

        $chartLabels = $months->values();

        $chartData = $months->map(function ($label, $i) use ($enrollments) {
            $monthNumber = Carbon::now()->subMonths(6 - $i)->format('n'); // 1-12
            return $enrollments[$monthNumber] ?? 0;
        });

        return view('admin.dashboard', compact(
            'totalCourses',
            'totalUsers',
            'totalEnrollments',
            'totalMaterials',
            'chartLabels',
            'chartData'
        ));
    }
}
