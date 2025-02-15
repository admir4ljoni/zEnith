<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        if (request()->is('/')) {
            return view('home.homepage');
        }

        if (request()->is('admin/users')) {
            $users = User::paginate(10);
            return view('admin.user_dashboard', compact('users'));
        }

        return view('home.homepage');
    }

    public function create()
    {
        return view('admin.user_create_edit');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
            'role' => ['nullable', 'in:admin,instructor,student']
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role ?? 'student',
        ]);
        if ($request->hasFile('profile_picture')) {
            $fileName = Str::random(20) . '.' . $request->file('profile_picture')->getClientOriginalExtension();
            $picturePath = $request->file('profile_picture')
                ->storeAs("users/profile_picture/{$user->id}", $fileName, 'public');
            $user->profile_picture = $picturePath;
            $user->save();
        }

        return redirect()->route('admin.user.index');
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        return view ('admin.user_create_edit', compact('user'));
    }
}
