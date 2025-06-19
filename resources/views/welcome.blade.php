<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $settings['conference_name'] }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        'primary': '#2563eb',
                        'primary-dark': '#1d4ed8',
                    },
                },
            },
        }
    </script>
    <style type="text/tailwindcss">
        @layer utilities {
            .hero-pattern::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
                background-size: cover;
            }
            
            .timeline-line::before {
                content: '';
                position: absolute;
                left: 0;
                top: 0;
                height: 100%;
                width: 2px;
                background: #2563eb;
            }
            
            .timeline-dot::before {
                content: '';
                position: absolute;
                left: -9px;
                top: 6px;
                width: 10px;
                height: 10px;
                border-radius: 50%;
                background: #2563eb;
            }
            
            .section-title::after {
                content: '';
                display: block;
                width: 80px;
                height: 4px;
                background: #2563eb;
                margin: 20px auto;
                border-radius: 2px;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }
            
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }
                to {
                    opacity: 1;
                }
            }
            
            @keyframes scaleIn {
                from {
                    opacity: 0;
                    transform: scale(0.9);
                }
                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }
            
            .animate-fadeInUp {
                animation: fadeInUp 0.6s ease-out forwards;
            }
            
            .animate-fadeIn {
                animation: fadeIn 0.5s ease-out forwards;
            }
            
            .animate-scaleIn {
                animation: scaleIn 0.5s ease-out forwards;
            }
            
            .date-card {
                opacity: 0;
            }
            
            .date-card:nth-child(1) {
                animation-delay: 0.1s;
            }
            
            .date-card:nth-child(2) {
                animation-delay: 0.3s;
            }
            
            .date-card:nth-child(3) {
                animation-delay: 0.5s;
            }
            
            .date-card:nth-child(4) {
                animation-delay: 0.7s;
            }
            
            .topic-card {
                opacity: 0;
            }
            
            .topic-card:nth-child(1) {
                animation-delay: 0.1s;
            }
            
            .topic-card:nth-child(2) {
                animation-delay: 0.3s;
            }
            
            .topic-card:nth-child(3) {
                animation-delay: 0.5s;
            }
            
            .topic-item {
                transition: all 0.3s ease;
            }
            
            .tag-item {
                transition: all 0.3s ease;
            }
            
            .reviewer-card {
                opacity: 0;
            }
            
            .location-info,
            .map-container {
                opacity: 0;
            }
        }
    </style>
