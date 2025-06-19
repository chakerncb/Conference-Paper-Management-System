<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    @livewireStyles
</head>
<body>

  <div class="min-h-screen bg-gray-50">
  <nav class="fixed top-0 left-0 right-0 bg-white shadow-lg z-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between h-16 items-center">
        <div class="flex items-center">
          <div class="flex-shrink-0 font-bold text-2xl text-blue-600">
            <i class="fas fa-file-alt mr-2"></i>
            {{ config('app.name') }} - Chair Portal
          </div>
        </div>        
        
        <div class="hidden md:flex space-x-8">          <a href="{{route('chair.dashboard')}}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('chair.dashboard') ? 'border-b-2 border-blue-600' : '' }}">Dashboard</a>
          <a href="{{route('chair.papers.index')}}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('chair.papers.*') ? 'border-b-2 border-blue-600' : '' }}">Papers</a>
          <a href="{{route('chair.users.index')}}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('chair.users.*') ? 'border-b-2 border-blue-600' : '' }}">Users</a>
          <a href="{{route('chair.settings')}}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('chair.settings') ? 'border-b-2 border-blue-600' : '' }}">Settings</a>
        </div>

        <div class="hidden md:flex items-center space-x-4">
          @auth
            <div class="relative">
              <button id="userDropdown" class="flex items-center text-sm text-gray-600 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500 rounded-md px-3 py-2">
                <span>{{ Auth::user()->name }}</span>
                <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
              </button>
              
            <div id="userDropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
              <div class="px-4 py-2 text-sm text-gray-700 border-b">
                {{ Auth::user()->name }}
              </div>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
              <a href="{{route('chair.dashboard')}}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
              <form method="POST" action="{{ route('logout') }}" class="block">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                  Logout
                </button>
              </form>
                  </div>
                </div>
              @else
                <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 font-medium">Login</a>
                <a href="{{ route('register') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200">Register</a>
              @endauth
          </div>

        <div class="md:hidden">
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

  <footer class="bg-white shadow-lg mt-10">
    <div class="max-w-7xl mx-auto px-4 py-6 text-center">
      <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   <script>
          document.getElementById('userDropdown').addEventListener('click', function() {
            const menu = document.getElementById('userDropdownMenu');
            menu.classList.toggle('hidden');
          });
          
          document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            const menu = document.getElementById('userDropdownMenu');
            if (!dropdown.contains(event.target)) {
              menu.classList.add('hidden');
            }
          });
    </script> 
  @livewireScripts
</div>
</body>
</html>
