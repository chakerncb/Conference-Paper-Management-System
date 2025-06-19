<div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
          <div class="bg-blue-50 px-6 py-4 border-b border-blue-100">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
              <i class="fas fa-upload text-blue-600 mr-3"></i>
              Paper Submission Form
            </h2>
          </div>

          <form wire:submit.prevent="submit" enctype="multipart/form-data" class="p-6 space-y-6">
            <!-- Paper Title -->
            <div>
              <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-heading text-blue-500 mr-2"></i>
                Paper Title *
              </label>
              <input type="text" id="title" wire:model="title" name="title" value="{{ old('title') }}" 
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('title') border-red-500 @enderror" 
                     placeholder="Enter your paper title" >
              @error('title')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
              <p class="mt-1 text-sm text-gray-500">
                Keep your title concise and descriptive (recommended: 10-15 words)
              </p>
            </div>

            <!-- Abstract -->
            <div>
              <label for="abstract" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-align-left text-blue-500 mr-2"></i>
                Abstract *
              </label>
              <textarea id="abstract" name="abstract" rows="8" 
                        wire:model="abstract"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('abstract') border-red-500 @enderror" 
                        placeholder="Provide a clear and concise abstract of your research..." required>{{ old('abstract') }}</textarea>
              @error('abstract')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
              <div class="mt-1 flex justify-between text-sm text-gray-500">
                <span>Summarize your research methodology, findings, and contributions</span>
                <span id="abstract-count">0/300 words</span>
              </div>
            </div>

            <!-- Keywords -->
            <div>
              <label for="keywords" class="block text-sm font-medium text-gray-700 mb-2">
                <i class="fas fa-tags text-blue-500 mr-2"></i>
                Keywords *
              </label>
              <div class="relative">
                <div class="w-full min-h-[48px] px-4 py-3 border border-gray-300 rounded-lg focus-within:ring-2 focus-within:ring-blue-500 focus-within:border-blue-500 transition-colors duration-200 @error('keywords') border-red-500 @enderror flex flex-wrap items-center gap-2">
                  <!-- Selected Keywords Tags -->
                  <div class="flex flex-wrap gap-2" id="keywords-container">
                    <!-- Keywords will be added here dynamically -->
                  </div>
                  
                  <!-- Input Field -->
                  <input type="text" 
                    id="keywords-input" 
                    class="flex-1 min-w-[200px] border-none outline-none bg-transparent text-gray-700 placeholder-gray-400"
                    placeholder="Type a keyword and press Enter..."
                    onkeydown="handleKeywordInput(event)">
                  </div>

                  <!-- Dropdown for selecting predefined keywords -->
                  <div class="mt-2">
                    <select id="keywords-select"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md text-sm"
                       onchange="handleKeywordSelect(this)">
                      <option value="" disabled selected>Or select from predefined keywords</option>
                      @foreach($tags as $keyword)
                        <option value="{{ $keyword->name }}">{{ $keyword->name }}</option>
                      @endforeach
                    </select>
                  </div>
                
                <!-- Hidden input to store keywords for form submission -->
                <input type="hidden" id="keywords" name="keywords" wire:model="keywords">
              </div>

              <script>
              document.addEventListener('DOMContentLoaded', function() {
                  let keywords = [];
                  
                  window.handleKeywordInput = function(event) {
                      if (event.key === 'Enter') {
                          event.preventDefault();
                          const input = event.target;
                          const keyword = input.value.trim();
                          
                          if (keyword && !keywords.includes(keyword.toLowerCase())) {
                              addKeyword(keyword);
                              input.value = '';
                          }
                      }
                  };
                  
                  window.handleKeywordSelect = function(select) {
                      const keyword = select.value.trim();
                      
                      if (keyword && !keywords.includes(keyword.toLowerCase())) {
                          addKeyword(keyword);
                          select.selectedIndex = 0; // Reset to default option
                      }
                  };
                  
                  function addKeyword(keyword) {
                      keywords.push(keyword.toLowerCase());
                      
                      const container = document.getElementById('keywords-container');
                      const tag = document.createElement('span');
                      tag.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 hover:bg-blue-200 transition-colors duration-200';
                      tag.setAttribute('data-keyword', keyword.toLowerCase());
                      tag.innerHTML = `
                          ${keyword}
                          <button type="button" class="ml-2 text-blue-600 hover:text-blue-800" onclick="removeKeyword('${keyword.toLowerCase()}')">
                              <i class="fas fa-times text-xs"></i>
                          </button>
                      `;
                      container.appendChild(tag);
                      updateHiddenInput();
                  }
                  
                  window.removeKeyword = function(keyword) {
                      keywords = keywords.filter(k => k !== keyword);
                      const tag = document.querySelector(`[data-keyword="${keyword}"]`);
                      if (tag) {
                          tag.remove();
                      }
                      updateHiddenInput();
                  };
                  
                  function updateHiddenInput() {
                      const keywordString = keywords.join(', ');
                      document.getElementById('keywords').value = keywordString;
                      
                      // Use Livewire's set method without triggering re-render
                      if (window.Livewire && @this) {
                          @this.set('keywords', keywordString, false);
                      }
                  }
              });
              </script>
              @error('keywords')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
              <p class="mt-1 text-sm text-gray-500">
                Enter 3-5 keywords separated by commas that best describe your research
              </p>
            </div>

            <!-- File Upload -->
            <div class="border border-gray-200 rounded-lg p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-file-pdf text-blue-500 mr-2"></i>
                Paper Upload
              </h3>
              
              <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition-colors duration-200">
                <div class="space-y-2">
                  <i class="fas fa-cloud-upload-alt text-4xl text-gray-400"></i>
                  <div>
                    <label for="paper_file" class="cursor-pointer">
                      <span class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md font-medium transition-colors duration-200">
                        Choose PDF File
                      </span>
                      <input type="file" id="paper_file" name="paper_file" wire:model="file" accept=".pdf" class="hidden" required>
                    </label>
                  </div>
                  <p class="text-sm text-gray-500">or drag and drop your PDF file here</p>
                  <p class="text-xs text-gray-400">Maximum file size: {{$MaxFileSize}}MB</p>
                </div>
              </div>
              
              <div id="file-info" class="mt-3 hidden">
                <div class="bg-blue-50 border border-blue-200 rounded-md p-3">
                  <div class="flex items-center">
                    <i class="fas fa-file-pdf text-blue-600 mr-2"></i>
                    <span id="file-name" class="text-sm font-medium text-blue-800"></span>
                    <span id="file-size" class="text-sm text-blue-600 ml-2"></span>
                  </div>
                </div>
              </div>
              
              <div wire:loading wire:target="file" class="mt-2">
                <div class="flex items-center text-blue-600">
                  <svg class="animate-spin -ml-1 mr-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                  </svg>
                  <span>Uploading file...</span>
                </div>
              </div>
              
              @error('file')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>

            <!-- Submission Guidelines Acknowledgment -->
            <div class="border border-gray-200 rounded-lg p-4">
              <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <i class="fas fa-check-square text-blue-500 mr-2"></i>
                Submission Agreement
              </h3>
              
              <div class="space-y-3">
                <label class="flex items-start">
                  <input type="checkbox" name="guidelines_accepted" value="1" wire:model="agreements.agr-1" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                  <span class="ml-3 text-sm text-gray-700">
                    I confirm that this paper follows the <a href="{{route('paper.print' , 'IEEE-paper-format-template.docx')}}" class="text-blue-600 hover:underline" download>IEEE conference template</a> and submission guidelines
                  </span>
                </label>
                
                <label class="flex items-start">
                  <input type="checkbox" name="originality_confirmed" value="1" wire:model="agreements.agr-2" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                  <span class="ml-3 text-sm text-gray-700">
                    I certify that this work is original and has not been published elsewhere
                  </span>
                </label>
                
                <label class="flex items-start">
                  <input type="checkbox" name="review_process_accepted" value="1" wire:model="agreements.agr-3" class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                  <span class="ml-3 text-sm text-gray-700">
                    I understand and agree to the double-blind peer review process
                  </span>
                </label>
              </div>
              
              @error('agreements.agr-1') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              @error('agreements.agr-2') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
              @error('agreements.agr-3') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
              <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800 font-medium">
                <i class="fas fa-arrow-left mr-2"></i>
                Back to Dashboard
              </a>
              
              <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-200 shadow-lg hover:shadow-xl">
                <i class="fas fa-paper-plane mr-2"></i>
                Submit Paper
              </button>
            </div>
          </form>
        </div>
      </div>

      <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('paper_file');
            const fileInfo = document.getElementById('file-info');
            const fileName = document.getElementById('file-name');
            const fileSize = document.getElementById('file-size');
            
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    fileInfo.classList.remove('hidden');
                    fileName.textContent = file.name;
                    
                    // Format file size
                    const size = file.size / 1024; // KB
                    if (size < 1024) {
                        fileSize.textContent = `(${size.toFixed(1)} KB)`;
                    } else {
                        fileSize.textContent = `(${(size/1024).toFixed(1)} MB)`;
                    }
                } else {
                    fileInfo.classList.add('hidden');
                }
            });

            // Support for drag and drop
            const dropArea = document.querySelector('.border-dashed');
            
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, preventDefaults, false);
            });
            
            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }
            
            ['dragenter', 'dragover'].forEach(eventName => {
                dropArea.addEventListener(eventName, highlight, false);
            });
            
            ['dragleave', 'drop'].forEach(eventName => {
                dropArea.addEventListener(eventName, unhighlight, false);
            });
            
            function highlight() {
                dropArea.classList.add('border-blue-400', 'bg-blue-50');
            }
            
            function unhighlight() {
                dropArea.classList.remove('border-blue-400', 'bg-blue-50');
            }
            
            dropArea.addEventListener('drop', handleDrop, false);
            
            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                
                if (files.length > 0) {
                    fileInput.files = files;
                    
                    // Trigger change event manually for Livewire to pick up the file
                    const event = new Event('change', { bubbles: true });
                    fileInput.dispatchEvent(event);
                    
                    // Update file info display
                    const file = files[0];
                    fileInfo.classList.remove('hidden');
                    fileName.textContent = file.name;
                    
                    // Format file size
                    const size = file.size / 1024; // KB
                    if (size < 1024) {
                        fileSize.textContent = `(${size.toFixed(1)} KB)`;
                    } else {
                        fileSize.textContent = `(${(size/1024).toFixed(1)} MB)`;
                    }
                }
            }
        });
      </script>