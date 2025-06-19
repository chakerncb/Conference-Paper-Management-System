<div>
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            <i class="fas fa-check-circle mr-2"></i>
            {{ session('message') }}
        </div>
    @endif

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
            <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search reviews..." 
                   class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64">
          </div>
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

    @if($reviews->total() > 0)
    <div class="bg-gray-50 rounded-lg p-4 mb-6 flex items-center justify-between">
      <div class="flex items-center space-x-4">
        <span class="text-sm text-gray-600">
          Showing {{ $reviews->count() }} of {{ $reviews->total() }} reviews
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
    @forelse ($reviews as $review)
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
              <div class="flex justify-between items-start mb-3">
                <h3 class="font-semibold text-gray-800 text-lg">{{$review->paper->title}}</h3>
                <div class="flex space-x-2">
                  @if($review->score)
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                      Completed (Score: {{ $review->score }}/10)
                    </span>
                  @else
                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-xs font-medium">Pending</span>
                  @endif
                </div>
              </div>
              <p class="text-gray-600 text-sm mb-3">Assigned: {{ $review->created_at->format('F j, Y') }} </p>
              <p class="text-gray-700 mb-4">Abstract: {{$review->paper->abstract}} </p>
              
              @if($review->score && $review->comments)
                <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                  <h4 class="font-medium text-green-800 mb-2">Your Review:</h4>
                  <p class="text-sm text-green-700 mb-2"><strong>Score:</strong> {{ $review->score }}/10</p>
                  <p class="text-sm text-green-700"><strong>Comments:</strong> {{ Str::limit($review->comments, 100) }}</p>
                </div>
              @endif
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                  <span><i class="fas fa-user mr-1"></i> Dr. {{$review->reviewer->name}}</span>
                  <span><i class="fas fa-tags mr-1"></i> {{$review->paper->keywords}}</span> 
                </div>
                <div class="flex space-x-2">
                  <button wire:click="openReviewForm({{ $review->id }})" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors duration-200">
                    {{ $review->score ? 'Edit Review' : 'Start Review' }}
                  </button>
                  <a href="{{route('paper.print', $review->paper->file_path)}}"  target="_blank" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors duration-200">
                    Show PDF
                  </a>
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
            No reviews match your search criteria
          @else
            No reviews found
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
          <a href="{{route('paper.create')}}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
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

    @if($reviews->hasPages())
    <div class="mt-8">
      {{ $reviews->links() }}
    </div>
    @endif

    <!-- Review Form Modal -->
    @if($showReviewForm)
    <div class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50" id="review-modal">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-3/4 lg:w-1/2 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <!-- Modal Header -->
                <div class="flex items-center justify-between pb-4 border-b">
                    <h3 class="text-lg font-bold text-gray-900">Submit Review</h3>
                    <button wire:click="closeReviewForm" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <!-- Success Message -->
                @if (session()->has('message'))
                    <div class="mt-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Form -->
                <form wire:submit.prevent="submitReview" class="mt-6">
                    <!-- Score Input -->
                    <div class="mb-6">
                        <label for="score" class="block text-sm font-medium text-gray-700 mb-2">
                            Score (1-10) <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="score" id="score" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500">
                            <option value="">Select a score</option>
                            @for($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}">{{ $i }} - {{ $i <= 3 ? 'Poor' : ($i <= 5 ? 'Fair' : ($i <= 7 ? 'Good' : 'Excellent')) }}</option>
                            @endfor
                        </select>
                        @if ($errors->has('score'))
                            <div class="text-red-500 text-sm mt-1">{{ $errors->first('score') }}</div> 
                        @endif
                    </div>

                    <!-- Comments Input -->
                    <div class="mb-6">
                        <label for="comments" class="block text-sm font-medium text-gray-700 mb-2">
                            Comments <span class="text-red-500">*</span>
                        </label>
                        <textarea wire:model.live="comments" id="comments" rows="6" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                                placeholder="Please provide detailed feedback about the paper..."></textarea>
                        @if ($errors->has('comments'))
                            <div class="text-red-500 text-sm mt-1">{{ $errors->first('comments') }}</div> 
                        @endif
                        <div class="text-sm text-gray-500 mt-1 flex justify-between">
                            <span>Minimum 10 characters, maximum 1000 characters</span>
                            <span>{{ strlen($comments ?? '') }}/1000</span>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex items-center justify-end space-x-4">
                        <button type="button" wire:click="closeReviewForm" 
                                class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Cancel
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 bg-purple-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            Submit Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
