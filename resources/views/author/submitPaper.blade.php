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
      <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
              <i class="fas fa-upload text-blue-600 mr-3"></i>
              Paper Submission Form
            </h2>
          </div>

          <form action="#" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf
            
            <!-- Error Messages -->
            @if ($errors->any())
              <div class="bg-red-50 border border-red-200 rounded-md p-4">
                <div class="flex">
                  <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-400"></i>
                  </div>
                  <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Please correct the following errors:</h3>
                    <div class="mt-2 text-sm text-red-700">
                      <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            @endif

            <!-- Success Message -->
            @if (session('success'))
              <div class="bg-green-50 border border-green-200 rounded-md p-4">
                <div class="flex">
                  <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-400"></i>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                  </div>
                </div>
              </div>
            @endif

            <!-- Paper Title -->
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-heading text-blue-500 mr-2"></i>
                Paper Title *
              </label>
              <input type="text" id="title" name="title" value="{{ old('title') }}" 
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                     placeholder="Enter your paper title" required>
              <p class="mt-1 text-sm text-gray-500">
                Keep your title concise and descriptive (recommended: 10-15 words)
              </p>
            </div>

            <!-- Abstract -->
            <div>
              <label for="abstract" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-align-left text-blue-500 mr-2"></i>
                Abstract *
              </label>
              <textarea id="abstract" name="abstract" rows="8" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                        placeholder="Provide a clear and concise abstract of your research..." required>{{ old('abstract') }}</textarea>
              <div class="mt-1 flex justify-between text-sm text-gray-500">
                <span>Summarize your research methodology, findings, and contributions</span>
                <span id="abstract-count">0/300 words</span>
              </div>
            </div>

            <!-- Keywords -->
            <div>
              <label for="keywords" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-tags text-blue-500 mr-2"></i>
                Keywords *
              </label>
              <input type="text" id="keywords" name="keywords" value="{{ old('keywords') }}" 
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200" 
                     placeholder="machine learning, artificial intelligence, data mining" required>
              <p class="mt-1 text-sm text-gray-500">
                Enter 3-5 keywords separated by commas that best describe your research
              </p>
            </div>

            <!-- Authors Information -->
            <div class="border border-gray-200 rounded-lg p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-users text-blue-500 mr-2"></i>
                Author Information
              </h3>
              
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label for="primary_author" class="block text-sm font-medium text-gray-700 mb-2">
                    Primary Author (Corresponding)
                  </label>
                  <input type="text" id="primary_author" name="primary_author" 
                         value="{{ Auth::user()->name ?? old('primary_author') }}" 
                         class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                         readonly>
                </div>
                
                <div>
                  <label for="author_email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email Address
                  </label>
                  <input type="email" id="author_email" name="author_email" 
                         value="{{ Auth::user()->email ?? old('author_email') }}" 
                         class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                         readonly>
                </div>
              </div>

              <div class="mt-4">
                <label for="co_authors" class="block text-sm font-medium text-gray-700 mb-2">
                  Co-Authors (Optional)
                </label>
                <textarea id="co_authors" name="co_authors" rows="3" 
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                          placeholder="List co-authors with their affiliations (one per line)">{{ old('co_authors') }}</textarea>
              </div>
            </div>

            <!-- File Upload -->
            <div class="border border-gray-200 rounded-lg p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-file-pdf text-blue-500 mr-2"></i>
                Paper Upload
              </h3>
              
              <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200">
                <div class="space-y-2">
                  <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                  <div>
                    <label for="paper_file" class="cursor-pointer">
                      <span class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
                        Choose PDF File
                      </span>
                      <input type="file" id="paper_file" name="paper_file" accept=".pdf" class="hidden" required>
                    </label>
                  </div>
                  <p class="text-sm text-gray-500">or drag and drop your PDF file here</p>
                  <p class="text-xs text-gray-400">Maximum file size: 10MB</p>
                </div>
              </div>
              
              <div id="file-info" class="mt-3 hidden">
                <div class="bg-blue-50 border border-blue-200 rounded-md p-3">
                  <div class="flex items-center">
                    <i class="fas fa-file-pdf text-blue-600 mr-2"></i>
                    <span id="file-name" class="text-sm font-medium text-blue-800"></span>
                    <span id="file-size" class="text-sm text-blue-600 ml-2"></span>
                  </div>
                </div>
              </div>
            </div>

            <!-- Submission Guidelines Acknowledgment -->
            <div class="border border-gray-200 rounded-lg p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-check-square text-blue-500 mr-2"></i>
                Submission Agreement
              </h3>
              
              <div class="space-y-3">
                <label class="flex items-start">
                  <input type="checkbox" name="guidelines_accepted" value="1" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                  <span class="ml-3 text-sm text-gray-700">
                    I confirm that this paper follows the <a href="#" class="text-blue-600 hover:underline">IEEE conference template</a> and submission guidelines
                  </span>
                </label>
                
                <label class="flex items-start">
                  <input type="checkbox" name="originality_confirmed" value="1" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                  <span class="ml-3 text-sm text-gray-700">
                    I certify that this work is original and has not been published elsewhere
                  </span>
                </label>
                
                <label class="flex items-start">
                  <input type="checkbox" name="review_process_accepted" value="1" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                  <span class="ml-3 text-sm text-gray-700">
                    I understand and agree to the double-blind peer review process
                  </span>
                </label>
              </div>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
              <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
              </a>
              
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-paper-plane mr-2"></i>
                Submit Paper
              </button>
            </div>
          </form>
        </div>
      </div>

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
              <div class="text-sm text-gray-600">July 15, 2025</div>
              <div class="text-xs text-red-600">36 days remaining</div>
            </div>
            <div class="border-l-4 border-yellow-500 pl-4">
              <div class="font-semibold text-gray-800">Review Period Ends</div>
              <div class="text-sm text-gray-600">August 30, 2025</div>
            </div>
            <div class="border-l-4 border-green-500 pl-4">
              <div class="font-semibold text-gray-800">Notification Date</div>
              <div class="text-sm text-gray-600">September 15, 2025</div>
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
            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
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