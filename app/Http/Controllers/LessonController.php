<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function edit($course_id, $id = null)
    {
        if ($id) {
            $lesson = Lesson::findOrFail($id);
            return view('admin.lesson_create_edit', compact(['lesson', 'course_id']));
        }
        return view('admin.lesson_create_edit');
    }
}