</head>
<body class="font-sans text-gray-800 leading-normal antialiased">
    <nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 text-white">
        <div class="container mx-auto px-4 py-5">
            <div class="flex flex-wrap items-center justify-between">
                <a href="#" class="text-xl font-bold">
                    {{ $settings['conference_acronym'] }} {{ $settings['conference_year'] }}
                </a>
                
                <button id="menu-toggle" class="lg:hidden block focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                
                <div id="menu" class="hidden lg:flex lg:items-center w-full lg:w-auto">
                    <div class="lg:flex lg:ml-auto">
                        <a href="#" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">Home</a>
                        <a href="#about" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">About</a>
                        <a href="#dates" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">Important Dates</a>
                        <a href="#submission" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">Submission</a>
                        <a href="#reviewers" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">Reviewers</a>
                        <a href="#location" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">Location</a>
                        
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="block lg:inline-block px-4 py-2 hover:text-blue-300 text-white font-medium">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative overflow-hidden bg-gradient-to-r from-blue-600 to-blue-800 text-white hero-pattern">
        <div class="container mx-auto px-4 py-28 lg:py-36 relative z-10">
            <div class="flex flex-wrap items-center">
                <div class="w-full lg:w-7/12 mb-12 lg:mb-0">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">{{ $settings['conference_name'] }}</h1>
                    <p class="text-xl mb-4">{{ $settings['conference_year'] }} | {{ $settings['conference_location'] }}</p>
                    <p class="text-lg opacity-90 mb-8 max-w-2xl">{{ $settings['conference_description'] }}</p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#submission" class="bg-white text-blue-700 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium transition-colors duration-300">Submit Paper</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="border border-white text-white hover:bg-white hover:text-blue-700 px-6 py-3 rounded-lg font-medium transition-colors duration-300">Register Now</a>
                        @endif
                    </div>
                </div>
                <div class="w-full lg:w-5/12">
                    <div class="bg-white bg-opacity-10 p-6 rounded-xl backdrop-blur-md">
                        <h4 class="text-center text-xl font-semibold mb-6">Submission Deadline</h4>
                        <div class="flex flex-wrap justify-center" id="countdown">
                            <div class="bg-white bg-opacity-15 rounded-lg mx-2 mb-2 p-4 min-w-20 text-center">
                                <div id="days" class="text-3xl font-bold">--</div>
                                <div>Days</div>
                            </div>
                            <div class="bg-white bg-opacity-15 rounded-lg mx-2 mb-2 p-4 min-w-20 text-center">
                                <div id="hours" class="text-3xl font-bold">--</div>
                                <div>Hours</div>
                            </div>
                            <div class="bg-white bg-opacity-15 rounded-lg mx-2 mb-2 p-4 min-w-20 text-center">
                                <div id="minutes" class="text-3xl font-bold">--</div>
                                <div>Minutes</div>
                            </div>
                            <div class="bg-white bg-opacity-15 rounded-lg mx-2 mb-2 p-4 min-w-20 text-center">
                                <div id="seconds" class="text-3xl font-bold">--</div>
                                <div>Seconds</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16 section-title">About The Conference</h2>
            
            <div class="max-w-3xl mx-auto text-center mb-12">
                <p class="text-xl text-gray-600">{{ $settings['conference_description'] }}</p>
            </div>
            
            <div class="flex flex-wrap -mx-4 mt-12">
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-white rounded-xl shadow-md p-8 text-center h-full transform transition duration-300 hover:-translate-y-2 hover:shadow-lg">
                        <div class="mb-6 text-blue-600">
                            <i class="fas fa-users text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold mb-4">Networking</h4>
                        <p class="text-gray-600">Connect with leading researchers, academics, and industry professionals in your field.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-white rounded-xl shadow-md p-8 text-center h-full transform transition duration-300 hover:-translate-y-2 hover:shadow-lg">
                        <div class="mb-6 text-blue-600">
                            <i class="fas fa-lightbulb text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold mb-4">Knowledge Sharing</h4>
                        <p class="text-gray-600">Discover cutting-edge research and the latest developments in the field.</p>
                    </div>
                </div>
                <div class="w-full md:w-1/3 px-4 mb-8">
                    <div class="bg-white rounded-xl shadow-md p-8 text-center h-full transform transition duration-300 hover:-translate-y-2 hover:shadow-lg">
                        <div class="mb-6 text-blue-600">
                            <i class="fas fa-certificate text-4xl"></i>
                        </div>
                        <h4 class="text-xl font-semibold mb-4">Publication</h4>
                        <p class="text-gray-600">Accepted papers will be published in the conference proceedings with potential for journal special issues.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="dates" class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16 section-title">Important Dates</h2>
            <div class="max-w-5xl mx-auto">
                <div class="hidden md:block">
                    <div class="flex items-center justify-center mb-10">
                        <div class="h-1 bg-gradient-to-r from-blue-500 to-blue-600 rounded w-full"></div>
                    </div>
                    
                    <div class="flex">
                        <div class="w-1/4 px-4">
                            <div class="relative flex flex-col items-center">
                                <div class="absolute -top-5">
                                    <div class="rounded-full bg-blue-600 w-10 h-10 flex items-center justify-center border-4 border-white shadow-lg">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div class="bg-white rounded-lg shadow-lg p-6 mt-8 w-full transform transition hover:-translate-y-2 duration-300 hover:shadow-xl date-card">
                                    <div class="text-blue-600 mb-2">
                                        <i class="fas fa-calendar-day mr-2"></i>
                                        @php
                                            $date = \DateTime::createFromFormat('Y-m-d', $settings['submission_deadline']);
                                            $formattedDate = $date ? $date->format('M d, Y') : $settings['submission_deadline'];
                                        @endphp
                                        {{ $formattedDate }}
                                    </div>
                                    <h3 class="font-bold text-lg mb-2">Paper Submission</h3>
                                    <p class="text-gray-600 text-sm">Deadline for authors to submit their complete papers.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-1/4 px-4">
                            <div class="relative flex flex-col items-center">
                                <div class="absolute -top-5">
                                    <div class="rounded-full bg-blue-600 w-10 h-10 flex items-center justify-center border-4 border-white shadow-lg">
                                        <i class="fas fa-search text-white"></i>
                                    </div>
                                </div>
                                <div class="bg-white rounded-lg shadow-lg p-6 mt-8 w-full transform transition hover:-translate-y-2 duration-300 hover:shadow-xl date-card">
                                    <div class="text-blue-600 mb-2">
                                        <i class="fas fa-calendar-day mr-2"></i>
                                        @php
                                            $date = \DateTime::createFromFormat('Y-m-d', $settings['review_deadline']);
                                            $formattedDate = $date ? $date->format('M d, Y') : $settings['review_deadline'];
                                        @endphp
                                        {{ $formattedDate }}
                                    </div>
                                    <h3 class="font-bold text-lg mb-2">Review Notification</h3>
                                    <p class="text-gray-600 text-sm">Authors will be notified of acceptance decisions.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-1/4 px-4">
                            <div class="relative flex flex-col items-center">
                                <div class="absolute -top-5">
                                    <div class="rounded-full bg-blue-600 w-10 h-10 flex items-center justify-center border-4 border-white shadow-lg">
                                        <i class="fas fa-camera text-white"></i>
                                    </div>
                                </div>
                                <div class="bg-white rounded-lg shadow-lg p-6 mt-8 w-full transform transition hover:-translate-y-2 duration-300 hover:shadow-xl date-card">
                                    <div class="text-blue-600 mb-2">
                                        <i class="fas fa-calendar-day mr-2"></i>
                                        @php
                                            $date = \DateTime::createFromFormat('Y-m-d', $settings['camera_ready_deadline']);
                                            $formattedDate = $date ? $date->format('M d, Y') : $settings['camera_ready_deadline'];
                                        @endphp
                                        {{ $formattedDate }}
                                    </div>
                                    <h3 class="font-bold text-lg mb-2">Camera-Ready</h3>
                                    <p class="text-gray-600 text-sm">Final revised papers must be submitted.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="w-1/4 px-4">
                            <div class="relative flex flex-col items-center">
                                <div class="absolute -top-5">
                                    <div class="rounded-full bg-blue-600 w-10 h-10 flex items-center justify-center border-4 border-white shadow-lg">
                                        <i class="fas fa-user-check text-white"></i>
                                    </div>
                                </div>
                                <div class="bg-white rounded-lg shadow-lg p-6 mt-8 w-full transform transition hover:-translate-y-2 duration-300 hover:shadow-xl date-card">
                                    <div class="text-blue-600 mb-2">
                                        <i class="fas fa-calendar-day mr-2"></i>
                                        @php
                                            $date = \DateTime::createFromFormat('Y-m-d', $settings['registration_deadline']);
                                            $formattedDate = $date ? $date->format('M d, Y') : $settings['registration_deadline'];
                                        @endphp
                                        {{ $formattedDate }}
                                    </div>
                                    <h3 class="font-bold text-lg mb-2">Registration</h3>
                                    <p class="text-gray-600 text-sm">Deadline for author registration and payment.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="md:hidden">
                    <div class="relative pl-8 timeline-line">
                        <div class="mb-10 relative timeline-dot">
                            <div class="absolute -left-10 top-0 bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-file-alt text-white text-sm"></i>
                            </div>
                            <div class="bg-white rounded-lg shadow p-4 ml-4">
                                <h5 class="text-lg font-semibold text-gray-800">Paper Submission</h5>
                                <div class="text-blue-600 text-sm mb-1">
                                    @php
                                        $date = \DateTime::createFromFormat('Y-m-d', $settings['submission_deadline']);
                                        $formattedDate = $date ? $date->format('M d, Y') : $settings['submission_deadline'];
                                    @endphp
                                    {{ $formattedDate }}
                                </div>
                                <p class="text-gray-600 text-sm">Deadline for authors to submit their complete papers.</p>
                            </div>
                        </div>
                        
                        <div class="mb-10 relative timeline-dot">
                            <div class="absolute -left-10 top-0 bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-search text-white text-sm"></i>
                            </div>
                            <div class="bg-white rounded-lg shadow p-4 ml-4">
                                <h5 class="text-lg font-semibold text-gray-800">Review Notification</h5>
                                <div class="text-blue-600 text-sm mb-1">
                                    @php
                                        $date = \DateTime::createFromFormat('Y-m-d', $settings['review_deadline']);
                                        $formattedDate = $date ? $date->format('M d, Y') : $settings['review_deadline'];
                                    @endphp
                                    {{ $formattedDate }}
                                </div>
                                <p class="text-gray-600 text-sm">Authors will be notified of acceptance decisions.</p>
                            </div>
                        </div>
                        
                        <div class="mb-10 relative timeline-dot">
                            <div class="absolute -left-10 top-0 bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-camera text-white text-sm"></i>
                            </div>
                            <div class="bg-white rounded-lg shadow p-4 ml-4">
                                <h5 class="text-lg font-semibold text-gray-800">Camera-Ready Submission</h5>
                                <div class="text-blue-600 text-sm mb-1">
                                    @php
                                        $date = \DateTime::createFromFormat('Y-m-d', $settings['camera_ready_deadline']);
                                        $formattedDate = $date ? $date->format('M d, Y') : $settings['camera_ready_deadline'];
                                    @endphp
                                    {{ $formattedDate }}
                                </div>
                                <p class="text-gray-600 text-sm">Final revised papers must be submitted.</p>
                            </div>
                        </div>
                        
                        <div class="mb-10 relative timeline-dot">
                            <div class="absolute -left-10 top-0 bg-blue-600 rounded-full w-8 h-8 flex items-center justify-center">
                                <i class="fas fa-user-check text-white text-sm"></i>
                            </div>
                            <div class="bg-white rounded-lg shadow p-4 ml-4">
                                <h5 class="text-lg font-semibold text-gray-800">Registration Deadline</h5>
                                <div class="text-blue-600 text-sm mb-1">
                                    @php
                                        $date = \DateTime::createFromFormat('Y-m-d', $settings['registration_deadline']);
                                        $formattedDate = $date ? $date->format('M d, Y') : $settings['registration_deadline'];
                                    @endphp
                                    {{ $formattedDate }}
                                </div>
                                <p class="text-gray-600 text-sm">Deadline for author registration and payment.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="submission" class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16 section-title">Paper Submission</h2>
            
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="p-8">
                        <h4 class="text-2xl font-semibold mb-6">Guidelines for Authors</h4>
                        <p class="text-gray-600 mb-8">{{ $settings['submission_guidelines'] }}</p>
                        
                        <h4 class="text-2xl font-semibold mb-6">Review Criteria</h4>
                        <p class="text-gray-600 mb-8">{{ $settings['review_criteria'] }}</p>

                        <h4 class="text-2xl font-semibold mb-6">Submission Process</h4>
                        <p class="text-gray-600 mb-8"> To submit a paper must login to the <b>AcademIQ</b> platform. If you do not have an account, please register first.</p>
                        
                        <div class="mt-10 text-center">
                            @if (Route::has('login'))
                                @auth
                                    <a href="{{ url('/dashboard') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-300">Go to Dashboard</a>
                                @else
                                    <a href="{{ route('login') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg font-medium transition-colors duration-300">Login to Submit</a>
                                    @if (Route::has('register'))
                                        <a href="{{ route('register') }}" class="ml-4 border border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-8 py-3 rounded-lg font-medium transition-colors duration-300">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="topics" class="py-20 bg-gradient-to-b from-gray-50 to-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16 section-title">Conference Topics</h2>
            
            <div class="max-w-6xl mx-auto">
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                        $keywordGroups = [
                            'core' => array_slice($settings['keywords_array'], 0, ceil(count($settings['keywords_array'])/3)),
                            'emerging' => array_slice($settings['keywords_array'], ceil(count($settings['keywords_array'])/3), ceil(count($settings['keywords_array'])/3)),
                            'applied' => array_slice($settings['keywords_array'], 2*ceil(count($settings['keywords_array'])/3))
                        ];
                        $groupInfo = [
                            'core' => [
                                'icon' => 'fas fa-laptop-code',
                                'title' => 'Core Topics',
                                'color' => 'blue'
                            ],
                            'emerging' => [
                                'icon' => 'fas fa-lightbulb',
                                'title' => 'Emerging Areas',
                                'color' => 'purple'
                            ],
                            'applied' => [
                                'icon' => 'fas fa-cogs',
                                'title' => 'Applied Research',
                                'color' => 'green'
                            ]
                        ];
                    @endphp
                    
                    @foreach($keywordGroups as $group => $keywords)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-lg topic-card">
                            <div class="p-6">
                                <div class="flex items-center mb-6">
                                    <div class="rounded-full w-12 h-12 flex items-center justify-center {{ 'bg-'.$groupInfo[$group]['color'].'-100 text-'.$groupInfo[$group]['color'].'-600' }}">
                                        <i class="{{ $groupInfo[$group]['icon'] }} text-xl"></i>
                                    </div>
                                    <h3 class="text-xl font-bold ml-4">{{ $groupInfo[$group]['title'] }}</h3>
                                </div>
                                
                                <div class="space-y-4">
                                    @foreach($keywords as $keyword)
                                        <div class="flex items-center topic-item opacity-0">
                                            <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ 'bg-'.$groupInfo[$group]['color'].'-50 text-'.$groupInfo[$group]['color'].'-500' }} mr-3">
                                                <i class="fas fa-check text-sm"></i>
                                            </div>
                                            <div>
                                                <h5 class="font-medium">{{ trim($keyword) }}</h5>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                
                                <div class="mt-6 text-center">
                                    <button class="px-4 py-2 rounded-lg border {{ 'border-'.$groupInfo[$group]['color'].'-500 text-'.$groupInfo[$group]['color'].'-600 hover:bg-'.$groupInfo[$group]['color'].'-50' }} transition-colors duration-300 topic-details-btn">
                                        Learn more
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-16 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8">
                    <h3 class="text-2xl font-semibold text-center mb-8">Explore Research Areas</h3>
                    
                    <div class="flex flex-wrap justify-center gap-4">
                        @foreach($settings['keywords_array'] as $index => $keyword)
                            @php
                                $sizes = ['text-sm', 'text-base', 'text-lg', 'text-xl'];
                                $colors = ['blue', 'indigo', 'purple', 'cyan'];
                                
                                $size = $sizes[$index % count($sizes)];
                                $color = $colors[$index % count($colors)];
                                
                                $weights = ['font-normal', 'font-medium', 'font-semibold'];
                                $weight = $weights[$index % count($weights)];
                            @endphp
                            
                            <span class="{{ $size }} {{ $weight }} {{ 'text-'.$color.'-600 bg-'.$color.'-50 hover:bg-'.$color.'-100' }} px-4 py-2 rounded-full transition-all duration-300 cursor-pointer transform hover:scale-105 tag-item opacity-0">
                                {{ trim($keyword) }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="reviewers" class="py-20 bg-gradient-to-b from-white to-blue-50">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16 section-title">Program Committee</h2>
            
            <div class="text-center mb-10 max-w-3xl mx-auto">
                <p class="text-lg text-gray-700">Our papers are reviewed by a distinguished international program committee of leading researchers in the field.</p>
            </div>
            
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl mx-auto">
                @forelse($reviewers as $index => $reviewer)
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-lg reviewer-card opacity-0">
                    <div class="p-2">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-t-lg overflow-hidden">
                            <svg class="w-full h-48 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-1 text-gray-900">{{ $reviewer->name }} {{ $reviewer->last_name }}</h3>
                            <p class="text-blue-600 mb-3">{{ $reviewer->email }}</p>
                            <p class="text-gray-600 text-sm mb-4">Expert reviewer and committee member for {{ $settings['conference_acronym'] }}.</p>
                            <div class="flex justify-center space-x-3 text-gray-500">
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fas fa-globe"></i></a>
                                <a href="mailto:{{ $reviewer->email }}" class="hover:text-blue-600 transition-colors"><i class="fas fa-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-lg reviewer-card opacity-0">
                    <div class="p-2">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-t-lg overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Professor James Wilson" class="object-cover w-full h-48">
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-1 text-gray-900">Prof. James Wilson</h3>
                            <p class="text-blue-600 mb-3">Stanford University, USA</p>
                            <p class="text-gray-600 text-sm mb-4">Expert in Machine Learning and Artificial Intelligence with over 100 publications in top-tier conferences.</p>
                            <div class="flex justify-center space-x-3 text-gray-500">
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fas fa-globe"></i></a>
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-google"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-lg reviewer-card opacity-0">
                    <div class="p-2">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-t-lg overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Dr. Emily Chen" class="object-cover w-full h-48">
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-1 text-gray-900">Dr. Emily Chen</h3>
                            <p class="text-blue-600 mb-3">MIT, USA</p>
                            <p class="text-gray-600 text-sm mb-4">Specializes in Computer Vision and Deep Learning with extensive industry experience at leading tech companies.</p>
                            <div class="flex justify-center space-x-3 text-gray-500">
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fas fa-globe"></i></a>
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="bg-white rounded-xl shadow-md overflow-hidden transform transition-all duration-300 hover:-translate-y-2 hover:shadow-lg reviewer-card opacity-0">
                    <div class="p-2">
                        <div class="aspect-w-1 aspect-h-1 bg-gray-100 rounded-t-lg overflow-hidden">
                            <img src="https://randomuser.me/api/portraits/men/54.jpg" alt="Professor Ahmed Khan" class="object-cover w-full h-48">
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-xl mb-1 text-gray-900">Prof. Ahmed Khan</h3>
                            <p class="text-blue-600 mb-3">ETH Zurich, Switzerland</p>
                            <p class="text-gray-600 text-sm mb-4">Leading researcher in Distributed Systems and Cloud Computing, with numerous awards for academic excellence.</p>
                            <div class="flex justify-center space-x-3 text-gray-500">
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-linkedin"></i></a>
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fas fa-globe"></i></a>
                                <a href="#" class="hover:text-blue-600 transition-colors"><i class="fab fa-github"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
            
            <div class="text-center mt-12">
                <a href="#" class="inline-flex items-center px-6 py-3 border border-blue-600 text-blue-600 bg-white hover:bg-blue-600 hover:text-white rounded-lg transition-colors duration-300">
                    <span>View All Committee Members</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>

     <section id="location" class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-16 section-title">Conference Location</h2>
            
            <div class="grid md:grid-cols-2 gap-8 items-center max-w-6xl mx-auto">
                <div class="location-info opacity-0">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">{{ $settings['conference_location'] }}</h3>
                    <p class="text-gray-600 mb-6">Join us at this prestigious venue for {{ $settings['conference_acronym'] }} {{ $settings['conference_year'] }}. The conference will feature keynote speeches, paper presentations, and networking opportunities.</p>
                    
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div class="bg-blue-100 rounded-full p-2 mr-4">
                                <i class="fas fa-map-marker-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Address</h4>
                                <p class="text-gray-600">{{ $settings['conference_location'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-blue-100 rounded-full p-2 mr-4">
                                <i class="fas fa-calendar-alt text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Conference Dates</h4>
                                <p class="text-gray-600">December 15-18, {{ $settings['conference_year'] }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start">
                            <div class="bg-blue-100 rounded-full p-2 mr-4">
                                <i class="fas fa-subway text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Getting There</h4>
                                <p class="text-gray-600">Public transportation available. Parking facilities nearby.</p>
                            </div>
                        </div>
                    </div>
                    
                    <a href="https://maps.google.com/maps?q={{ urlencode($settings['conference_location']) }}" target="_blank" class="inline-flex items-center mt-6 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-300">
                        <span>Get Directions</span>
                        <i class="fas fa-directions ml-2"></i>
                    </a>
                </div>
                
                <div class="map-container h-80 md:h-96 rounded-xl shadow-lg overflow-hidden opacity-0">
                    <div class="h-full w-full relative">
                        <iframe 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            loading="lazy" 
                            allowfullscreen 
                            src="https://maps.google.com/maps?q={{ urlencode($settings['conference_location']) }}&output=embed">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-12">
                <div>
                    <h4 class="text-xl font-semibold mb-6">{{ $settings['conference_acronym'] }} {{ $settings['conference_year'] }}</h4>
                    <p class="text-gray-300 mb-6">{{ $settings['conference_description'] }}</p>
                    <div class="flex space-x-4">
                        <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-10 h-10 bg-gray-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-colors duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <div>
                    <h4 class="text-xl font-semibold mb-6">Quick Links</h4>
                    <ul class="space-y-3">
                        <li><a href="#" class="text-gray-300 hover:text-white transition-colors duration-300">Home</a></li>
                        <li><a href="#about" class="text-gray-300 hover:text-white transition-colors duration-300">About</a></li>
                        <li><a href="#dates" class="text-gray-300 hover:text-white transition-colors duration-300">Important Dates</a></li>
                        <li><a href="#submission" class="text-gray-300 hover:text-white transition-colors duration-300">Submission</a></li>
                        <li><a href="#reviewers" class="text-gray-300 hover:text-white transition-colors duration-300">Reviewers</a></li>
                        <li><a href="#location" class="text-gray-300 hover:text-white transition-colors duration-300">Location</a></li>
                        @if (Route::has('login'))
                            <li><a href="{{ route('login') }}" class="text-gray-300 hover:text-white transition-colors duration-300">Login</a></li>
                        @endif
                    </ul>
                </div>
                
                <div>
                    <h4 class="text-xl font-semibold mb-6">Contact Us</h4>
                    <ul class="space-y-4">
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1.5 mr-3 text-blue-400"></i>
                            <span>{{ $settings['conference_location'] }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-blue-400"></i>
                            <span>contact@{{ strtolower($settings['conference_acronym']) }}.org</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-globe mr-3 text-blue-400"></i>
                            <span>{{ $settings['conference_website'] }}</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-12 pt-8 text-center">
                <p>&copy; {{ $settings['conference_year'] }} {{ $settings['conference_name'] }}. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
            menu.classList.toggle('block');
        });
        
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('bg-white', 'text-gray-800', 'shadow-md');
                navbar.classList.remove('text-white');
            } else {
                navbar.classList.remove('bg-white', 'text-gray-800', 'shadow-md');
                navbar.classList.add('text-white');
            }
        });

        function updateCountdown() {
            const deadlineStr = "{{ $settings['submission_deadline'] }}";
            const deadline = new Date(deadlineStr).getTime();
            const now = new Date().getTime();
            const timeLeft = deadline - now;
            
            if (timeLeft <= 0) {
                document.getElementById('days').innerText = "0";
                document.getElementById('hours').innerText = "0";
                document.getElementById('minutes').innerText = "0";
                document.getElementById('seconds').innerText = "0";
                return;
            }
            
            const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
            const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);
            
            document.getElementById('days').innerText = days;
            document.getElementById('hours').innerText = hours;
            document.getElementById('minutes').innerText = minutes;
            document.getElementById('seconds').innerText = seconds;
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);

        document.addEventListener("DOMContentLoaded", function() {
            setupSectionAnimations();
        });
        
        function setupSectionAnimations() {
            const timelineCards = document.querySelectorAll('.date-card');
            const timelineObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        timelineCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('animate-fadeInUp');
                            }, index * 150);
                        });
                        timelineObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });
            
            const topicCards = document.querySelectorAll('.topic-card');
            
            const topicObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        topicCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('animate-fadeInUp');
                                const topicItems = card.querySelectorAll('.topic-item');
                                topicItems.forEach((item, itemIndex) => {
                                    setTimeout(() => {
                                        item.classList.add('animate-fadeIn');
                                    }, 300 + (itemIndex * 100));
                                });
                            }, index * 200);
                        });
                        
                        topicObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });
            
            const tagObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const tags = document.querySelectorAll('.tag-item');
                        tags.forEach((tag, index) => {
                            setTimeout(() => {
                                tag.classList.add('animate-scaleIn');
                            }, Math.random() * 1000); 
                        });
                        tagObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });
            
            const reviewerObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const reviewerCards = document.querySelectorAll('.reviewer-card');
                        reviewerCards.forEach((card, index) => {
                            setTimeout(() => {
                                card.classList.add('animate-fadeInUp');
                            }, index * 150);
                        });
                        reviewerObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            const locationObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const locationInfo = document.querySelector('.location-info');
                        const mapContainer = document.querySelector('.map-container');
                        
                        if (locationInfo) {
                            locationInfo.classList.add('animate-fadeInUp');
                        }
                        
                        if (mapContainer) {
                            setTimeout(() => {
                                mapContainer.classList.add('animate-fadeInUp');
                            }, 200);
                        }
                        
                        locationObserver.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.2
            });
            
            const timelineSection = document.querySelector('#dates');
            const topicSection = document.querySelector('#topics');
            const tagCloud = document.querySelector('#topics .flex.flex-wrap');
            const reviewerSection = document.querySelector('#reviewers');
            const locationSection = document.querySelector('#location');
            
            if (timelineSection) timelineObserver.observe(timelineSection);
            if (topicSection) topicObserver.observe(topicSection);
            if (tagCloud) tagObserver.observe(tagCloud);
            if (reviewerSection) reviewerObserver.observe(reviewerSection);
            if (locationSection) locationObserver.observe(locationSection);
        }
    </script>
</body>
</html>
