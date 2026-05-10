<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InstructorDashboardController extends Controller
{
    function index()
    {
        return view('frontend.instructor.dashboard.main.index');
    }

    function switchToStudent()
    {
        $user = user();
        $user->role = 'student';
        $user->save();

        return redirect()->route('student.dashboard.index');
    }
}
