@extends('author.layouts.app')

@section('content')



  <!-- Hero Section -->
  <div class="pt-16 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="text-center">
        <h1 class="text-5xl font-bold mb-6">International Conference on Computer Science</h1>
        <p class="text-xl mb-8 text-blue-100 max-w-3xl mx-auto">
          Submit your research papers and contribute to the advancement of computer science. 
          Join researchers from around the world in sharing innovative ideas and discoveries.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{route('paper.create')}}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 shadow-lg">
            Submit New Paper
          </a>
          <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors duration-200">
            View Guidelines
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Quick Actions -->
      <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-bolt text-blue-500 mr-3"></i>
            Quick Actions
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="#" class="group p-4 border border-gray-200 rounded-lg hover:border-blue-300 hover:shadow-md transition-all duration-200">
              <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-lg group-hover:bg-blue-200 transition-colors duration-200">
                  <i class="fas fa-upload text-blue-600 text-xl"></i>
                </div>
                <div class="ml-4">
                  <h3 class="font-semibold text-gray-800">Submit New Paper</h3>
                  <p class="text-sm text-gray-600">Upload your research paper</p>
                </div>
              </div>
            </a>
            
            <a href="#" class="group p-4 border border-gray-200 rounded-lg hover:border-green-300 hover:shadow-md transition-all duration-200">
              <div class="flex items-center">
                <div class="bg-green-100 p-3 rounded-lg group-hover:bg-green-200 transition-colors duration-200">
                  <i class="fas fa-file-alt text-green-600 text-xl"></i>
                </div>
                <div class="ml-4">
                  <h3 class="font-semibold text-gray-800">My Submissions</h3>
                  <p class="text-sm text-gray-600">Track your paper status</p>
                </div>
              </div>
            </a>
            
            <a href="#" class="group p-4 border border-gray-200 rounded-lg hover:border-purple-300 hover:shadow-md transition-all duration-200">
              <div class="flex items-center">
                <div class="bg-purple-100 p-3 rounded-lg group-hover:bg-purple-200 transition-colors duration-200">
                  <i class="fas fa-search text-purple-600 text-xl"></i>
                </div>
                <div class="ml-4">
                  <h3 class="font-semibold text-gray-800">Review Papers</h3>
                  <p class="text-sm text-gray-600">Review assigned papers</p>
                </div>
              </div>
            </a>
            
            <a href="#" class="group p-4 border border-gray-200 rounded-lg hover:border-orange-300 hover:shadow-md transition-all duration-200">
              <div class="flex items-center">
                <div class="bg-orange-100 p-3 rounded-lg group-hover:bg-orange-200 transition-colors duration-200">
                  <i class="fas fa-calendar text-orange-600 text-xl"></i>
                </div>
                <div class="ml-4">
                  <h3 class="font-semibold text-gray-800">Important Dates</h3>
                  <p class="text-sm text-gray-600">View conference timeline</p>
                </div>
              </div>
            </a>
          </div>
        </div>

      </div>

      <!-- Sidebar -->
      <div class="space-y-8">
        <!-- Important Dates -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-calendar-alt text-red-500 mr-3"></i>
            Important Dates
          </h3>
           <div class="space-y-4">
            <div class="border-l-4 border-red-500 pl-4">
              <div class="font-semibold text-gray-800">Paper Submission Deadline</div>
              <div class="text-sm text-gray-600">{{ $deadLines['submission'] }}</div>
            </div>
            <div class="border-l-4 border-yellow-500 pl-4">
              <div class="font-semibold text-gray-800">Review Period Ends</div>
              <div class="text-sm text-gray-600">{{ $deadLines['review'] }}</div>
            </div>
            {{-- <div class="border-l-4 border-green-500 pl-4">
              <div class="font-semibold text-gray-800">Final Decision Date</div>
              <div class="text-sm text-gray-600">{{ $deadLines['decision'] }}</div>
            </div> --}}
            <div class="border-l-4 border-blue-500 pl-4">
              <div class="font-semibold text-gray-800">Camera Ready </div>
              <div class="text-sm text-gray-600">{{ $deadLines['camera_ready'] }}</div>
            </div>
            <div class="border-l-4 border-blue-500 pl-4">
              <div class="font-semibold text-gray-800">Registration Deadline </div>
              <div class="text-sm text-gray-600">{{ $deadLines['registration'] }}</div>
            </div>



          </div>
        </div>

        <!-- Guidelines -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-info-circle text-blue-500 mr-3"></i>
            Submission Guidelines
          </h3>
          <ul class="space-y-2 text-sm text-gray-600">
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Papers must be 6-8 pages in length
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Use IEEE conference template
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Submit in PDF format only
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Include 3-5 keywords
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-2"></i>
              Blind review process
            </li>
          </ul>
          <a href="#" class="inline-block mt-4 text-blue-600 hover:text-blue-800 font-medium text-sm">
            View full guidelines →
          </a>
        </div>

        <!-- Contact Information -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-envelope text-green-500 mr-3"></i>
            Need Help?
          </h3>
          <div class="space-y-3 text-sm">
            <div>
              <div class="font-medium text-gray-800">Technical Support</div>
              <div class="text-gray-600">support@conference.org</div>
            </div>
            <div>
              <div class="font-medium text-gray-800">Program Chair</div>
              <div class="text-gray-600">chair@conference.org</div>
            </div>
            <div>
              <div class="font-medium text-gray-800">General Inquiries</div>
              <div class="text-gray-600">info@conference.org</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>

@endsection
