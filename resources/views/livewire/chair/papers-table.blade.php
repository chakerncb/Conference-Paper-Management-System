<div class="max-w-full">
    <div class="w-full overflow-hidden rounded-lg shadow-sm">
        <div class="px-4 sm:px-6 py-4 mb-6 bg-gradient-to-r from-indigo-50 to-purple-50 rounded-lg shadow-md border border-indigo-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">
                        Papers Management
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">
                        Manage and review papers in the system.
                    </p>
                </div>
                <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    <div class="flex items-center space-x-2">
                        <label for="perPage" class="text-sm font-medium text-gray-700">
                            Per page:
                        </label>
                        <select 
                            id="perPage"
                            wire:model="perPage" 
                            wire:change="changePerPage($event.target.value)"
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
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
        
        <div class="bg-gradient-to-b from-white to-indigo-50 rounded-lg shadow-md border border-indigo-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-white uppercase border-b border-blue-300 bg-gradient-to-r from-blue-500 to-blue-600"> 
                            <th class="px-4 py-3 min-w-[120px]">Author</th>
                            <th class="px-4 py-3 min-w-[200px]">Title</th>
                            <th class="px-4 py-3 min-w-[250px] hidden lg:table-cell">Abstract</th>
                            <th class="px-4 py-3 min-w-[150px]  md:table-cell">Keywords</th>
                            <th class="px-4 py-3 min-w-[100px]">Status</th>
                            <th class="px-4 py-3 min-w-[140px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gradient-to-b from-indigo-50 to-white divide-y divide-indigo-100 ">
                    @foreach ($papers as $paper)
                         <tr class="text-gray-700 hover:bg-blue-100 transition-colors duration-150 border-l-4 border-transparent hover:border-blue-500">
                            <td class="px-4 py-4">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-8 h-8 mr-3">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white text-sm font-semibold">
                                            {{strtoupper(substr($paper->author->name, 0, 1))}}
                                        </div>
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <p class="text-sm font-semibold text-gray-900 truncate">
                                            {{$paper->author->name}}
                                        </p>
                                        <p class="text-xs text-gray-500 truncate">
                                            {{$paper->author->email ?? 'No email'}}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <div class="text-sm font-medium text-gray-900">
                                    <div class="line-clamp-2" title="{{$paper->title}}">
                                        {{$paper->title}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4  lg:table-cell">
                                <div class="max-w-md">
                                    <div class="cursor-pointer" wire:click="toggleAbstract({{ $paper->id }})">
                                        @if(isset($expandedAbstracts[$paper->id]) && $expandedAbstracts[$paper->id])
                                            <div class="text-sm text-gray-700 leading-relaxed whitespace-pre-wrap">
                                                {{ $paper->abstract }}
                                            </div>
                                            <button class="text-blue-600 hover:text-blue-800 text-xs mt-2 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
                                                Click to collapse
                                            </button>
                                        @else
                                            <div class="text-sm text-gray-600 leading-relaxed">
                                                <div class="line-clamp-3">
                                                    {{ $paper->abstract }}
                                                </div>
                                            </div>
                                            @if(strlen($paper->abstract) > 150)
                                                <button class="text-blue-600 hover:text-blue-800 text-xs mt-1 font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 rounded">
                                                    Click to read more
                                                </button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4  md:table-cell">
                                <div class="text-sm text-gray-600">
                                    <div class="line-clamp-2" title="{{$paper->keywords}}">
                                        {{$paper->keywords}}
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                    @if($paper->status === 'approved') 
                                        bg-green-100 text-green-800
                                    @elseif($paper->status === 'rejected')
                                        bg-red-100 text-red-800
                                    @elseif($paper->status === 'under_review')
                                        bg-yellow-100 text-yellow-800
                                    @else
                                        bg-gray-100 text-gray-800
                                    @endif">
                                    {{ucfirst(str_replace('_', ' ', $paper->status))}}
                                </span>
                            </td>
                            <td class="px-4 py-4">
                                <div class="flex items-center space-x-2">
                                    <button
                                        class="inline-flex items-center justify-center w-8 h-8 text-purple-600 bg-purple-100 rounded-lg hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-purple-500 transition-colors"
                                        aria-label="Assign Reviewers"
                                        wire:click="toggleReviewerForm({{ $paper->id }})"
                                        title="@if($paper->reviews->count() > 0) Manage Reviewers @else Assign Reviewers @endif">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20" version="1.1" fill="#000000">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
                                            <g id="SVGRepo_iconCarrier"> <g id="layer1"> <path d="M 9.5 0 C 8.1252105 0 7 1.1252105 7 2.5 C 7 3.0633617 7.1940199 3.5807403 7.5117188 4 L 7.5 4 C 6.1252115 4 5 5.12521 5 6.5 L 5 10.5 C 5 11.702941 5.8636264 12.715051 7 12.949219 L 7 18.5 C 7 19.328427 7.6715729 20 8.5 20 L 10.5 20 C 11.328427 20 12 19.328427 12 18.5 L 12 18 L 11 18 L 11 18.5 C 11 18.776142 10.776142 19 10.5 19 L 10 19 L 10 13.5 C 10 13.223858 9.7761424 13 9.5 13 C 9.2238576 13 9 13.223858 9 13.5 L 9 19 L 8.5 19 C 8.2238576 19 8 18.776142 8 18.5 L 8 7.5 C 8 7.2238576 7.7761424 7 7.5 7 C 7.2238576 7 7 7.2238576 7 7.5 L 7 11.910156 C 6.4161964 11.705514 6 11.157682 6 10.5 L 6 6.5 C 6 5.66565 6.6656505 5 7.5 5 L 7.5117188 5 C 8.0640035 5 8.5117188 4.5522847 8.5117188 4 C 8.5111563 3.7827376 8.4403749 3.5712202 8.28125 3.3574219 C 8.1221251 3.1436236 8 2.8417718 8 2.5 C 8 1.6656505 8.6656505 1 9.5 1 C 10.33435 1 11 1.6656505 11 2.5 C 11 2.8417718 10.877896 3.1436223 10.71875 3.3574219 C 10.559605 3.5712214 10.488843 3.7827376 10.488281 4 C 10.488281 4.5522847 10.935996 5 11.488281 5 L 11.5 5 C 12.33435 5 13 5.66565 13 6.5 L 13 10.5 C 13 11.157682 12.583804 11.705514 12 11.910156 L 12 7.5 C 12 7.2238576 11.776142 7 11.5 7 C 11.223858 7 11 7.2238576 11 7.5 L 11 15 L 12 15 L 12 12.949219 L 12.001953 12.949219 C 13.138186 12.715051 14 11.702941 14 10.5 L 14 6.5 C 14 5.12521 12.874789 4 11.5 4 L 11.488281 4 C 11.805983 3.5807403 12 3.0633617 12 2.5 C 12 1.1252105 10.87479 0 9.5 0 z M 4.5 1 C 4.285138 1.0000001 4.0801864 1.0362656 3.8808594 1.0878906 C 3.8543284 1.0951006 3.8289194 1.1032691 3.8027344 1.1113281 C 3.6122454 1.16746 3.4326019 1.2442769 3.2636719 1.3417969 C 2.5137879 1.7746902 2 2.5766257 2 3.5 C 2 4.0633617 2.1940148 4.5807403 2.5117188 5 L 2.5 5 C 1.125211 5 0 6.12521 0 7.5 L 0 10.5 C 0 11.702941 0.8619078 12.715051 1.9980469 12.949219 L 2 12.949219 L 2 16.5 C 2 17.328427 2.671573 18 3.5 18 L 5 18 L 6 18 L 6 17 L 5 17 L 5 14.910156 L 5 13.5 C 5 13.223858 4.776142 13 4.5 13 C 4.223858 13 4 13.223858 4 13.5 L 4 17 L 3.5 17 C 3.223858 17 3 16.776142 3 16.5 L 3 8.5 C 3 8.2238576 2.776142 8 2.5 8 C 2.223858 8 2 8.2238576 2 8.5 L 2 11.910156 C 1.416196 11.705514 1 11.157682 1 10.5 L 1 7.5 C 1 6.66565 1.66565 6 2.5 6 L 2.5117188 6 C 3.0640037 6 3.5117188 5.5522848 3.5117188 5 C 3.5111454 4.782732 3.440444 4.5712218 3.28125 4.3574219 C 3.122056 4.1436221 3 3.8417718 3 3.5 C 3 2.6656506 3.66565 2 4.5 2 C 4.788118 2 5.0528871 2.081448 5.2050781 2.1738281 C 5.3572691 2.2662081 5.4473025 2.2925337 5.5390625 2.2929688 C 5.8152055 2.2929688 6.0390625 2.0691111 6.0390625 1.7929688 C 6.0390215 1.641509 5.9671356 1.5075681 5.8847656 1.4394531 C 5.8023906 1.3713371 5.7722744 1.3560969 5.7402344 1.3417969 C 5.3733144 1.128618 4.952744 1 4.5 1 z M 14.5 1 C 14.047256 1 13.626686 1.128618 13.259766 1.3417969 C 13.227726 1.3560969 13.197606 1.3713371 13.115234 1.4394531 C 13.032864 1.5075681 12.960978 1.641509 12.960938 1.7929688 C 12.960938 2.0691111 13.184795 2.2929688 13.460938 2.2929688 C 13.552698 2.2925337 13.642731 2.2662078 13.794922 2.1738281 C 13.947113 2.0814485 14.211882 2 14.5 2 C 15.33435 2 16 2.6656505 16 3.5 C 16 3.8417718 15.877944 4.1436221 15.71875 4.3574219 C 15.559556 4.5712218 15.488854 4.782732 15.488281 5 C 15.488281 5.5522847 15.935996 6 16.488281 6 L 16.5 6 C 17.33435 6 18 6.66565 18 7.5 L 18 10.5 C 18 11.157682 17.583804 11.705514 17 11.910156 L 17 8.5 C 17 8.2238576 16.776142 8 16.5 8 C 16.223858 8 16 8.2238576 16 8.5 L 16 12 L 16.5 12 L 16.914062 12 L 17.630859 12.716797 C 18.438651 12.301121 19 11.466383 19 10.5 L 19 7.5 C 19 6.12521 17.874789 5 16.5 5 L 16.488281 5 C 16.805987 4.5807403 17 4.0633617 17 3.5 C 17 2.5766256 16.486212 1.7746902 15.736328 1.3417969 C 15.567398 1.2442766 15.387755 1.1674598 15.197266 1.1113281 C 15.171081 1.1032638 15.145672 1.0950959 15.119141 1.0878906 C 14.919814 1.0362653 14.714862 1 14.5 1 z M 15 13 L 18 16 L 11 16 L 11 17 L 18 17 L 15 20 L 16.5 20 L 20 16.5 L 16.5 13 L 15 13 z " style="fill:#222222; fill-opacity:1; stroke:none; stroke-width:0px;"/> </g> </g>
                                        </svg>
                                    </button>
                                    <button
                                        class="inline-flex items-center justify-center w-8 h-8 text-red-600 bg-red-100 rounded-lg hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors"
                                        aria-label="Delete"
                                        wire:click="deletepaper({{ $paper->id }})">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                    </button>
                                    <a
                                        class="inline-flex items-center justify-center w-8 h-8 text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                                        aria-label="View PDF"
                                        href="{{ route('paper.print', $paper->file_path) }}"
                                        target="_blank">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        
                        {{-- Inline Reviewer Form --}}
                        @if($showFormForPaper === $paper->id)
                            <tr class="bg-gray-50">
                                <td colspan="6" class="px-4 py-6">
                                    <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6">
                                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 gap-3">
                                            <h3 class="text-lg font-semibold text-gray-800">
                                                Assign Reviewers for "<span class="text-blue-600">{{ Str::limit($paper->title, 50) }}</span>"
                                            </h3>
                                            <button 
                                                type="button"
                                                wire:click="cancelReviewerSelection"
                                                class="self-start sm:self-center text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100 transition-colors">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </div>
                                        
                                        @if($paper->reviews->count() > 0)
                                            <div class="mb-4 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                                <h4 class="text-sm font-medium text-yellow-800 mb-3 flex items-center gap-2">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    Currently Assigned Reviewers:
                                                </h4>
                                                <div class="space-y-2">
                                                    @foreach($paper->reviews as $review)
                                                        <div class="flex items-center gap-2 text-sm text-yellow-700">
                                                            <svg class="w-4 h-4 text-yellow-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="font-medium">{{ $review->reviewer->name }}</span>
                                                            <span class="text-yellow-600">({{ $review->reviewer->email }})</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                @if($paper->reviews->count() >= 2)
                                                    <p class="text-xs text-yellow-600 mt-3 p-2 bg-yellow-100 rounded">
                                                        ⚠️ This paper already has the maximum number of reviewers assigned.
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                        
                                        <div class="mb-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                                            <p class="text-sm text-blue-700">
                                                @if($paper->reviews->count() >= 2)
                                                    📝 This paper already has 2 reviewers assigned. You can assign additional reviewers if needed.
                                                @else
                                                    📋 Select <span class="font-semibold">exactly 2 reviewers</span> for this paper.
                                                @endif
                                            </p>
                                        </div>

                                        {{-- Search Box --}}
                                        <div class="mb-6">
                                            <label for="reviewer-search" class="block text-sm font-medium text-gray-700 mb-2">
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
                                                    class="block w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                                />
                                            </div>
                                        </div>

                                        {{-- Reviewers Table --}}
                                        @if($reviewers->isEmpty())
                                            <div class="text-center py-12">
                                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900">No reviewers found</h3>
                                                <p class="mt-1 text-sm text-gray-500">Try adjusting your search terms.</p>
                                            </div>
                                        @else
                                            <div class="overflow-hidden rounded-lg border border-gray-200 mb-4">
                                                <div class="overflow-x-auto">
                                                    <table class="w-full divide-y divide-gray-200">
                                                        <thead class="bg-gray-50">
                                                            <tr>
                                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Select
                                                                </th>
                                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Reviewer
                                                                </th>
                                                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                                    Email
                                                                </th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="bg-white divide-y divide-gray-200">
                                                            @foreach($reviewers as $reviewer)
                                                                <tr class="hover:bg-gray-50 transition-colors">
                                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                                        <input 
                                                                            type="checkbox" 
                                                                            wire:click="selectReviewer({{ $reviewer->id }})"
                                                                            @if(in_array($reviewer->id, $selectedReviewers)) checked @endif
                                                                            class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
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
                                                                                <div class="text-sm font-medium text-gray-900">
                                                                                    {{ $reviewer->name }} {{ $reviewer->last_name ?? '' }}
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
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
                                        <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-2">
                                                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="text-sm font-medium text-blue-700">
                                                        Selected reviewers: <span class="font-bold">{{ count($selectedReviewers) }}/2</span>
                                                    </span>
                                                </div>
                                                @if(count($selectedReviewers) === 2)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
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
                                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
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
            
            <div class="px-4 sm:px-6 py-3 bg-gradient-to-r from-indigo-50 to-purple-50 border-t border-indigo-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div class="text-sm text-gray-700">
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
