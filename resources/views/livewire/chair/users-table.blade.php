<div>
      <div class="w-full overflow-hidden rounded-lg shadow-xs">
      <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
            Users
          </h2>
          <div class="flex items">
            <p class="text-sm text-gray-500 dark:text-gray-400">
              Manage users in the system.
            </p>
          </div>
          <div class="flex items-center justify-end mt-4 mb-2 space-x-3">
             <label for="">per page :</label>
            <select wire:model="perPage"  wire:change="changePerPage($event.target.value)"
              class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg focus:outline-none focus:shadow-outline-purple dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600"
              aria-label="Select number of items per page">
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="50">50</option>
              <option value="100">100</option>
            </select>
            <button
              class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-lg hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
              @click="$dispatch('open-modal', { component: 'chair.create-user' })"
            >
              Add User
            </button>
          </div>
      </div>
      <div class="w-full overflow-x-auto">
        <div class="flex items-center justify-between px-4 py-3">
        <table class="w-full whitespace-no-wrap">
          <thead>
            <tr
              class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
            >
              <th class="px-4 py-3">Full Name</th>
              <th class="px-4 py-3">Email</th>
              <th class="px-4 py-3">Phone Number</th>
              {{-- <th class="px-4 py-3">Date</th> --}}
              <th class="px-4 py-3">Actions</th>
            </tr>
          </thead>
          <tbody
            class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
          >
          @foreach ($users as $user)
              <tr class="text-gray-700 dark:text-gray-400">
              <td class="px-4 py-3">
                <div class="flex items-center text-sm">
                  <!-- Avatar with inset shadow -->
                  <div
                    class="relative hidden w-8 h-8 mr-3 rounded-full md:block"
                  >
                    <img
                      class="object-cover w-full h-full rounded-full"
                      src="https://images.unsplash.com/flagged/photo-1570612861542-284f4c12e75f?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&ixid=eyJhcHBfaWQiOjE3Nzg0fQ"
                      alt=""
                      loading="lazy"
                    />
                    <div
                      class="absolute inset-0 rounded-full shadow-inner"
                      aria-hidden="true"
                    ></div>
                  </div>
                  <div>
                    <p class="font-semibold">{{$user->name}} {{$user->last_name}} </p>
                    <p class="text-xs text-gray-600 dark:text-gray-400">
                      {{$user->role->name}}
                    </p>
                  </div>
                </div>
              </td>
              <td class="px-4 py-3 text-sm">
                {{$user->email}}
              </td>
              {{-- <td class="px-4 py-3 text-xs">
                <span
                  class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                >
                  Approved
                </span>
              </td> --}}
              <td class="px-4 py-3 text-sm">
                {{$user->phone}}
              </td>
              <td class="px-4 py-3">
                <div class="flex items-center space-x-4 text-sm">
                  <button
                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                    aria-label="Edit"
                  >
                    <svg
                      class="w-5 h-5"
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
                    class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                    aria-label="Delete"
                  >
                    <svg
                      class="w-5 h-5"
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
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800"
      >

        {{ $users->links() }}

      </div>
    </div>

    <!-- User Form Modal -->
 <div x-data="{ open: false }" x-show="open" @open-modal.window="open = ($event.detail.component === 'chair.create-user')" 
  @close-modal.window="open = false" x-cloak
  class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
  <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
    <!-- Background overlay with blur -->
    <div class="fixed inset-0 transition-opacity bg-gray-900 bg-opacity-50 backdrop-blur-sm" @click="open = false"></div>
    
    <!-- Modal panel - smaller size -->
    <div class="inline-block w-full max-w-md p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-lg dark:bg-gray-800">
     <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 mb-4">
       Add New User
     </h3>
     
     <form wire:submit.prevent="createUser">
       <!-- First Name and Last Name in one row -->
       <div class="grid grid-cols-2 gap-4 mb-4">
         <div>
           <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
             First Name
           </label>
           <input type="text" wire:model="name"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
         </div>
         
         <div>
           <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
             Last Name
           </label>
           <input type="text" wire:model="last_name"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
         </div>
       </div>
       
       <!-- Email and Phone in one row -->
       <div class="grid grid-cols-2 gap-4 mb-4">
         <div>
           <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
             Email
           </label>
           <input type="email" wire:model="email"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
         </div>
         
         <div>
           <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
             Phone Number
           </label>
           <input type="text" wire:model="phone"
               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
         </div>
       </div>
       
       <!-- Role field full width -->
       <div class="mb-6">
         <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
           Role
         </label>
         <select wire:model="role_id"
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-300">
           <option value="">Select Role</option>
           <option value="1">Admin</option>
           <option value="2">Chair</option>
           <option value="3">Reviewer</option>
           <option value="4">Author</option>
         </select>
       </div>
       
       <div class="flex justify-end space-x-3">
         <button type="button" @click="open = false"
              class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-600 dark:text-gray-300 dark:hover:bg-gray-500">
           Cancel
         </button>
         <button type="submit"
              class="px-4 py-2 text-sm font-medium text-white bg-purple-600 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
           Create User
         </button>
       </div>
     </form>
    </div>
  </div>
</div>

</div>