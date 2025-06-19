@extends('chair.layouts.app')

@section('content')
<div class="pt-16"> <!-- Account for fixed navbar -->
    @livewire('chair.settings-manager')
</div>
@endsection
    {{-- <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 flex items-center">
                            <i class="fas fa-cog text-blue-600 mr-3"></i>
                            Conference Settings
                        </h1>
                        <p class="mt-1 text-sm text-gray-600">Manage your conference configuration and deadlines</p>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-clock"></i>
                        <span>Last updated: {{ now()->format('M d, Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-600 mr-2"></i>
                    <span class="text-green-800">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <form action="{{ route('chair.settings.update') }}" method="POST" class="space-y-8">
            @csrf

            <!-- General Settings -->
            @if(isset($settings['general']))
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        General Information
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Basic conference details and information</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($settings['general'] as $setting)
                            <div class="space-y-2">
                                <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                    {{ ucwords(str_replace('_', ' ', str_replace('conference_', '', $setting->key))) }}
                                </label>
                                @if($setting->type == 'text' || $setting->type == 'number')
                                    <input type="{{ $setting->type }}" 
                                           id="{{ $setting->key }}" 
                                           name="settings[{{ $setting->key }}]" 
                                           value="{{ $setting->value }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                @elseif($setting->type == 'textarea')
                                    <textarea id="{{ $setting->key }}" 
                                              name="settings[{{ $setting->key }}]" 
                                              rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $setting->value }}</textarea>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Deadlines -->
            @if(isset($settings['deadlines']))
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-calendar-alt text-red-600 mr-2"></i>
                        Important Deadlines
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Set critical dates for the conference timeline</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($settings['deadlines'] as $setting)
                            <div class="space-y-2">
                                <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                    <i class="fas fa-clock text-gray-400 mr-1"></i>
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>
                                <input type="date" 
                                       id="{{ $setting->key }}" 
                                       name="settings[{{ $setting->key }}]" 
                                       value="{{ $setting->value }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-red-500 focus:border-red-500">
                                <p class="text-xs text-gray-500">
                                    @if($setting->value)
                                        {{ \Carbon\Carbon::parse($setting->value)->format('F j, Y') }}
                                    @endif
                                </p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Content Settings -->
            @if(isset($settings['content']))
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-edit text-green-600 mr-2"></i>
                        Content & Guidelines
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Conference description and submission guidelines</p>
                </div>
                <div class="p-6">
                    <div class="space-y-6">
                        @foreach($settings['content'] as $setting)
                            <div class="space-y-2">
                                <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>
                                @if($setting->type == 'textarea')
                                    <textarea id="{{ $setting->key }}" 
                                              name="settings[{{ $setting->key }}]" 
                                              rows="4"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">{{ $setting->value }}</textarea>
                                @else
                                    <input type="text" 
                                           id="{{ $setting->key }}" 
                                           name="settings[{{ $setting->key }}]" 
                                           value="{{ $setting->value }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- System Settings -->
            @if(isset($settings['system']))
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900 flex items-center">
                        <i class="fas fa-cogs text-purple-600 mr-2"></i>
                        System Configuration
                    </h2>
                    <p class="text-sm text-gray-600 mt-1">Technical settings and review parameters</p>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($settings['system'] as $setting)
                            <div class="space-y-2">
                                <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700">
                                    {{ ucwords(str_replace('_', ' ', $setting->key)) }}
                                </label>
                                @if($setting->type == 'checkbox')
                                    <div class="flex items-center">
                                        <input type="hidden" name="settings[{{ $setting->key }}]" value="0">
                                        <input type="checkbox" 
                                               id="{{ $setting->key }}" 
                                               name="settings[{{ $setting->key }}]" 
                                               value="1"
                                               {{ $setting->value ? 'checked' : '' }}
                                               class="h-4 w-4 text-purple-600 focus:ring-purple-500 border-gray-300 rounded">
                                        <span class="ml-2 text-sm text-gray-600">Enable this feature</span>
                                    </div>
                                @else
                                    <input type="{{ $setting->type }}" 
                                           id="{{ $setting->key }}" 
                                           name="settings[{{ $setting->key }}]" 
                                           value="{{ $setting->value }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500">
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-2"></i>
                            <span>Changes will be applied immediately after saving</span>
                        </div>
                        <div class="flex space-x-3">
                            <button type="button" 
                                    onclick="window.location.reload()" 
                                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-undo mr-2"></i>
                                Reset
                            </button>
                            <button type="submit" 
                                    class="px-6 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <i class="fas fa-save mr-2"></i>
                                Save Settings
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // Auto-save functionality
    let timeoutId;
    function autoSave() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => {
            const form = document.querySelector('form');
            const formData = new FormData(form);
            
            // Show saving indicator
            const saveBtn = document.querySelector('button[type="submit"]');
            const originalText = saveBtn.innerHTML;
            saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Saving...';
            saveBtn.disabled = true;
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            }).then(() => {
                saveBtn.innerHTML = '<i class="fas fa-check mr-2"></i>Saved';
                setTimeout(() => {
                    saveBtn.innerHTML = originalText;
                    saveBtn.disabled = false;
                }, 1000);
            }).catch(() => {
                saveBtn.innerHTML = originalText;
                saveBtn.disabled = false;
            });
        }, 2000);
    }

    // Add auto-save to all inputs
    document.querySelectorAll('input, textarea, select').forEach(element => {
        element.addEventListener('input', autoSave);
        element.addEventListener('change', autoSave);
    });
</script>
@endsection --}}
