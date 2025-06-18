@extends('chair.layouts.app')

@section('content')

  <!-- Page Header -->
  <div class="pt-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-4xl font-bold mb-4">Users Management</h1>
          <p class="text-xl text-blue-100">
            Manage system users, reviewers, and author accounts
          </p>
        </div>
        <div class="hidden md:block">
          <div class="bg-white/10 px-6 py-3 rounded-lg backdrop-blur-sm">
            <span class="text-sm text-blue-100">Total Users</span>
            <div class="text-2xl font-bold">{{ $usersCount ?? 0 }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    @livewire('chair.users-table')
  </main>

@endsection
       