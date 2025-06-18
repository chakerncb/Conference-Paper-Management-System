@extends('chair.layouts.app')

@section('content')

  <!-- Hero Section -->
  <div class="pt-16 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="text-center">
        <h1 class="text-5xl font-bold mb-6">Chair Dashboard</h1>
        <p class="text-xl mb-8 text-blue-100 max-w-3xl mx-auto">
          Welcome to your conference management portal. Oversee papers, manage reviewers, and ensure the highest quality standards for our academic conference.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{route('chair.papers.index')}}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 shadow-lg">
            Manage Papers
          </a>
          <a href="{{route('chair.users.index')}}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors duration-200">
            Manage Users
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <!-- Conference Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-blue-600 mb-2">{{ $totalPapers ?? 24 }}</div>
        <div class="text-gray-600">Total Papers</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-green-600 mb-2">{{ $acceptedPapers ?? 8 }}</div>
        <div class="text-gray-600">Accepted Papers</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-orange-600 mb-2">{{ $underReviewPapers ?? 12 }}</div>
        <div class="text-gray-600">Under Review</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-purple-600 mb-2">{{ $totalReviewers ?? 18 }}</div>
        <div class="text-gray-600">Active Reviewers</div>
      </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Quick Actions -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-bolt text-blue-500 mr-3"></i>
            Quick Actions
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{route('chair.papers.index')}}" class="bg-blue-50 hover:bg-blue-100 p-6 rounded-lg transition-colors duration-200 border border-blue-200">
              <div class="flex items-center mb-4">
                <div class="bg-blue-500 text-white p-3 rounded-lg mr-4">
                  <i class="fas fa-file-alt text-xl"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Review Papers</h3>
                  <p class="text-sm text-gray-600">Manage submitted papers</p>
                </div>
              </div>
            </a>
            
            <a href="{{route('chair.users.index')}}" class="bg-green-50 hover:bg-green-100 p-6 rounded-lg transition-colors duration-200 border border-green-200">
              <div class="flex items-center mb-4">
                <div class="bg-green-500 text-white p-3 rounded-lg mr-4">
                  <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Manage Users</h3>
                  <p class="text-sm text-gray-600">Add or edit user accounts</p>
                </div>
              </div>
            </a>
            
            <a href="#" class="bg-purple-50 hover:bg-purple-100 p-6 rounded-lg transition-colors duration-200 border border-purple-200">
              <div class="flex items-center mb-4">
                <div class="bg-purple-500 text-white p-3 rounded-lg mr-4">
                  <i class="fas fa-chart-bar text-xl"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">View Analytics</h3>
                  <p class="text-sm text-gray-600">Conference statistics</p>
                </div>
              </div>
            </a>
            
            <a href="#" class="bg-orange-50 hover:bg-orange-100 p-6 rounded-lg transition-colors duration-200 border border-orange-200">
              <div class="flex items-center mb-4">
                <div class="bg-orange-500 text-white p-3 rounded-lg mr-4">
                  <i class="fas fa-cogs text-xl"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Settings</h3>
                  <p class="text-sm text-gray-600">Configure system settings</p>
                </div>
              </div>
            </a>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow-md p-6 mt-8">
          <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-history text-blue-500 mr-3"></i>
            Recent Activity
          </h2>
          <div class="space-y-4">
            <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
              <div class="bg-green-100 p-2 rounded-full">
                <i class="fas fa-check text-green-600"></i>
              </div>
              <div class="flex-1">
                <p class="font-medium text-gray-800">Paper "Machine Learning in Healthcare" was accepted</p>
                <p class="text-sm text-gray-600">2 hours ago</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
              <div class="bg-blue-100 p-2 rounded-full">
                <i class="fas fa-user-plus text-blue-600"></i>
              </div>
              <div class="flex-1">
                <p class="font-medium text-gray-800">New reviewer Dr. Smith was added to the system</p>
                <p class="text-sm text-gray-600">5 hours ago</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg">
              <div class="bg-yellow-100 p-2 rounded-full">
                <i class="fas fa-edit text-yellow-600"></i>
              </div>
              <div class="flex-1">
                <p class="font-medium text-gray-800">Review assignment updated for "AI Ethics Framework"</p>
                <p class="text-sm text-gray-600">1 day ago</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Sidebar -->
      <div class="space-y-8">
        <!-- Conference Deadlines -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-clock text-red-500 mr-3"></i>
            Important Deadlines
          </h3>
          <div class="space-y-4">
            <div class="border-l-4 border-red-500 pl-4">
              <div class="font-semibold text-gray-800">Paper Submission Deadline</div>
              <div class="text-sm text-gray-600">June 30, 2025</div>
            </div>
            <div class="border-l-4 border-yellow-500 pl-4">
              <div class="font-semibold text-gray-800">Review Period Ends</div>
              <div class="text-sm text-gray-600">August 30, 2025</div>
            </div>
            <div class="border-l-4 border-green-500 pl-4">
              <div class="font-semibold text-gray-800">Final Decision Date</div>
              <div class="text-sm text-gray-600">September 15, 2025</div>
            </div>
            <div class="border-l-4 border-blue-500 pl-4">
              <div class="font-semibold text-gray-800">Conference Date</div>
              <div class="text-sm text-gray-600">November 10-12, 2025</div>
            </div>
          </div>
        </div>

        <!-- Conference Statistics -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-chart-bar text-blue-500 mr-3"></i>
            Conference Overview
          </h3>
          <div class="space-y-3">
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">Submission Rate</span>
              <span class="font-semibold text-gray-800">78%</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">Acceptance Rate</span>
              <span class="font-semibold text-gray-800">33%</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">Reviews Completed</span>
              <span class="font-semibold text-green-600">85%</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="text-sm text-gray-600">Avg. Review Score</span>
              <span class="font-semibold text-blue-600">7.2/10</span>
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
            <a href="{{route('chair.papers.index')}}" class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
              <i class="fas fa-file-alt mr-2"></i>
              Review Papers
            </a>
            <a href="{{route('chair.users.index')}}" class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
              <i class="fas fa-users mr-2"></i>
              Manage Users
            </a>
            <a href="#" class="w-full border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors duration-200 flex items-center justify-center">
              <i class="fas fa-download mr-2"></i>
              Export Reports
            </a>
          </div>
        </div>

        <!-- Conference Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-info-circle text-green-500 mr-3"></i>
            Conference Info
          </h3>
          <div class="space-y-3 text-sm">
            <div>
              <div class="font-medium text-gray-800">Conference Theme</div>
              <div class="text-gray-600">AI & Machine Learning 2025</div>
            </div>
            <div>
              <div class="font-medium text-gray-800">Venue</div>
              <div class="text-gray-600">Convention Center, City Hall</div>
            </div>
            <div>
              <div class="font-medium text-gray-800">Expected Attendees</div>
              <div class="text-gray-600">500+ Researchers</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

@endsection
