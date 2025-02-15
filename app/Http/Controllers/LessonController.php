<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function edit()
    {
        return view('admin.lesson_create_edit');
    }
}
