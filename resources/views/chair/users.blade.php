@extends('chair.layouts.master')

@section('title', 'Users Management')

@section('content')
  <div class="container grid px-6 mx-auto">
    <h2
      class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
    >
      Users Table
    </h2>

    @livewire('chair.users-table')

  </div>
@endsection
       