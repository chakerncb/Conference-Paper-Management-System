<div class="max-w-full">
    <div class="w-full overflow-hidden rounded-lg shadow-sm">
        <div class="px-4 sm:px-6 py-4 mb-6 bg-white rounded-lg shadow-md dark:bg-gray-800 border border-gray-200 dark:border-gray-700">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                        Papers Management
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        Manage and review papers in the system.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <div class="flex items-center space-x-2">
                        <label for="perPage" class="text-sm font-medium text-gray-700 dark:text-gray-300">
                            Per page:
                        </label>
                        <select 
                            id="perPage"
                            wire:model="perPage" 
                            wire:change="changePerPage($event.target.value)"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:focus:ring-blue-400 transition-colors"
                            aria-label="Select number of items per page">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-md border border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-700">
                            <th class="px-4 py-3 min-w-[120px]">Author</th>
                            <th class="px-4 py-3 min-w-[200px]">Title</th>
                            <th class="px-4 py-3 min-w-[250px] hidden lg:table-cell">Abstract</th>
                            <th class="px-4 py-3 min-w-[150px]  md:table-cell">Keywords</th>
                            <th class="px-4 py-3 min-w-[100px]">Status</th>
                            <th class="px-4 py-3 min-w-[140px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($papers as $paper)
                        <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 mr-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            {{strtoupper(substr($paper->author->name, 0, 1))}}
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                                            {{$paper->author->name}}
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                            {{$paper->author->email ?? 'No email'}}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                    <div class="line-clamp-2" title="{{$paper->title}}">
                                        {{$paper->title}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4  lg:table-cell">
                                <div class="max-w-md">
                                    <div class="cursor-pointer" wire:click="toggleAbstract({{ $paper->id }})">
                                        @if(isset($expandedAbstracts[$paper->id]) && $expandedAbstracts[$paper->id])
                                            <div class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">
                                                {{ $paper->abstract }}
                                            </div>
                                            <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-xs mt-2 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
                                                Click to collapse
                                            </button>
                                        @else
                                            <div class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">
                                                <div class="line-clamp-3">
                                                    {{ $paper->abstract }}
                                                </div>
                                            </div>
                                            @if(strlen($paper->abstract) > 150)
                                                <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-xs mt-1 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
                                                    Click to read more
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4  md:table-cell">
                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                    <div class="line-clamp-2" title="{{$paper->keywords}}">
                                        {{$paper->keywords}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                    @if($paper->status === 'approved') 
                                        bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200
                                    @elseif($paper->status === 'rejected')
                                        bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200
                                    @elseif($paper->status === 'under_review')
                                        bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200
                                    @else
                                        bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-200
                                    @endif">
                                    {{ucfirst(str_replace('_', ' ', $paper->status))}}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center space-x-2">
                                    <button
                                        class="inline-flex items-center justify-center w-8 h-8 text-purple-600 bg-purple-100 rounded-lg hover:bg-purple-200 dark:text-purple-400 dark:bg-purple-900 dark:hover:bg-purple-800 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors"
                                        aria-label="Assign Reviewers"
                                        wire:click="toggleReviewerForm({{ $paper->id }})"
                                        title="@if($paper->reviews->count() > 0) Manage Reviewers @else Assign Reviewers @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </button>
                                    <button
                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 bg-red-100 rounded-lg hover:bg-red-200 dark:text-red-400 dark:bg-red-900 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors"
                                        aria-label="Delete"
                                        wire:click="deletepaper({{ $paper->id }})">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <button
                                        class="inline-flex items-center justify-center w-8 h-8 text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200 dark:text-blue-400 dark:bg-blue-900 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                                        aria-label="View PDF"
                                        wire:click="streamPdf({{ $paper->id }})">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        {{-- Inline Reviewer Form --}}
                        @if($showFormForPaper === $paper->id)
                            <tr class="bg-gray-50 dark:bg-gray-700">
                                <td colspan="6" class="px-4 py-6">
                                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-600 p-6">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                                                Assign Reviewers for "<span class="text-blue-600">{{ Str::limit($paper->title, 50) }}</span>"
                                            </h3>
                                            <button 
                                                type="button"
                                                wire:click="cancelReviewerSelection"
                                                class="self-start sm:self-center text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        
                                        @if($paper->reviews->count() > 0)
                                            <div class="mb-4 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg border border-yellow-200 dark:border-yellow-700">
                                                <h4 class="text-sm font-medium text-yellow-800 dark:text-yellow-200 mb-3 flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Currently Assigned Reviewers:
                                                </h4>
                                                <div class="space-y-2">
                                                    @foreach($paper->reviews as $review)
                                                        <div class="flex items-center gap-2 text-sm text-yellow-700 dark:text-yellow-300">
                                                            <svg class="w-4 h-4 text-yellow-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="font-medium">{{ $review->reviewer->name }}</span>
                                                            <span class="text-yellow-600 dark:text-yellow-400">({{ $review->reviewer->email }})</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if($paper->reviews->count() >= 2)
                                                    <p class="text-xs text-yellow-600 dark:text-yellow-400 mt-3 p-2 bg-yellow-100 dark:bg-yellow-800/30 rounded">
                                                        ⚠️ This paper already has the maximum number of reviewers assigned.
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                        
                                        <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-700">
                                            <p class="text-sm text-blue-700 dark:text-blue-300">
                                                @if($paper->reviews->count() >= 2)
                                                    📝 This paper already has 2 reviewers assigned. You can assign additional reviewers if needed.
                                                @else
                                                    📋 Select <span class="font-semibold">exactly 2 reviewers</span> for this paper.
                                                @endif
                                            </p>
                                        </div>

                                        {{-- Search Box --}}
                                        <div class="mb-6">
                                            <label for="reviewer-search" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                Search Reviewers
                                            </label>
                                            <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 20 20">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                                    </svg>
                                                </div>
                                                <input
                                                    id="reviewer-search"
                                                    type="text"
                                                    wire:model.live.debounce.300ms="searchTerm"
                                                    placeholder="Search by name or email..."
                                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-400 transition-colors"
                                                />
                                            </div>
                                        </div>

                                        {{-- Reviewers Table --}}
                                        @if($reviewers->isEmpty())
                                            <div class="text-center py-12">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No reviewers found</h3>
                                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search terms.</p>
                                            </div>
                                        @else
                                            <div class="overflow-hidden rounded-lg border border-gray-200 dark:border-gray-600 mb-4">
                                                <div class="overflow-x-auto">
                                                    <table class="w-full divide-y divide-gray-200 dark:divide-gray-600">
                                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                                            <tr>
                                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                    Select
                                                                </th>
                                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                    Reviewer
                                                                </th>
                                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                                                    Email
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-600">
                                                            @foreach($reviewers as $reviewer)
                                                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <input 
                                                                            type="checkbox" 
                                                                            wire:click="selectReviewer({{ $reviewer->id }})"
                                                                            @if(in_array($reviewer->id, $selectedReviewers)) checked @endif
                                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 dark:border-gray-600 rounded"
                                                                            @if(count($selectedReviewers) >= 2 && !in_array($reviewer->id, $selectedReviewers)) disabled @endif
                                                                        />
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <div class="flex items-center">
                                                                            <div class="flex-shrink-0 w-8 h-8 mr-3">
                                                                                <div class="w-8 h-8 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                                                                    {{strtoupper(substr($reviewer->name, 0, 1))}}
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">
                                                                                    {{ $reviewer->name }} {{ $reviewer->last_name ?? '' }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                                                        {{ $reviewer->email }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            
                                            {{-- Pagination --}}
                                            <div class="flex justify-center mb-4">
                                                {{ $reviewers->links() }}
                                            </div>
                                        @endif

                                        {{-- Selection Info --}}
                                        <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-700">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="text-sm font-medium text-blue-700 dark:text-blue-300">
                                                        Selected reviewers: <span class="font-bold">{{ count($selectedReviewers) }}/2</span>
                                                    </span>
                                                </div>
                                                @if(count($selectedReviewers) === 2)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                        Ready to assign
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Buttons --}}
                                        <div class="flex flex-col sm:flex-row justify-end gap-3">
                                            <button 
                                                type="button"
                                                wire:click="cancelReviewerSelection"
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-600 dark:hover:bg-gray-600 transition-colors"
                                            >
                                                Cancel
                                            </button>
                                            <button 
                                                type="button"
                                                wire:click="submitReviewers"
                                                class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors"
                                                @if(count($selectedReviewers) !== 2) disabled @endif
                                            >
                                                @if(count($selectedReviewers) === 2)
                                                    Assign Reviewers
                                                @else
                                                    Select 2 Reviewers
                                                @endif
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            </div>
            
            <div class="px-4 sm:px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="text-sm text-gray-700 dark:text-gray-300">
                        @if($papers->total() > 0)
                            Showing <span class="font-medium">{{ $papers->firstItem() }}</span> to 
                            <span class="font-medium">{{ $papers->lastItem() }}</span> of 
                            <span class="font-medium">{{ $papers->total() }}</span> papers
                        @else
                            No papers found
                        @endif
                    </div>
                    <div class="flex justify-center sm:justify-end">
                        {{ $papers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
