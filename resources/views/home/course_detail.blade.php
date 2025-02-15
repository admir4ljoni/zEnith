<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Course Detail</title>
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
                    <a href="/"
                       class="{{ request()->is('/') ? 'border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700 border-transparent' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Dashboard
                    </a>
                    <!-- Courses link -->
                    <a href="/courses"
                       class="{{ request()->is('courses*') ? 'border-indigo-500 text-gray-900' : 'text-gray-500 hover:text-gray-700 border-transparent' }} inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium">
                        Courses
                    </a>
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                @auth
                    <!-- Profile Dropdown for Authenticated Users -->
                    <div class="ml-3 relative">
                        <button type="button" id="user-menu-button" class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" aria-expanded="false" aria-haspopup="true">
                            <span class="sr-only">Open user menu</span>
                            <img class="h-8 w-8 rounded-full" src="{{ asset('images/sample1.jpg') }}" alt="User Profile">
                        </button>
                        <!-- Dropdown menu -->
                        <div id="profile-dropdown-menu" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 hidden" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
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
                @else
                    <!-- Register Link for Guests -->
                    <div class="ml-3">
                        <a href="/register" class="inline-flex items-center px-1 pt-1 text-sm font-medium text-gray-500 hover:text-gray-700">
                            Register
                        </a>
                    </div>
                @endauth
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
            <a href="/" class="{{ request()->is('/') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Dashboard
            </a>
            <a href="/courses" class="{{ request()->is('courses*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Courses
            </a>
            @auth
                <a href="/profile" class="{{ request()->is('profile*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                    Profile
                </a>
                <form method="POST" action="/logout" class="block">
                    @csrf
                    <button type="submit" class="w-full text-left block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 text-base font-medium">
                        Logout
                    </button>
                </form>
            @else
                <a href="/register" class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 text-base font-medium">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="bg-indigo-500">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white">Course Detail: Learn Laravel</h1>
        <p class="mt-2 text-lg text-indigo-100">A comprehensive course to master Laravel.</p>
    </div>
</header>

<!-- Main Content: Course Detail -->
<main class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex gap-6">
            <!-- Sidebar: Lessons List -->
            <aside class="w-1/4 bg-white shadow rounded-lg p-4">
                <h2 class="text-xl font-bold mb-4">Lessons</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="block px-2 py-1 text-gray-700 hover:bg-indigo-100 rounded">
                            Lesson 1: Introduction
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-2 py-1 text-gray-700 hover:bg-indigo-100 rounded">
                            Lesson 2: Setup
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-2 py-1 text-gray-700 hover:bg-indigo-100 rounded">
                            Lesson 3: Basic Concepts
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block px-2 py-1 text-gray-700 hover:bg-indigo-100 rounded">
                            Lesson 4: Advanced Topics
                        </a>
                    </li>
                </ul>
            </aside>

            <!-- Main Course Content -->
            <section class="w-3/4 bg-white shadow rounded-lg p-6">
                <h2 class="text-2xl font-semibold text-gray-800">Course Overview</h2>
                <p class="mt-4 text-gray-600">
                    This course provides a comprehensive guide to building web applications using Laravel. Learn everything from the basics to advanced topics, with detailed lessons and practical examples.
                </p>
                <div class="mt-6">
                    <img src="{{ asset('images/sample1.jpg') }}" alt="Course Image" class="w-full h-64 object-cover rounded">
                </div>
                <div class="mt-6">
                    <h3 class="text-xl font-semibold text-gray-800">What You'll Learn</h3>
                    <p class="mt-2 text-gray-700">
                        Routing, Controllers, Models, Views, Migrations, Eloquent ORM, Middleware, Blade Templating, and much more!
                    </p>
                </div>
            </section>
        </div>
    </div>
</main>

<!-- Comment Section -->
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white shadow rounded-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Comments</h2>

        <!-- Existing Comments (Static for now) -->
        <div class="space-y-4 mb-6">
            <div class="border p-4 rounded">
                <p class="text-gray-700">Great course! Learned a lot.</p>
                <p class="text-xs text-gray-500">By Jane Doe on 2025-02-15</p>
            </div>
            <div class="border p-4 rounded">
                <p class="text-gray-700">Very informative and well-structured.</p>
                <p class="text-xs text-gray-500">By Bob Smith on 2025-02-16</p>
            </div>
        </div>

        <!-- Comment Form -->
        @auth
            <form action="#" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="comment" class="block text-sm font-medium text-gray-700">Add a Comment</label>
                    <textarea id="comment" name="comment" rows="4" placeholder="Write your comment here..." class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-md">
                        Post Comment
                    </button>
                </div>
            </form>
        @else
            <div class="text-center">
                <p class="text-gray-600">
                    Please <a href="/register" class="text-indigo-600 underline">register</a> first to comment.
                </p>
            </div>
        @endauth
    </div>
</section>

<!-- Footer -->
<footer class="bg-gray-800">
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

        // Profile dropdown toggle
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
