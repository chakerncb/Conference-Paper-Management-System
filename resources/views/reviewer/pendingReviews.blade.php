@extends('reviewer.layouts.app')

@section('content')

  <!-- Page Header -->
  <div class="pt-16 bg-gradient-to-r from-purple-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-4xl font-bold mb-4">Pending Reviews</h1>
          <p class="text-xl text-purple-100">
            Review and evaluate research papers assigned to you
          </p>
        </div>
        <div class="hidden md:block">
          <div class="bg-white/10 px-6 py-3 rounded-lg backdrop-blur-sm">
            <span class="text-sm text-purple-100">Reviews Pending</span>
            <div class="text-2xl font-bold">{{ $pendingReviews->count() ?? 0 }}</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
     @livewire('reviewer.pending-reviews-table')

@endsection