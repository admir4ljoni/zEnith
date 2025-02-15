<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add / Edit Lesson</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- CKEditor from CDN -->
    <script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
</head>
<body class="bg-gray-50">
<!-- Navigation (Same as Admin Dashboard) -->
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
        <!-- You could conditionally display "Add Lesson" or "Edit Lesson" based on context -->
        <h1 class="text-3xl font-bold text-white">Add / Edit Lesson</h1>
        <p class="mt-2 text-lg text-indigo-100">Fill in the details below.</p>
    </div>
</header>

<!-- Main Content: Lesson Form -->
<main class="py-10">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded-lg p-6">
            <!-- Static Lesson Form UI (for adding or editing) -->
            <form action="#" method="POST" enctype="multipart/form-data">
                <!-- Lesson Title -->
                <div class="mb-4">
                    <label for="lesson_title" class="block text-sm font-medium text-gray-700">Lesson Title</label>
                    <input type="text" name="lesson_title" id="lesson_title" placeholder="e.g., Introduction to Laravel" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <!-- Lesson Order -->
                <div class="mb-4">
                    <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
                    <input type="number" name="order" id="order" placeholder="e.g., 1" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <!-- Lesson Content (CKEditor) -->
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea name="content" id="content" rows="6" placeholder="Lesson content..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <!-- Change button text based on context (Add or Update) -->
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save Lesson
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 mt-10">
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
        <p class="text-center text-gray-300 text-sm">© 2025 zEnith. All rights reserved.</p>
    </div>
</footer>

<!-- Scripts -->
<script>
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

    // Initialize CKEditor
    // (Wait until the DOM is loaded before replacing the textarea)
    CKEDITOR.replace('content', {
        // Optional configuration:
        removeButtons: 'Source', // Example: remove "Source" button if you want
        // other config...
    });
</script>
</body>
</html>
