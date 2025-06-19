<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">
                        <i class="fas fa-cog mr-2 text-blue-600"></i>
                        Conference Settings
                    </h1>
                    <p class="text-gray-600 mt-1">Manage your conference configuration and deadlines</p>
                </div>
                <div class="flex space-x-3">
                    <button 
                        wire:click="resetToDefaults" 
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200"
                        wire:confirm="Are you sure you want to reset all settings to defaults?"
                    >
                        <i class="fas fa-undo mr-2"></i>Reset Defaults
                    </button>
                    <button 
                        wire:click="updateSettings" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200"
                        wire:loading.attr="disabled"
                        wire:target="updateSettings"
                    >
                        <span wire:loading.remove wire:target="updateSettings">
                            <i class="fas fa-save mr-2"></i>Save Changes
                        </span>
                        <span wire:loading wire:target="updateSettings">
                            <i class="fas fa-spinner fa-spin mr-2"></i>Saving...
                        </span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="border-b border-gray-200">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <button 
                    wire:click="setActiveTab('general')"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 {{ $activeTab === 'general' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                >
                    <i class="fas fa-info-circle mr-2"></i>General
                </button>
                <button 
                    wire:click="setActiveTab('deadlines')"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 {{ $activeTab === 'deadlines' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                >
                    <i class="fas fa-calendar-alt mr-2"></i>Deadlines
                </button>
                <button 
                    wire:click="setActiveTab('content')"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 {{ $activeTab === 'content' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                >
                    <i class="fas fa-file-alt mr-2"></i>Content
                </button>
                <button 
                    wire:click="setActiveTab('system')"
                    class="py-4 px-1 border-b-2 font-medium text-sm transition-colors duration-200 {{ $activeTab === 'system' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}"
                >
                    <i class="fas fa-cogs mr-2"></i>System
                </button>
            </nav>
        </div>

        <!-- Settings Content -->
        <div class="p-6">
            <!-- General Settings -->
            <div class="{{ $activeTab === 'general' ? 'block' : 'hidden' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Conference Name</label>
                        <input 
                            type="text" 
                            wire:model="settings.conference_name"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter conference name"
                        >
                        @error('settings.conference_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Conference Acronym</label>
                        <input 
                            type="text" 
                            wire:model="settings.conference_acronym"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="e.g., ICCS"
                        >
                        @error('settings.conference_acronym') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Conference Year</label>
                        <input 
                            type="number" 
                            wire:model="settings.conference_year"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            min="2024"
                        >
                        @error('settings.conference_year') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Conference Location</label>
                        <input 
                            type="text" 
                            wire:model="settings.conference_location"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter location"
                        >
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Conference Website</label>
                        <input 
                            type="url" 
                            wire:model="settings.conference_website"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="https://conference.example.com"
                        >
                    </div>
                </div>
            </div>

            <!-- Deadlines Settings -->
            <div class="{{ $activeTab === 'deadlines' ? 'block' : 'hidden' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-upload text-blue-500 mr-1"></i>Submission Deadline
                        </label>
                        <input 
                            type="date" 
                            wire:model="settings.submission_deadline"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                        @error('settings.submission_deadline') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-eye text-green-500 mr-1"></i>Review Deadline
                        </label>
                        <input 
                            type="date" 
                            wire:model="settings.review_deadline"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                        @error('settings.review_deadline') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-camera text-purple-500 mr-1"></i>Camera Ready Deadline
                        </label>
                        <input 
                            type="date" 
                            wire:model="settings.camera_ready_deadline"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                        @error('settings.camera_ready_deadline') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user-plus text-orange-500 mr-1"></i>Registration Deadline
                        </label>
                        <input 
                            type="date" 
                            wire:model="settings.registration_deadline"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        >
                        @error('settings.registration_deadline') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Deadline Timeline Visualization -->
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-timeline mr-2"></i>Deadline Timeline
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                            <span class="font-medium">Submission:</span>
                            <span class="text-gray-600">{{ $settings['submission_deadline'] ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                            <span class="font-medium">Review:</span>
                            <span class="text-gray-600">{{ $settings['review_deadline'] ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-purple-500 rounded-full"></div>
                            <span class="font-medium">Camera Ready:</span>
                            <span class="text-gray-600">{{ $settings['camera_ready_deadline'] ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-orange-500 rounded-full"></div>
                            <span class="font-medium">Registration:</span>
                            <span class="text-gray-600">{{ $settings['registration_deadline'] ?? 'Not set' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Content Settings -->
            <div class="{{ $activeTab === 'content' ? 'block' : 'hidden' }}">
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Conference Description</label>
                        <textarea 
                            wire:model="settings.conference_description"
                            rows="4"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter conference description..."
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Submission Guidelines</label>
                        <textarea 
                            wire:model="settings.submission_guidelines"
                            rows="4"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter submission guidelines..."
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Review Criteria</label>
                        <textarea 
                            wire:model="settings.review_criteria"
                            rows="4"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter review criteria..."
                        ></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Keywords</label>
                        <input 
                            type="text" 
                            wire:model="settings.keywords"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Enter keywords separated by commas"
                        >
                        <p class="text-sm text-gray-500 mt-1">Separate keywords with commas</p>
                    </div>
                </div>
            </div>

            <!-- System Settings -->
            <div class="{{ $activeTab === 'system' ? 'block' : 'hidden' }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Maximum Paper Size (MB)</label>
                        <input 
                            type="number" 
                            wire:model="settings.max_paper_size_mb"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            min="1" max="50"
                        >
                        @error('settings.max_paper_size_mb') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Reviews per Paper</label>
                        <input 
                            type="number" 
                            wire:model="settings.reviews_per_paper"
                            class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            min="1" max="10"
                        >
                        @error('settings.reviews_per_paper') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2">
                        <div class="space-y-4">
                            <div class="flex items-center">
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        wire:model="settings.enable_blind_review"
                                        class="sr-only peer"
                                        {{ $settings['enable_blind_review'] ? 'checked' : '' }}
                                    >
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                                </label>
                                <label class="ml-2 block text-sm text-gray-900">
                                    Enable Blind Review Process
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- System Info -->
                <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <h3 class="text-lg font-semibold text-blue-800 mb-2">
                        <i class="fas fa-info-circle mr-2"></i>System Information
                    </h3>
                    <div class="text-sm text-blue-700 space-y-1">
                        <p><strong>Current Settings:</strong></p>
                        <p>• Max file size: {{ $settings['max_paper_size_mb'] ?? '10' }} MB</p>
                        <p>• Reviews per paper: {{ $settings['reviews_per_paper'] ?? '3' }}</p>
                        <p>• Blind review: {{ ($settings['enable_blind_review']) == '1' ? 'Enabled' : 'Disabled' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            <div class="flex justify-between items-center text-sm text-gray-600">
                <div>
                    <i class="fas fa-clock mr-1"></i>
                    Last updated: {{ now()->format('M d, Y H:i') }}
                </div>
                <div wire:loading wire:target="updateSettings,resetToDefaults">
                    <i class="fas fa-spinner fa-spin mr-2"></i>Processing...
                </div>
            </div>
        </div>
    </div>
</div>
