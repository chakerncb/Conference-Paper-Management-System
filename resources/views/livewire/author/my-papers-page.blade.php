<div>
    <div wire:loading.delay class="fixed top-4 right-4 z-50">
      <div class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-lg flex items-center">
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
          <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Loading...
      </div>
    </div>


    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
      <div class="flex flex-col md:flex-row md:items-center md:justify-between space-y-4 md:space-y-0">
        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
          <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
              <i class="fas fa-search text-gray-400"></i>
            </div>
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search papers..." 
                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
          </div>
          
          <select wire:model.live="statusFilter" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="">All Status</option>
            <option value="Submitted">Submitted</option>
            <option value="Under Review">Under Review</option>
            <option value="Accepted">Accepted</option>
            <option value="Rejected">Rejected</option>
          </select>
        </div>

        
        <div class="flex items-center space-x-2">
          <span class="text-sm text-gray-600">Show:</span>
          <select wire:model.live="perPage" class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <option value="5">5 per page</option>
            <option value="10">10 per page</option>
            <option value="15">15 per page</option>
            <option value="25">25 per page</option>
            <option value="50">50 per page</option>
          </select>
        </div>
      </div>
    </div>

    @if($papers->total() > 0)
    <div class="bg-gray-50 rounded-lg p-4 mb-6 flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <span class="text-sm text-gray-600">
          Showing {{ $papers->count() }} of {{ $papers->total() }} papers
        </span>
        @if($search || $statusFilter)
        <div class="flex items-center space-x-2">
          @if($search)
          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
            Search: "{{ $search }}"
            <button wire:click="clearSearch" class="ml-1 text-blue-600 hover:text-blue-800">
              <i class="fas fa-times"></i>
            </button>
          </span>
          @endif
          @if($statusFilter)
          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
            Status: {{ $statusFilter }}
            <button wire:click="clearStatusFilter" class="ml-1 text-purple-600 hover:text-purple-800">
              <i class="fas fa-times"></i>
            </button>
          </span>
          @endif
        </div>
        @endif
      </div>
      @if($search || $statusFilter)
      <button wire:click="clearFilters" class="text-sm text-gray-600 hover:text-gray-800 font-medium">
        <i class="fas fa-times-circle mr-1"></i>
        Clear All Filters
      </button>
      @endif
    </div>
    @endif

    <div class="space-y-6">
    @forelse ($papers as $paper)
      <div class="bg-white rounded-lg shadow-md overflow-hidden border-l-4 
          @if($paper->status === 'Accepted') border-green-500
          @elseif($paper->status === 'Under Review') border-yellow-500
          @elseif($paper->status === 'Rejected') border-red-500
          @else border-blue-500
          @endif" 
          data-status="{{ $paper->status }}">
        <div class="p-6">
          <div class="flex items-start justify-between">
            <div class="flex-1">
              <div class="flex items-center space-x-3 mb-2">
                <h3 class="text-xl font-bold text-gray-900">{{ $paper->title }}</h3>
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                    @if($paper->status === 'Accepted') bg-green-100 text-green-800
                    @elseif($paper->status === 'Under Review') bg-yellow-100 text-yellow-800
                    @elseif($paper->status === 'Rejected') bg-red-100 text-red-800
                    @else bg-blue-100 text-blue-800
                    @endif">
                  @if($paper->status === 'Accepted')
                    <i class="fas fa-check-circle mr-1"></i>
                  @elseif($paper->status === 'Under Review')
                    <i class="fas fa-clock mr-1"></i>
                  @elseif($paper->status === 'Rejected')
                    <i class="fas fa-times-circle mr-1"></i>
                  @else
                    <i class="fas fa-paper-plane mr-1"></i>
                  @endif
                  {{ $paper->status }}
                </span>
              </div>
              
              <p class="text-gray-600 mb-4 line-clamp-2">
                {{ $paper->abstract }}
              </p>
              
              <div class="flex flex-wrap items-center text-sm text-gray-500 space-x-6 mb-4">
                <div class="flex items-center">
                  <i class="fas fa-calendar mr-2"></i>
                  Submitted: {{ $paper->created_at->format('F j, Y') }}
                </div>
                <div class="flex items-center">
                  <i class="fas fa-star mr-2"></i>
                  Review Score: {{ $paper->reviews->avg('score') ? number_format($paper->reviews->avg('score'), 1) : 'N/A' }}/10 
                </div>
                <div class="flex items-center">
                  <i class="fas fa-tags mr-2"></i>
                  {{ $paper->keywords }}
                </div>
              </div>
              
              <div class="mb-4">
                <div class="flex justify-between text-sm text-gray-600 mb-1">
                  <span>Review Progress</span>
                  <span>{{ $paper->reviews->where('score', '!=', '')->count() }}/{{ $paper->reviews->count() }} Reviews Complete</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                  <div class="h-2 rounded-full 
                      @if($paper->status === 'Accepted') bg-green-500
                      @elseif($paper->status === 'Under Review') bg-yellow-500
                      @elseif($paper->status === 'Rejected') bg-red-500
                      @else bg-blue-500
                      @endif" 
                      style="width: {{ ($paper->reviews->count() > 0) ? ($paper->reviews->where('score', '!=', '')->count() / $paper->reviews->count()) * 100 : 0 }}%">
                  </div>
                </div>
              </div>

              @if($paper->status === 'Rejected')
              <div class="bg-red-50 border border-red-200 rounded-md p-3 mb-4">
                <div class="flex">
                  <div class="flex-shrink-0">
                    <i class="fas fa-info-circle text-red-400"></i>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm text-red-700">
                      <strong>Paper Status:</strong> This paper has been rejected. Please review the feedback and consider resubmission.
                    </p>
                  </div>
                </div>
              </div>
              @endif
            </div>
            
            <div class="flex flex-col space-y-2 ml-6">
              <a href="{{ route('paper.print', $paper->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                <i class="fas fa-eye mr-1"></i> View Details
              </a>
              <a class="text-green-600 hover:text-green-800 text-sm font-medium cursor-pointer">
                <i class="fas fa-download mr-1"></i> Download PDF
              </a>
              @if($paper->status === 'Accepted' || $paper->status === 'Rejected')
                <a class="text-purple-600 hover:text-purple-800 text-sm font-medium cursor-pointer">
                  <i class="fas fa-comment mr-1"></i> View Reviews
                </a>
              @else
                <a class="text-gray-400 text-sm font-medium cursor-not-allowed">
                  <i class="fas fa-comment mr-1"></i> Reviews Pending
                </a>
              @endif
              @if($paper->status === 'Rejected')
                <a class="text-orange-600 hover:text-orange-800 text-sm font-medium cursor-pointer">
                  <i class="fas fa-redo mr-1"></i> Resubmit
                </a>
              @endif
            </div>
          </div>
        </div>
      </div>
    @empty
      <div class="text-center py-12">
        <div class="mx-auto h-24 w-24 text-gray-400">
          <i class="fas fa-file-alt text-6xl"></i>
        </div>
        <h3 class="mt-4 text-lg font-medium text-gray-900">
          @if($search || $statusFilter)
            No papers match your search criteria
          @else
            No papers found
          @endif
        </h3>
        <p class="mt-2 text-gray-500">
          @if($search || $statusFilter)
            Try adjusting your search terms or filters.
          @else
            Get started by submitting your first research paper.
          @endif
        </p>
        @if(!$search && !$statusFilter)
        <div class="mt-6">
          <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
            <i class="fas fa-plus mr-2"></i>
            Submit Your First Paper
          </a>
        </div>
        @else
        <div class="mt-6">
          <button wire:click="clearSearch" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 mr-2">
            Clear Search
          </button>
          <button wire:click="clearStatusFilter" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
            Clear Filter
          </button>
        </div>
        @endif
      </div>
    @endforelse
    </div>

    @if($papers->hasPages())
    <div class="mt-8">
      {{ $papers->links() }}
    </div>
    @endif
</div>
