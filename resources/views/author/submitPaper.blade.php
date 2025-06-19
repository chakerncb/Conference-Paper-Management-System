@extends('author.layouts.app')

@section('content')


  <!-- Page Header -->
  <div class="pt-16 bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      <div class="text-center">
        <h1 class="text-4xl font-bold mb-4">Submit Your Research Paper</h1>
        <p class="text-xl text-blue-100 max-w-2xl mx-auto">
          Share your groundbreaking research with the global computer science community
        </p>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      
      <!-- Submission Form -->
      @livewire('author.submit-paper-form')

      <!-- Sidebar -->
      <div class="space-y-6">
        <!-- Important Dates -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-calendar-alt text-red-500 mr-3"></i>
            Important Dates
          </h3>
          <div class="space-y-4">
            <div class="border-l-4 border-red-500 pl-4">
              <div class="font-semibold text-gray-800">Submission Deadline</div>
              <div class="text-sm text-gray-600">{{ $deadLines['submission'] }}</div>
            </div>
            <div class="border-l-4 border-yellow-500 pl-4">
              <div class="font-semibold text-gray-800">Review Deadline</div>
              <div class="text-sm text-gray-600">{{ $deadLines['review'] }}</div>
            </div>
            <div class="border-l-4 border-blue-500 pl-4">
              <div class="font-semibold text-gray-800">Camera Ready Deadline</div>
              <div class="text-sm text-gray-600">{{ $deadLines['camera_ready'] }}</div>
            </div>
            <div class="border-l-4 border-green-500 pl-4">
              <div class="font-semibold text-gray-800">Registration Deadline</div>
              <div class="text-sm text-gray-600">{{ $deadLines['registration'] }}</div>
            </div>
          </div>
        </div>

        <!-- Submission Guidelines -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-list-check text-blue-500 mr-3"></i>
            Submission Checklist
          </h3>
          <ul class="space-y-3">
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
              <span class="text-sm text-gray-700">Paper is 6-8 pages in length</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
              <span class="text-sm text-gray-700">Follows IEEE conference template</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
              <span class="text-sm text-gray-700">PDF format, max 10MB</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
              <span class="text-sm text-gray-700">Anonymized for blind review</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
              <span class="text-sm text-gray-700">Includes 3-5 relevant keywords</span>
            </li>
            <li class="flex items-start">
              <i class="fas fa-check text-green-500 mt-1 mr-3"></i>
              <span class="text-sm text-gray-700">Abstract under 300 words</span>
            </li>
          </ul>
          
          <div class="mt-4 pt-4 border-t border-gray-200">
            <a href="{{route('paper.print' , 'IEEE-paper-format-template.docx')}}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center" download>
              <i class="fas fa-download mr-2"></i>
              Download IEEE Template
            </a>
          </div>
        </div>

        <!-- Help & Support -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-question-circle text-purple-500 mr-3"></i>
            Need Help?
          </h3>
          <div class="space-y-3">
            <div>
              <div class="font-medium text-gray-800 text-sm">Technical Support</div>
              <div class="text-gray-600 text-sm">support@conference.org</div>
            </div>
            <div>
              <div class="font-medium text-gray-800 text-sm">Submission Guidelines</div>
              <a href="#" class="text-blue-600 hover:underline text-sm">View detailed guide</a>
            </div>
            <div>
              <div class="font-medium text-gray-800 text-sm">FAQ</div>
              <a href="#" class="text-blue-600 hover:underline text-sm">Common questions</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@endsection