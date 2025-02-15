<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::simplePaginate(10);
        return view('admin.enrollment_dashboard', compact('enrollments'));
    }
}
