<div class="lg:col-span-2" id="pending-reviews">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-clipboard-check text-purple-500 mr-3"></i>
            Pending Reviews
          </h2>
          <div class="space-y-4">
            <!-- Sample pending review -->

            @foreach ($reviews as $review)
            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
              <div class="flex justify-between items-start mb-3">
                <h3 class="font-semibold text-gray-800 text-lg">{{$review->paper->title}}</h3>
              </div>
              <p class="text-gray-600 text-sm mb-3">Assigned: {{ $review->created_at->format('F j, Y') }} </p>
              <p class="text-gray-700 mb-4">Abstract: {{$review->paper->abstract}} </p>
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4 text-sm text-gray-500">
                   @if ($BlindReview == 0)
                  <span><i class="fas fa-user mr-1"></i> Dr. {{$review->reviewer->name}}</span>
                  @else
                  <span><i class="fas fa-user mr-1"></i>Anonymous Author</span>
                  @endif                  <span><i class="fas fa-tags mr-1"></i> {{$review->paper->keywords}}</span> 
                </div>
                <div class="flex space-x-2">
                  <a href="{{route('reviewer.reviews.index')}}" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors duration-200">
                    Start Review
                  </a>
                  <a href="{{route('paper.print', $review->paper->file_path)}}"  target="_blank" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-50 transition-colors duration-200">
                    Download PDF
                  </a>
                </div>
              </div>
            </div>
            @endforeach

          </div> 
          
          <div class="mt-6 text-center">
            <a href="{{route('reviewer.reviews.index')}}" class="text-purple-600 hover:text-purple-800 font-medium">View All Pending Reviews →</a>
          </div>
        </div>
      </div>