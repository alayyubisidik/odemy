<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Course;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $dailyOrder = Order::whereDate(
            'created_at',
            Carbon::today()
        )->sum('total_amount');

        $weeklyOrder = Order::whereBetween(
            'created_at',
            [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]
        )->sum('total_amount');

        $monthlyOrder = Order::whereMonth(
            'created_at',
            Carbon::now()->month
        )->whereYear(
            'created_at',
            Carbon::now()->year
        )->sum('total_amount');

        $yearlyOrder = Order::whereYear(
            'created_at',
            Carbon::now()->year
        )->sum('total_amount');

        $totalOrders = Order::count();

        $pendingCourses = Course::where(
            'is_approved',
            'pending'
        )->count();

        $rejectedCourses = Course::where(
            'is_approved',
            'rejected'
        )->count();

        $totalCourses = Course::where(
            'is_approved',
            'approved'
        )->count();

        $monthlyOrderSums = [];
        $monthlyOrderCounts = [];

        for ($month = 1; $month <= 12; $month++) {
            $monthlyOrderSums[] = Order::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total_amount');

            $monthlyOrderCounts[] = Order::whereMonth('created_at', $month)
                ->whereYear('created_at', Carbon::now()->year)
                ->count();
        }

        $recentCourses = Course::latest()->take(5)->get();

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        $recentBlogs = Blog::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact(
            'dailyOrder',
            'weeklyOrder',
            'monthlyOrder',
            'yearlyOrder',
            'totalOrders',
            'pendingCourses',
            'rejectedCourses',
            'totalCourses',
            'monthlyOrderSums',
            'monthlyOrderCounts',
            'recentBlogs',
            'recentCourses',
            'recentOrders'
        ));
    }
}
