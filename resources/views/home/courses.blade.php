<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Courses</title>
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
            <a href="/"
               class="{{ request()->is('/') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Dashboard
            </a>
            <a href="/courses"
               class="{{ request()->is('courses*') ? 'bg-indigo-50 border-indigo-500 text-indigo-700' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' }} block pl-3 pr-4 py-2 border-l-4 text-base font-medium">
                Courses
            </a>
            @auth
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
            @else
                <a href="/register"
                   class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800 text-base font-medium">
                    Register
                </a>
            @endauth
        </div>
    </div>
</nav>

<!-- Hero Section -->
<header class="bg-indigo-500">
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-bold text-white">Our Courses</h1>
        <p class="mt-2 text-lg text-indigo-100">Browse through our comprehensive collection of courses.</p>
    </div>
</header>

<!-- Main Content -->
<main class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Search / Filter Bar -->
        <div class="mb-6">
            <form action="/courses" method="GET" class="flex">
                <input type="text" name="search" placeholder="Search courses..." class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none">
                <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700">
                    Search
                </button>
            </form>
        </div>

        <!-- Courses Grid -->
        <section>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card 1 -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <img src="{{ asset('images/sample1.jpg') }}" alt="Course Image" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-900">Course Title 1</h2>
                        <p class="mt-2 text-gray-600">A brief description of Course 1 goes here.</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">$49.99</span>
                            <a href="/courses/course-title-1" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                View Course &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <img src="{{ asset('images/sample1.jpg') }}" alt="Course Image" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-900">Course Title 2</h2>
                        <p class="mt-2 text-gray-600">A brief description of Course 2 goes here.</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">$39.99</span>
                            <a href="/courses/course-title-2" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                View Course &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Course Card 3 -->
                <div class="bg-white shadow rounded-lg overflow-hidden">
                    <img src="{{ asset('images/sample1.jpg') }}" alt="Course Image" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold text-gray-900">Course Title 3</h2>
                        <p class="mt-2 text-gray-600">A brief description of Course 3 goes here.</p>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="text-indigo-600 font-bold">$29.99</span>
                            <a href="/courses/course-title-3" class="text-indigo-600 hover:text-indigo-800 font-medium">
                                View Course &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</main>

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

        // Profile dropdown toggle (if exists)
        const profileButton = document.getElementById('user-menu-button');
        const profileDropdown = document.getElementById('profile-dropdown-menu');
        if(profileButton){
            profileButton.addEventListener('click', function (e) {
                e.stopPropagation();
                profileDropdown.classList.toggle('hidden');
            });
        }
        // Hide profile dropdown when clicking outside
        document.addEventListener('click', function (e) {
            if(profileDropdown && !profileButton.contains(e.target) && !profileDropdown.contains(e.target)){
                profileDropdown.classList.add('hidden');
            }
        });
    });
</script>
</body>
</html>
