<div class="max-w-full">
      <div class="w-full overflow-hidden rounded-lg shadow-sm">
      <div class="px-4 sm:px-6 py-4 mb-6 bg-white rounded-lg shadow-md border border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
          <div>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                Users Management
            </h2>
            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
              Manage and monitor users in the system.
            </p>
          </div>
          <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 floa">
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
                  <option value="5">5</option>
                  <option value="10">10</option>
                  <option value="20">20</option>
                  <option value="50">50</option>
                  <option value="100">100</option>
                </select>
             </div>
            <button
              class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
              @click="$dispatch('open-modal', { component: 'chair.create-user' })"
            >
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Add User
            </button>
          </div>
        </div>
      </div>
      <div class="bg-white rounded-lg shadow-md border border-gray-200 dark:bg-gray-800 dark:border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
        <table class="w-full">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:border-gray-700 dark:text-gray-400 dark:bg-gray-700"
            >
              <th class="px-4 py-3 min-w-[200px]">User</th>
              <th class="px-4 py-3 min-w-[200px] hidden sm:table-cell">Email</th>
              <th class="px-4 py-3 min-w-[150px] hidden md:table-cell">Phone Number</th>
              <th class="px-4 py-3 min-w-[120px]">Actions</th>
            </tr>
          </thead>
          <tbody
            class="bg-white divide-y divide-gray-200 dark:divide-gray-700 dark:bg-gray-800"
          >
          @foreach ($users as $user)
              <tr class="text-gray-700 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-750 transition-colors duration-150">
              <td class="px-4 py-4">
                <div class="flex items-center">
                  <!-- Avatar with inset shadow -->
                  <div
                    class="relative flex-shrink-0 w-10 h-10 mr-3 rounded-full"
                  >
                    <img
                      class="object-cover w-full h-full rounded-full border border-gray-200 dark:border-gray-600"
                      src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                      alt="{{$user->name}}"
                      loading="lazy"
                    />
                    <div
                      class="absolute inset-0 rounded-full shadow-inner"
                      aria-hidden="true"
                    ></div>
                  </div>
                  <div class="min-w-0 flex-1">
                    <p class="text-sm font-semibold text-gray-900 dark:text-gray-100 truncate">
                        {{$user->name}} {{$user->last_name}} 
                    </p>
                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                      {{$user->role->name}}
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400 hidden sm:table-cell">
                <div class="truncate" title="{{$user->email}}">
                    {{$user->email}}
                </div>
              </td>
              <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-400 hidden md:table-cell">
                {{$user->phone ?: 'N/A'}}
              </td>
              <td class="px-4 py-4">
                <div class="flex items-center space-x-2">
                  <button
                    class="inline-flex items-center justify-center w-8 h-8 text-blue-600 bg-blue-100 rounded-lg hover:bg-blue-200 dark:text-blue-400 dark:bg-blue-900 dark:hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                    aria-label="Edit"
                    wire:click="editUser({{ $user->id }})"
                    title="Edit user"
                  >
                    <svg
                      class="w-4 h-4"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"
                      ></path>
                    </svg>
                  </button>
                  <button
                    class="inline-flex items-center justify-center w-8 h-8 text-red-600 bg-red-100 rounded-lg hover:bg-red-200 dark:text-red-400 dark:bg-red-900 dark:hover:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors"
                    aria-label="Delete"
                    wire:click="deleteUser({{ $user->id }})"
                    title="Delete user"
                  >
                    <svg
                      class="w-4 h-4"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </button>
                </div>
              </td>
            </tr>
          @endforeach

          </tbody>
        </table>
      </div>
      <div
        class="px-4 sm:px-6 py-3 bg-gray-50 dark:bg-gray-700 border-t border-gray-200 dark:border-gray-600"
      >
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="text-sm text-gray-700 dark:text-gray-300">
                @if($users->total() > 0)
                    Showing <span class="font-medium">{{ $users->firstItem() }}</span> to 
                    <span class="font-medium">{{ $users->lastItem() }}</span> of 
                    <span class="font-medium">{{ $users->total() }}</span> users
                @else
                    No users found
                @endif
            </div>
            <div class="flex justify-center sm:justify-end">
                {{ $users->links() }}
            </div>
        </div>
      </div>
    </div>
</div>

<div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
     x-data="{ 
       open: false,
       openModal() {
         this.open = true;
       },
       closeModal() {
         this.open = false;
       }
     }"
     x-on:open-modal.window="openModal()"
     x-on:close-modal.window="closeModal()"
     x-show="open"
     x-transition:enter="transition ease-out duration-150"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-150"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="closeModal()"
     @keydown.escape.window="closeModal()"
     >
  <div class="w-full max-w-2xl mx-4" @click.stop>
    @livewire('chair.create-user')
  </div>
</div>
</div>