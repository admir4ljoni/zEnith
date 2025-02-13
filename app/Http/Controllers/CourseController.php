<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('home.courses');
    }

    public function show()
    {
        return view('home.course_detail');
    }

    public function create()
    {
        return view('admin.create_course');
    }
}
