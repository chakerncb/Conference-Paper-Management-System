<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    @livewireStyles
</head>
<body>

  <div class="min-h-screen bg-gray-50">
  <!-- Navigation Bar -->
  <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <div class="flex items-center">
          <div class="flex-shrink-0 font-bold text-2xl text-blue-600">
            <i class="fas fa-file-alt mr-2"></i>
            {{ config('app.name') }} - Chair Portal
          </div>
        </div>        <div class="hidden md:flex space-x-8">
          <a href="{{route('chair.dashboard')}}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('chair.dashboard') ? 'border-b-2 border-blue-600' : '' }}">Dashboard</a>
          <a href="{{route('chair.papers.index')}}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('chair.papers.*') ? 'border-b-2 border-blue-600' : '' }}">Papers</a>
          <a href="{{route('chair.users.index')}}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('chair.users.*') ? 'border-b-2 border-blue-600' : '' }}">Users</a>
          <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">Settings</a>
        </div>
        <div class="hidden md:flex items-center space-x-4">
          @auth
            <span class="text-sm text-gray-600">Welcome, {{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" class="inline">
              @csrf
              <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">
                Logout
              </button>
            </form>
          @else
            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Login</a>
            <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">Register</a>
          @endauth
        </div>
        <div class="md:hidden">
          <!-- Mobile menu button -->
          <button class="text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
      </div>
    </div>
  </nav>

  @yield('content')

  <!-- Footer -->
  <footer class="bg-white shadow-lg mt-10">
    <div class="max-w-7xl mx-auto px-4 py-6 text-center">
      <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  @livewireScripts
</div>
</body>
</html>
