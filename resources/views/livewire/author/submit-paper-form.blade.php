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
              <input type="text" id="keywords" name="keywords" value="{{ old('keywords') }}" 
                     wire:model="keywords"
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors duration-200 @error('keywords') border-red-500 @enderror" 
                     placeholder="machine learning, artificial intelligence, data mining" required>
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
                  <p class="text-xs text-gray-400">Maximum file size: 10MB</p>
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
                    I confirm that this paper follows the <a href="#" class="text-blue-600 hover:underline">IEEE conference template</a> and submission guidelines
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