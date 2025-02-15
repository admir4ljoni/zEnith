<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        if (request()->is('/courses')) {
            return view('home.courses');
        }

        if (request()->is('dashboard')) {
            return view('admin.dashboard');
        }

        return view('home.courses');
    }


    public function show()
    {
        return view('home.course_detail');
    }

    public function create()
    {
        return view('admin.course_create');
    }

    public function edit()
    {
        return view('admin.course_edit');
    }
}
