<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Course & Lessons</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
<!-- Navigation -->
<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                    <!-- Dashboard link -->
                    <a href="/dashboard"
                       class="{{ request()->is('/admin/dashboard') ? 'border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700 border-transparent' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    <!-- Courses link -->
                    <a href="/admin/enrollments"
                       class="{{ request()->is('courses*') && !request()->is('admin/courses*') ? 'border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700 border-transparent' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Enrollments
                    </a>
                    <!-- Admin Courses link -->
                    <a href="/admin/users"
                       class="{{ request()->is('admin/courses*') ? 'border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700 border-transparent' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Users
                    </a>
                </div>
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <!-- Profile Dropdown for Authenticated Users -->
                <div class="ml-3 relative">
                    <button type="button" id="user-menu-button" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="h-8 w-8 rounded-full" src="{{ asset('images/sample1.jpg') }}" alt="User Profile">
                    </button>
                    <!-- Dropdown menu -->
                    <div id="profile-dropdown-menu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu">
                        <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                            Your Profile
                        </a>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100" role="menuitem">
                                Sign out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile menu button -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button type="button" id="mobile-menu-button" class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div class="hidden sm:hidden" id="mobile-menu">
        <div class="pt-2 pb-3 space-y-1">
            <a href="/dashboard"
               class="{{ request()->is('/dashboard') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Dashboard
            </a>
            <a href="/admin/enrollments"
               class="{{ request()->is('/admin/enrollments*') && !request()->is('admin/enrollments*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Enrollments
            </a>
            <a href="/admin/users"
               class="{{ request()->is('admin/users*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Users
            </a>
            <form method="POST" action="/logout" class="block">
                @csrf
                <button type="submit" class="w-full text-left block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 text-base font-medium">
                    Logout
                </button>
            </form>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="bg-indigo-500">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold text-white">Edit Course & Lessons</h1>
        <p class="mt-2 text-lg text-indigo-100">Update course details and manage its lessons below.</p>
    </div>
</header>

