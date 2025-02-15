<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - Courses</title>
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
                       class="{{ request()->is('/dashboard') ? 'border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700 border-transparent' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
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
                <a href="/profile"
                   class="{{ request()->is('profile*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Profile
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
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
        <h1 class="text-3xl font-bold text-white">Admin Courses Dashboard</h1>
        <a href="/admin/course/create-or-edit" class="bg-white text-indigo-600 font-semibold px-4 py-2 rounded-md hover:bg-gray-100">
            Create Course
        </a>
    </div>
</header>

<!-- Main Content: Courses Table -->
<main class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 w-16 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 w-2/6 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                    <th class="px-6 py-3 w-1/6 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                    <th class="px-6 py-3 w-1/6 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                    <th class="px-6 py-3 w-1/6 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 w-1/6 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                <!-- Example static row; replace with dynamic rows as needed -->
                    @forelse($courses as $course)
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">{{$course->id}}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{$course->title}}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{$course->category->name}}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{$course->price}}</td>
                            <td class="px-6 py-4 text-sm text-gray-900">{{$course->status}}</td>
                            <td class="px-6 py-4 text-right text-sm font-medium">
                                <a href="{{route('admin.course.edit', $course->id)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                <span class="mx-2">|</span>
                                <!-- Delete link triggers the modal with course id 1 -->
                                <button onclick="openDeleteModal({{$course->id}})" class="text-red-600 hover:text-red-900">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="px-6 py-4 text-sm text-gray-900">No Data</td>
                            <td class="px-6 py-4 text-sm text-gray-900">No Data</td>
                            <td class="px-6 py-4 text-sm text-gray-900">No Data</td>
                            <td class="px-6 py-4 text-sm text-gray-900">No Data</td>
                            <td class="px-6 py-4 text-sm text-gray-900">No Data</td>
                            <td class="px-6 py-4 text-sm text-gray-900">No Data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
            <form id="deleteModalForm" action="" method="POST">
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
    let courseIdToDelete = null;
    function openDeleteModal(courseId) {
        const deleteForm = document.getElementById('deleteModalForm')
        deleteForm.action = `/admin/course/delete/${courseId}`;
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
