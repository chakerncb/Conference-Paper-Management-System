<div>
  <div class="bg-white shadow-lg rounded-lg overflow-hidden border max-h-[70vh] overflow-y-auto">
    <!-- Header with close button -->    
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4 flex justify-between items-center">
      <h2 class="text-xl font-bold text-black">
        {{ $isEditMode ? 'Edit User' : 'Create New User' }}
      </h2>
    <button 
        type="button"
        @click="$dispatch('close-modal')"
        class="text-black hover:text-gray-200 transition-colors duration-200 p-1 rounded-full hover:bg-blue-800">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
    </div>
    
    <!-- Form content -->
    <div class="px-6 py-6">
      <form wire:submit.prevent="createUser">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
          <div>
            <label class="block text-gray-700 text-sm font-semibold mb-2" for="name">
              First Name <span class="text-red-500">*</span>
            </label>
            <input 
              class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
              id="name" 
              type="text" 
              placeholder="Enter first name"
              wire:model="name"
              required>
            @error('name') 
              <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
            @enderror
          </div>
          
          <div>
            <label class="block text-gray-700 text-sm font-semibold mb-2" for="last_name">
              Last Name <span class="text-red-500">*</span>
            </label>
            <input 
              class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
              id="last_name" 
              type="text" 
              placeholder="Enter last name"
              wire:model="last_name"
              required>
            @error('last_name') 
              <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
            @enderror
          </div>
        </div>
        
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-semibold mb-2" for="email">
            Email <span class="text-red-500">*</span>
          </label>
          <input 
            class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
            id="email" 
            type="email" 
            placeholder="Enter email address"
            wire:model="email"
            required>
          @error('email') 
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
          @enderror
        </div>

        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-semibold mb-2" for="phone">
            Phone Number
          </label>
          <input 
            class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200" 
            id="phone" 
            type="tel" 
            placeholder="Enter phone number"
            wire:model="phone">
          @error('phone') 
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
          @enderror
        </div>
        
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-semibold mb-2" for="role_id">
            Role <span class="text-red-500">*</span>
          </label>
          <select 
            class="shadow-sm appearance-none border border-gray-300 rounded-md w-full py-3 px-4 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition duration-200 bg-white" 
            id="role_id" 
            wire:model="role_id"
            required>
            <option value="">Select a role</option>
            @foreach($roles as $role)
              <option value="{{ $role->id }}">{{ $role->name }}</option>
            @endforeach
          </select>
          @error('role_id') 
            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p> 
          @enderror
        </div>
          <!-- Action buttons -->
        <div class="flex flex-col sm:flex-row gap-3 pt-4 border-t border-gray-200">
          <button 
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition duration-200 flex-1 order-2 sm:order-1 mb-4 sm:mb-0" 
            type="submit">
            @if($isEditMode)
              <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
              </svg>
              Update User
            @else
              <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              Create User
            @endif
          </button>

        </div>
    </form>
  </div>
</div>