<!-- Main Content -->
<main class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
        <!-- Course Edit Form -->
        <section class="bg-white shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Course Details</h2>
            <!-- Static form UI with placeholders -->
            <form action="{{isset($course) ? route('admin.course.update', $course->id) : route('admin.course.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($course))
                    @method('PATCH')
                    <img class="mx-auto w-full max-w-4xl h-32 object-cover" src="{{isset($course->course_picture) ? Storage::url($course->course_picture) : asset('images/sample1.jpg')}}" alt="User Profile">
                    <!-- Course Title -->
                    <div class="mb-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Course Title</label>
                        <input value="{{$course->title ?? old('title')}}" type="text" id="title" name="title" placeholder="e.g., Introduction to Laravel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="description" name="description" rows="4" placeholder="Brief course overview..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{$course->description ?? old('description')}}</textarea>
                    </div>
                    <!-- Course Picture -->
                    <div class="mb-4">
                        <label for="course_picture" class="block text-sm font-medium text-gray-700">Course Picture</label>
                        <input type="file" id="course_picture" name="course_picture" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Price (USD)</label>
                        <input value="{{$course->price ?? old('price')}}" type="number" step="0.01" id="price" name="price" placeholder="e.g., 49.99" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <!-- Category -->
                    <div class="mb-4">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select required id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
{{--                            <option value="">-- Select Category --</option>--}}
{{--                            <option value="1">Programming</option>--}}
{{--                            <option value="2">Design</option>--}}
{{--                            <option value="3">Marketing</option>--}}
                            @forelse($categories as $category)
                                <option value="{{$category->id}}" {{ (isset($course) && $course->category_id === $category->id) || old('category_id') === $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                            @empty
                                <option>Empty Category</option>
                            @endforelse
                        </select>
                    </div>
                    <!-- Instructor -->
                    <div class="mb-4">
                        <label for="instructor_id" class="block text-sm font-medium text-gray-700">Instructor</label>
                        <select required id="instructor_id" name="instructor_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            @forelse($instructors as $instructor)
                                <option value={{$instructor->id}} {{ (isset($course) && $course->instructor_id === $instructor->id) || old('instructor_id') === $instructor->id ? 'selected' : '' }}>{{$instructor->name}}</option>
                            @empty
                                <option>No Instructors</option>
                            @endforelse
                        </select>
                    </div>
                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="draft" {{ (isset($course) && $course->status === 'draft') || old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ (isset($course) && $course->status === 'published') || old('status') === 'published' ? 'selected' : '' }}>Published</option>
                            <option value="archived" {{ (isset($course) && $course->status === 'archived') || old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                            <option value="awaiting" {{ (isset($course) && $course->status === 'awaiting') || old('status') === 'awaiting' ? 'selected' : '' }}>Awaiting</option>
                        </select>
                    </div>
                @else
                <img class="mx-auto w-full max-w-4xl h-32 object-cover" src="{{isset($user->profile_picture) ? Storage::url($user->profile_picture) : asset('images/sample1.jpg')}}" alt="User Profile">
                <!-- Course Title -->
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Course Title</label>
                    <input required type="text" id="title" name="title" placeholder="e.g., Introduction to Laravel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea required id="description" name="description" rows="4" placeholder="Brief course overview..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <!-- Course Picture -->
                <div class="mb-4">
                    <label for="course_picture" class="block text-sm font-medium text-gray-700">Course Picture</label>
                    <input type="file" id="course_picture" name="course_picture" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700">Price (USD)</label>
                    <input required type="number" step="0.01" id="price" name="price" placeholder="e.g., 49.99" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <!-- Category -->
                <div class="mb-4">
                    <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                    <select required id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @forelse($categories as $category)
                            <option value="{{$category->id}}" {{ (isset($course) && $course->category_id === $category->id) || old('category_id') === $category->id ? 'selected' : '' }}>{{$category->name}}</option>
                        @empty
                            <option>Empty Category</option>
                        @endforelse
                    </select>
                </div>
                <!-- Instructor -->
                <div class="mb-4">
                    <label for="instructor_id" class="block text-sm font-medium text-gray-700">Instructor</label>
                    <select required id="instructor_id" name="instructor_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        @forelse($instructors as $instructor)
                            <option value={{$instructor->id}} {{ (isset($course) && $course->instructor_id === $instructor->id) || old('instructor_id') === $instructor->id ? 'selected' : '' }}>{{$instructor->name}}</option>
                        @empty
                            <option>No Instructors</option>
                        @endforelse
                    </select>
                </div>
                <!-- Status -->
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select required id="status" name="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="draft" {{ (isset($course) && $course->status === 'draft') || old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ (isset($course) && $course->status === 'published') || old('status') === 'published' ? 'selected' : '' }}>Published</option>
                        <option value="archived" {{ (isset($course) && $course->status === 'archived') || old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                        <option value="awaiting" {{ (isset($course) && $course->status === 'awaiting') || old('status') === 'awaiting' ? 'selected' : '' }}>Awaiting</option>
                    </select>
                </div>
                @endif
                <!-- Submit Button for Course Update -->
                <div class="flex justify-end">
                    <button type="submit" onclick="openConfirmedModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Course
                    </button>
                </div>
            </form>
        </section>

        <!-- Lessons Management Section -->
        @if(isset($course))
            <section class="bg-white shadow rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-800">Lessons</h2>
                    <!-- Add Lesson Button -->
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Add Lesson
                    </button>
                </div>
                <!-- Lessons Table -->
                <table class="table-auto w-full">
                    <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 w-16 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px-4 py-2 w-3/6 text-left text-xs font-medium text-gray-500 uppercase">Lesson Title</th>
                        <th class="px-4 py-2 w-1/6 text-left text-xs font-medium text-gray-500 uppercase">Order</th>
                        <th class="px-4 py-2 w-1/6 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <!-- Example static lesson row -->
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">1</td>
                        <td class="px-4 py-2 text-sm text-gray-900">Lesson 1: Introduction</td>
                        <td class="px-4 py-2 text-sm text-gray-900">1</td>
                        <td class="px-4 py-2 text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <span class="mx-2">|</span>
                            <button onclick="openDeleteModal(1)" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                    <!-- Example static lesson row -->
                    <tr>
                        <td class="px-4 py-2 text-sm text-gray-900">2</td>
                        <td class="px-4 py-2 text-sm text-gray-900">Lesson 2: Setup</td>
                        <td class="px-4 py-2 text-sm text-gray-900">2</td>
                        <td class="px-4 py-2 text-right text-sm font-medium">
                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                            <span class="mx-2">|</span>
                            <button onclick="openDeleteModal(1)" class="text-red-600 hover:text-red-900">Delete</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </section>
        @endif
    </div>
</main>

<!-- Delete Confirmation Modal -->
<div
    id="deleteModal"
    class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black/50"
>
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md mx-4">
        <h2 class="text-xl font-bold mb-4">Confirm Delete</h2>
        <p class="mb-4">Are you sure you want to delete this course? This action cannot be undone.</p>
        <div class="flex justify-end space-x-4">
            <button
                id="cancelDelete"
                onclick="closeDeleteModal()"
                class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400"
            >
                Cancel
            </button>
            <form id="deleteForm" action="" method="POST">
                @csrf
                @method('DELETE')
                <button
                    type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700"
                >
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>


<!-- Scripts -->
<script>
    function openDeleteModal(courseId) {
        courseIdToDelete = courseId;
        document.getElementById('deleteModal').classList.remove('hidden');
    }
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        courseIdToDelete = null;
    }
    function confirmDelete() {
        // For this static UI example, we'll just alert. Replace this with your deletion logic.
        alert("Deleting course with ID: " + courseIdToDelete);
        closeDeleteModal();
        // In production, you might redirect or submit a form here.
    }

    function openConfirmedModal() {
        document.getElementById('confirmedModal').classList.remove('hidden');
    }

    function closeConfirmed() {
        document.getElementById('confirmedModal').classList.add('hidden');
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', function () {
            mobileMenu.classList.toggle('hidden');
            const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
            mobileMenuButton.setAttribute('aria-expanded', !expanded);
        });

        // Profile dropdown toggle (if exists)
        const profileButton = document.getElementById('user-menu-button');
        const profileDropdown = document.getElementById('profile-dropdown-menu');
        if (profileButton) {
            profileButton.addEventListener('click', function (e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
        }
        // Hide profile dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if (profileDropdown && !profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    });
</script>
</body>
</html>
