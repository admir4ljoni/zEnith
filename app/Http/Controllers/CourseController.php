<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    public function index()
    {
        if (request()->is('/courses')) {
            return view('home.courses');
        }

        if (request()->is('dashboard')) {
            $courses = Course::simplePaginate(10);
            return view('admin.dashboard', compact('courses'));
        }

        return view('home.courses');
    }


    public function show()
    {
        return view('home.course_detail');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric'],
            'course_picture' => ['nullable', 'mimes:jpg,jpeg,png', 'max:4096'],
            'status' => ['required', 'in:draft,published,archived,awaiting'],
            'category_id' => ['required', 'exists:categories,id'],
            'instructor_id' => ['required', 'exists:users,id'],
        ]);

        $course = Course::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'price' => $data['price'],
            'status' => $data['status'],
            'category_id' => $data['category_id'],
            'instructor_id' => $data['instructor_id'],
        ]);

        if ($request->hasFile('course_picture')) {
            $fileName = Str::random(20) . '.' . $request->file('course_picture')->getClientOriginalExtension();
            $picturePath = $request->file('course_picture')->storeAs("courses/picture/{$course->id}", $fileName, 'public');
            $course->course_picture = $picturePath;
            $course->save();
        }

        return redirect()->route('admin.course.edit', $course->id)->with('success', 'Course has been created. Please add lessons below');
    }

    public function edit($id = null)
    {
        $instructors = User::where('role', 'instructor')->get();
        $categories = Category::all();
        if ($id) {
            $course = Course::findOrFail($id);
            $lessons = $course->lessons;
            return view ('admin.course_create_edit', compact(['course', 'instructors', 'categories', 'lessons']));
        }
        return view('admin.course_create_edit', compact(['instructors', 'categories']));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $data = $request->validate([
            'title' => ['string', 'max:255'],
            'description' => ['string'],
            'price' => ['numeric'],
            'course_picture' => ['nullable', 'mimes:jpg,jpeg,png', 'max:4096'],
            'status' => ['in:draft,published,archived,awaiting'],
            'category_id' => ['required', 'exists:categories,id'],
            'instructor_id' => ['required', 'exists:users,id'],
        ]);

        if ($request->hasFile('course_picture')) {
            if ($course->course_picture) {
                Storage::disk('public')->delete($course->course_picture);
            }
            $fileName = Str::random(20) . '.' . $request->file('course_picture')->getClientOriginalExtension();
            $filePath = $request->course_picture
                ->storeAs("courses/picture/{$course->id}", $fileName, 'public');
            $data['course_picture'] = $filePath;
        }

        $course->update($data);
        return redirect()->route('admin.course.edit', $course->id)->with('success', 'Course has been updated.');
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->status = 'archived';
        $course->delete();

        return redirect('dashboard')->with('success', 'Course has been deleted');
    }
}
