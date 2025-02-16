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
        return view('admin.lesson_create_edit', compact('course_id'));
    }

    public function store($course_id, Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'order' => ['required', 'integer'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
        ]);

        $lesson = Lesson::create($data);
        return redirect()->route('admin.course.lesson.edit', [$course_id, $lesson->course_id])->with('success', 'Lesson created successfully');
    }

    public function update($course_id, $id, Request $request) {
        $lesson = Lesson::findOrFail($id);
        $data = $request->validate([
            'title' => ['string', 'max:255'],
            'content' => ['string'],
            'order' => ['required', 'integer'],
            'course_id' => ['required', 'integer', 'exists:courses,id'],
        ]);
        $lesson->update($data);

        return redirect()->back()->with('success', 'Lesson updated successfully');
    }

    public function destroy($course_id, $id) {
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
    }
}
