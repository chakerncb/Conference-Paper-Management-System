<div>
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <i class="fas fa-file-alt text-2xl text-blue-500"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl font-bold text-gray-900">5</div>
            <div class="text-sm text-gray-500">Total Submissions</div>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <i class="fas fa-clock text-2xl text-yellow-500"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl font-bold text-gray-900">2</div>
            <div class="text-sm text-gray-500">Under Review</div>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-2xl text-green-500"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl font-bold text-gray-900">2</div>
            <div class="text-sm text-gray-500">Accepted</div>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500">
        <div class="flex items-center">
          <div class="flex-shrink-0">
            <i class="fas fa-times-circle text-2xl text-red-500"></i>
          </div>
          <div class="ml-4">
            <div class="text-2xl font-bold text-gray-900">1</div>
            <div class="text-sm text-gray-500">Rejected</div>
          </div>
        </div>
      </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
          <!-- Search -->
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" id="search" placeholder="Search papers..." 
                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
          </div>
          
          <!-- Status Filter -->
          <select id="status-filter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Status</option>
            <option value="Submitted">Submitted</option>
            <option value="Under Review">Under Review</option>
            <option value="Accepted">Accepted</option>
            <option value="Rejected">Rejected</option>
          </select>
        </div>
        
        <!-- Sort Options -->
        <div class="flex items-center space-x-2">
          <span class="text-sm text-gray-600">Sort by:</span>
          <select id="sort-by" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
            <option value="title">Title A-Z</option>
            <option value="status">Status</option>
          </select>
        </div>
      </div>
    </div>

    <!-- Papers List -->
    <div class="space-y-6" id="papers-container">\

    @foreach ($papers as $paper)
      
      <!-- Paper Card 1 - Accepted -->
      <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-green-500" data-status="Accepted">
        <div class="p-6">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-xl font-bold text-gray-900">{{$paper->title}}</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100
                    text-green-800
                ">
                  <i class="fas fa-check-circle mr-1"></i>
                   {{$paper->status}}
                </span>
              </div>
              
              <p class="text-gray-600 mb-4 line-clamp-2">
                 {{$paper->abstract}}
              </p>
              
              <div class="flex flex-wrap items-center text-sm text-gray-500 space-x-6 mb-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar mr-2"></i>
                  Submitted: {{ $paper->created_at->format('F j, Y') }}
                </div>
                <div class="flex items-center">
                  <i class="fas fa-star mr-2"></i>
                  Review Score: 8.5/10
                </div>
                <div class="flex items-center">
                  <i class="fas fa-tags mr-2"></i>
                  
                </div>
              </div>
              
              <!-- Review Progress -->
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Review Progress</span>
                  <span>3/3 Reviews Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                </div>
              </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col space-y-2 ml-6">
              <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-eye mr-1"></i> View Details
              </button>
              <button class="text-green-600 hover:text-green-800 text-sm font-medium">
                <i class="fas fa-download mr-1"></i> Download PDF
              </button>
              <button class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                <i class="fas fa-comment mr-1"></i> View Reviews
              </button>
            </div>
          </div>
        </div>
      </div>

      <!-- Paper Card 2 - Under Review -->
      {{-- <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-yellow-500" data-status="Under Review">
        <div class="p-6">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-xl font-bold text-gray-900">Quantum Computing Applications in Cryptography</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                  <i class="fas fa-clock mr-1"></i>
                  Under Review
                </span>
              </div>
              
              <p class="text-gray-600 mb-4 line-clamp-2">
                An exploration of quantum computing algorithms and their potential applications in modern cryptographic systems. 
                This research focuses on post-quantum cryptography challenges...
              </p>
              
              <div class="flex flex-wrap items-center text-sm text-gray-500 space-x-6 mb-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar mr-2"></i>
                  Submitted: May 20, 2025
                </div>
                <div class="flex items-center">
                  <i class="fas fa-hourglass-half mr-2"></i>
                  Days in Review: 20
                </div>
                <div class="flex items-center">
                  <i class="fas fa-tags mr-2"></i>
                  quantum computing, cryptography, security
                </div>
              </div>
              
              <!-- Review Progress -->
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Review Progress</span>
                  <span>2/3 Reviews Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-yellow-500 h-2 rounded-full" style="width: 67%"></div>
                </div>
              </div>
            </div>
            
            <div class="flex flex-col space-y-2 ml-6">
              <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-eye mr-1"></i> View Details
              </button>
              <button class="text-green-600 hover:text-green-800 text-sm font-medium">
                <i class="fas fa-download mr-1"></i> Download PDF
              </button>
              <button class="text-gray-400 text-sm font-medium cursor-not-allowed">
                <i class="fas fa-comment mr-1"></i> Reviews Pending
              </button>
            </div>
          </div>
        </div>
      </div> --}}

      <!-- Paper Card 3 - Under Review -->
      {{-- <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-yellow-500" data-status="Under Review">
        <div class="p-6">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-xl font-bold text-gray-900">Deep Learning for Natural Language Processing</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                  <i class="fas fa-clock mr-1"></i>
                  Under Review
                </span>
              </div>
              
              <p class="text-gray-600 mb-4 line-clamp-2">
                This study investigates advanced deep learning architectures for natural language understanding tasks. 
                We propose a novel transformer-based model that significantly improves performance...
              </p>
              
              <div class="flex flex-wrap items-center text-sm text-gray-500 space-x-6 mb-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar mr-2"></i>
                  Submitted: June 1, 2025
                </div>
                <div class="flex items-center">
                  <i class="fas fa-hourglass-half mr-2"></i>
                  Days in Review: 8
                </div>
                <div class="flex items-center">
                  <i class="fas fa-tags mr-2"></i>
                  deep learning, NLP, transformers
                </div>
              </div>
              
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Review Progress</span>
                  <span>1/3 Reviews Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-yellow-500 h-2 rounded-full" style="width: 33%"></div>
                </div>
              </div>
            </div>
            
            <div class="flex flex-col space-y-2 ml-6">
              <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-eye mr-1"></i> View Details
              </button>
              <button class="text-green-600 hover:text-green-800 text-sm font-medium">
                <i class="fas fa-download mr-1"></i> Download PDF
              </button>
              <button class="text-gray-400 text-sm font-medium cursor-not-allowed">
                <i class="fas fa-comment mr-1"></i> Reviews Pending
              </button>
            </div>
          </div>
        </div>
      </div> --}}

      <!-- Paper Card 4 - Accepted -->
      {{-- <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-green-500" data-status="Accepted">
        <div class="p-6">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-xl font-bold text-gray-900">Blockchain Technology in Supply Chain Management</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                  <i class="fas fa-check-circle mr-1"></i>
                  Accepted
                </span>
              </div>
              
              <p class="text-gray-600 mb-4 line-clamp-2">
                A comprehensive analysis of blockchain implementation in supply chain systems. This research demonstrates 
                improved transparency and traceability across various industry sectors...
              </p>
              
              <div class="flex flex-wrap items-center text-sm text-gray-500 space-x-6 mb-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar mr-2"></i>
                  Submitted: February 10, 2025
                </div>
                <div class="flex items-center">
                  <i class="fas fa-star mr-2"></i>
                  Review Score: 9.2/10
                </div>
                <div class="flex items-center">
                  <i class="fas fa-tags mr-2"></i>
                  blockchain, supply chain, transparency
                </div>
              </div>
              
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Review Progress</span>
                  <span>3/3 Reviews Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-green-500 h-2 rounded-full" style="width: 100%"></div>
                </div>
              </div>
            </div>
            
            <div class="flex flex-col space-y-2 ml-6">
              <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-eye mr-1"></i> View Details
              </button>
              <button class="text-green-600 hover:text-green-800 text-sm font-medium">
                <i class="fas fa-download mr-1"></i> Download PDF
              </button>
              <button class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                <i class="fas fa-comment mr-1"></i> View Reviews
              </button>
            </div>
          </div>
        </div>
      </div> --}}

      <!-- Paper Card 5 - Rejected -->
      {{-- <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 border-red-500" data-status="Rejected">
        <div class="p-6">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-xl font-bold text-gray-900">IoT Security Framework for Smart Cities</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                  <i class="fas fa-times-circle mr-1"></i>
                  Rejected
                </span>
              </div>
              
              <p class="text-gray-600 mb-4 line-clamp-2">
                This paper proposes a security framework for IoT devices in smart city infrastructures. 
                The research addresses vulnerabilities and proposes mitigation strategies...
              </p>
              
              <div class="flex flex-wrap items-center text-sm text-gray-500 space-x-6 mb-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar mr-2"></i>
                  Submitted: January 5, 2025
                </div>
                <div class="flex items-center">
                  <i class="fas fa-star mr-2"></i>
                  Review Score: 5.8/10
                </div>
                <div class="flex items-center">
                  <i class="fas fa-tags mr-2"></i>
                  IoT, security, smart cities
                </div>
              </div>
              
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Review Progress</span>
                  <span>3/3 Reviews Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="bg-red-500 h-2 rounded-full" style="width: 100%"></div>
                </div>
              </div>
              
              <!-- Rejection Notice -->
              <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-4">
                <div class="flex">
                  <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-red-400"></i>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm text-red-700">
                      <strong>Rejection Reason:</strong> The methodology needs significant improvement and the literature review is insufficient. 
                      Please address reviewer comments before resubmission.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="flex flex-col space-y-2 ml-6">
              <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-eye mr-1"></i> View Details
              </button>
              <button class="text-green-600 hover:text-green-800 text-sm font-medium">
                <i class="fas fa-download mr-1"></i> Download PDF
              </button>
              <button class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                <i class="fas fa-comment mr-1"></i> View Reviews
              </button>
              <button class="text-orange-600 hover:text-orange-800 text-sm font-medium">
                <i class="fas fa-redo mr-1"></i> Resubmit
              </button>
            </div>
          </div>
        </div>
      </div> --}}

    @endforeach

    </div>

    <!-- Empty State (hidden when papers exist) -->
    <div class="hidden text-center py-12" id="empty-state">
      <div class="mx-auto h-24 w-24 text-gray-400">
        <i class="fas fa-file-alt text-6xl"></i>
      </div>
      <h3 class="mt-4 text-lg font-medium text-gray-900">No papers found</h3>
      <p class="mt-2 text-gray-500">Get started by submitting your first research paper.</p>
      <div class="mt-6">
        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
          <i class="fas fa-plus mr-2"></i>
          Submit Your First Paper
        </a>
      </div>
    </div>

    <!-- Pagination -->
    <div class="mt-8 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6 rounded-lg shadow-md">
      <div class="flex flex-1 justify-between sm:hidden">
        <a href="#" class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
        <a href="#" class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
      </div>
      <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700">
            Showing <span class="font-medium">1</span> to <span class="font-medium">5</span> of <span class="font-medium">5</span> results
          </p>
        </div>
        <div>
          <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
            <a href="#" class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
              <span class="sr-only">Previous</span>
              <i class="fas fa-chevron-left"></i>
            </a>
            <a href="#" aria-current="page" class="relative z-10 inline-flex items-center bg-blue-600 px-4 py-2 text-sm font-semibold text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">1</a>
            <a href="#" class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
              <span class="sr-only">Next</span>
              <i class="fas fa-chevron-right"></i>
            </a>
          </nav>
        </div>
      </div>
    </div>
</div>
