@extends('author.layouts.app')

@section('content')

  <!-- Page Header -->
  <div class="pt-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="flex items-center justify-between">
        <div>
          <h1 class="text-4xl font-bold mb-4">My Submitted Papers</h1>
          <p class="text-xl text-blue-100">
            Track the status and reviews of your submitted research papers
          </p>
        </div>
        <div class="hidden md:block">
          <a href="{{route('paper.create')}}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 shadow-lg">
            <i class="fas fa-plus mr-2"></i>
            Submit New Paper
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
     @livewire('author.my-papers-page')
  </div>

@endsection