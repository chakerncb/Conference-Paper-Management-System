@extends('reviewer.layouts.app')

@section('content')

  <!-- Hero Section -->
  <div class="pt-16 bg-gradient-to-br from-purple-600 via-purple-700 to-indigo-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="text-center">
        <h1 class="text-5xl font-bold mb-6">Reviewer Dashboard</h1>
        <p class="text-xl mb-8 text-purple-100 max-w-3xl mx-auto">
          Welcome to your reviewer portal. Review papers, provide feedback, and contribute to the quality of our conference. 
          Your expertise helps maintain the highest standards of academic excellence.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{route('reviewer.reviews.index')}}" class="bg-white text-purple-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 shadow-lg">
            View Pending Reviews
          </a>
          <a href="#review-guidelines" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-purple-600 transition-colors duration-200">
            Review Guidelines
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Review Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-purple-600 mb-2">{{ $pendingReviews ?? 0 }}</div>
        <div class="text-gray-600">Pending Reviews</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-green-600 mb-2">{{ $completedReviews ?? 0 }}</div>
        <div class="text-gray-600">Completed Reviews</div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Pending Reviews Section -->
        @livewire('reviewer.home-reviews-table')

      <!-- Sidebar -->
      <div class="space-y-8">
        <!-- Review Deadlines -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-clock text-red-500 mr-3"></i>
            Upcoming Deadlines
          </h3>
          <div class="space-y-4">
            @if($deadlines['submission'])
            <div class="border-l-4 border-red-500 pl-4">
              <div class="font-semibold text-gray-800">Submission Deadline</div>
              <div class="text-sm text-gray-600">Due: {{ $deadlines['submission'] }}</div>
            </div>
            @endif

            @if($deadlines['review'])
            <div class="border-l-4 border-yellow-500 pl-4">
              <div class="font-semibold text-gray-800">Review Deadline</div>
              <div class="text-sm text-gray-600">Due: {{ $deadlines['review'] }}</div>
            </div>
            @endif

            @if($deadlines['camera_ready'])
            <div class="border-l-4 border-green-500 pl-4">
              <div class="font-semibold text-gray-800">Camera Ready Deadline</div>
              <div class="text-sm text-gray-600">Due: {{ $deadlines['camera_ready'] }}</div>
            </div>
            @endif

            @if($deadlines['registration'])
            <div class="border-l-4 border-blue-500 pl-4">
              <div class="font-semibold text-gray-800">Registration Deadline</div>
              <div class="text-sm text-gray-600">Due: {{ $deadlines['registration'] }}</div>
            </div>
            @endif
          </div>
        </div>

        <!-- Review Guidelines -->
        <div class="bg-white rounded-lg shadow-md p-6" id="review-guidelines">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-clipboard-list text-purple-500 mr-3"></i>
            Review Guidelines
          </h3>
          <ul class="space-y-2 text-sm text-gray-600">
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Evaluate technical quality and novelty
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Assess clarity and presentation
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Check experimental validation
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Provide constructive feedback
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Submit reviews within deadline
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Maintain confidentiality
            </li>
          </ul>
          <a href="#" class="inline-block mt-4 text-purple-600 hover:text-purple-800 font-medium text-sm">
            View detailed guidelines →
          </a>
        </div>

        <!-- Reviewer Statistics -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-chart-bar text-blue-500 mr-3"></i>
            Your Statistics
          </h3>
          <div class="space-y-3">
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">Reviews Completed</span>
              <span class="font-semibold text-gray-800">12</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">Average Score Given</span>
              <span class="font-semibold text-gray-800">7.3/10</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">On-time Submissions</span>
              <span class="font-semibold text-green-600">100%</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">Review Quality</span>
              <span class="font-semibold text-blue-600">8.9/10</span>
            </div>
          </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-bolt text-orange-500 mr-3"></i>
            Quick Actions
          </h3>
          <div class="space-y-3">
            <a href="#" class="w-full bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors duration-200 flex items-center justify-center">
              <i class="fas fa-search mr-2"></i>
              Browse All Papers
            </a>
            <a href="#" class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
              <i class="fas fa-history mr-2"></i>
              Review History
            </a>
            <a href="#" class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
              <i class="fas fa-user-cog mr-2"></i>
              Update Profile
            </a>
          </div>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-envelope text-green-500 mr-3"></i>
            Need Help?
          </h3>
          <div class="space-y-3 text-sm">
            <div>
              <div class="font-medium text-gray-800">Review Coordinator</div>
              <div class="text-gray-600">reviews@conference.org</div>
            </div>
            <div>
              <div class="font-medium text-gray-800">Program Chair</div>
              <div class="text-gray-600">chair@conference.org</div>
            </div>
            <div>
              <div class="font-medium text-gray-800">Technical Support</div>
              <div class="text-gray-600">support@conference.org</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

@endsection
