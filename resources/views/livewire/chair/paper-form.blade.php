{{-- <div>
  <div class="bg-white shadow-2xl rounded-xl border w-full max-w-4xl max-h-[85vh] overflow-y-auto">

    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
      <h2 class="text-2xl font-semibold text-white">Pick Reviewers</h2>
      <button 
        type="button"
        @click="$dispatch('close-modal')"
        class="text-black hover:text-gray-200 p-2 rounded-full hover:bg-blue-800 transition">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Body -->
    <div class="px-6 py-6">
      <p class="text-sm text-gray-600 mb-4">
        Select <span class="font-medium">2 reviewers</span> for the paper.
      </p>

      <!-- Search Box -->
      <div class="mb-6 max-w-md mx-auto">
        <label for="reviewer-search" class="sr-only">Search :</label>
        <br>
        <div class="relative">
          <span class="absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 20 20">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
          </span>
          <input
            id="reviewer-search"
            type="text"
            wire:model.live.debounce.300ms="searchTerm"
            placeholder="Search by name or email..."
            class="w-full pl-10 pr-4 py-3 rounded-lg border border-gray-300 bg-white shadow focus:ring-2 focus:ring-blue-500 focus:outline-none text-sm placeholder-gray-500 transition-all"
          />
        </div>
      </div>

      <!-- Reviewers Table -->
      <form wire:submit.prevent="submit" class="space-y-6">
        @if($reviewers->isEmpty())
          <div class="text-center text-gray-500 py-10">No reviewers available.</div>
        @else
          <div class="overflow-x-auto rounded-lg shadow-sm border border-gray-200">
            <table class="w-full text-sm text-left text-gray-700">
              <thead class="bg-gray-100 text-gray-800 sticky top-0 z-10">
                <tr>
                  <th class="px-4 py-3 font-semibold">Select</th>
                  <th class="px-4 py-3 font-semibold">Full Name</th>
                  <th class="px-4 py-3 font-semibold">Email</th>
                </tr>
              </thead>
              <tbody>
                @foreach($reviewers as $reviewer)
                  <tr class="even:bg-gray-50 hover:bg-blue-50 transition-colors">
                    <td class="px-4 py-3">
                      <input 
                        type="checkbox" 
                        wire:model="selectedReviewers" 
                        value="{{ $reviewer->id }}" 
                        class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500"
                      />
                    </td>
                    <td class="px-4 py-3">{{ $reviewer->name }} {{ $reviewer->last_name }}</td>
                    <td class="px-4 py-3 text-gray-500">{{ $reviewer->email }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-6 flex justify-center">
              {{ $reviewers->links() }}
            </div>
          </div>
        @endif

        <!-- Buttons -->
        <div class="flex justify-end gap-3 pt-4 mb-4">
          <button 
            type="button"
            @click="$dispatch('close-modal')"
            class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 transition"
          >
            Cancel
          </button>
          <button 
            type="submit"
            class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
          >
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</div> --}}
