@extends('chair.layouts.app')

@section('content')

  <!-- Hero Section -->
  <div class="pt-16 bg-gradient-to-br from-blue-600 via-blue-700 to-indigo-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
      <div class="text-center">
        <h1 class="text-5xl font-bold mb-6">Chair Dashboard</h1>
        <p class="text-xl mb-8 text-blue-100 max-w-3xl mx-auto">
          Welcome to your conference management portal. Oversee papers, manage reviewers, and ensure the highest quality standards for our academic conference.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{route('chair.papers.index')}}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors duration-200 shadow-lg">
            Manage Papers
          </a>
          <a href="{{route('chair.users.index')}}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors duration-200">
            Manage Users
          </a>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-blue-600 mb-2">{{ $totalPapers ?? '0' }}</div>
        <div class="text-gray-600">Total Papers</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-green-600 mb-2">{{ $acceptedPapers ?? '0' }}</div>
        <div class="text-gray-600">Accepted Papers</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-red-600 mb-2">{{ $rejectedPapers ?? '0' }}</div>
        <div class="text-gray-600">Rejected Papers</div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6 text-center">
        <div class="text-3xl font-bold text-orange-600 mb-2">{{ $underReviewPapers ?? '0' }}</div>
        <div class="text-gray-600">Under Review</div>
      </div>
    </div>    <!-- Chart Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
      <i class="fas fa-chart-bar text-blue-500 mr-3"></i>
      Monthly Paper Submissions in {{ date('Y') }}
      </h2>
      <div class="h-64">
      <canvas id="monthlyPapersChart"></canvas>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      const ctx = document.getElementById('monthlyPapersChart').getContext('2d');
      const monthlyPapersChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: {!! json_encode($monthLabels ?? ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']) !!},
        datasets: [{
          label: 'Papers Submitted',
          data: {!! json_encode($monthlyPapers ?? [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]) !!},
          backgroundColor: [
            'rgba(54, 162, 235, 0.7)', // January
            'rgba(75, 192, 192, 0.7)', // February
            'rgba(153, 102, 255, 0.7)', // March
            'rgba(255, 159, 64, 0.7)', // April
            'rgba(255, 99, 132, 0.7)',  // May
            'rgba(54, 162, 235, 0.7)', // June
            'rgba(75, 192, 192, 0.7)', // July
            'rgba(153, 102, 255, 0.7)', // August
            'rgba(255, 159, 64, 0.7)', // September
            'rgba(255, 99, 132, 0.7)',  // October
            'rgba(54, 162, 235, 0.7)', // November
            'rgba(75, 192, 192, 0.7)'  // December
          ],
          borderColor: [
            'rgba(54, 162, 235, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(153, 102, 255, 1)',
            'rgba(255, 159, 64, 1)',
            'rgba(255, 99, 132, 1)',
            'rgba(54, 162, 235, 1)',
            'rgba(75, 192, 192, 1)'
          ],
          borderWidth: 1,
          borderRadius: 5,
          barThickness: 30,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            callbacks: {
              title: function(tooltipItems) {
                return tooltipItems[0].label + ' ' + {{ date('Y') }};
              },
              label: function(context) {
                return context.parsed.y + ' papers submitted';
              }
            }
          }
        },
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              precision: 0,
              stepSize: 1
            },
            title: {
              display: true,
              text: 'Number of Papers'
            }
          },
          x: {
            grid: {
              display: false
            },
            title: {
              display: true,
              text: 'Month'
            }
          }
        }
      }
      });
    </script>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-md p-6">
          <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
            <i class="fas fa-bolt text-blue-500 mr-3"></i>
            Quick Actions
          </h2>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <a href="{{route('chair.papers.index')}}" class="bg-blue-50 hover:bg-blue-100 p-6 rounded-lg transition-colors duration-200 border border-blue-200">
              <div class="flex items-center mb-4">
                <div class="bg-blue-500 text-white p-3 rounded-lg mr-4">
                  <i class="fas fa-file-alt text-xl"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Review Papers</h3>
                  <p class="text-sm text-gray-600">Manage submitted papers</p>
                </div>
              </div>
            </a>
            
            <a href="{{route('chair.users.index')}}" class="bg-green-50 hover:bg-green-100 p-6 rounded-lg transition-colors duration-200 border border-green-200">
              <div class="flex items-center mb-4">
                <div class="bg-green-500 text-white p-3 rounded-lg mr-4">
                  <i class="fas fa-users text-xl"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Manage Users</h3>
                  <p class="text-sm text-gray-600">Add or edit user accounts</p>
                </div>
              </div>
            </a>
            
            <a href="{{route('chair.settings')}}" class="bg-orange-50 hover:bg-orange-100 p-6 rounded-lg transition-colors duration-200 border border-orange-200">
              <div class="flex items-center mb-4">
                <div class="bg-orange-500 text-white p-3 rounded-lg mr-4">
                  <i class="fas fa-cogs text-xl"></i>
                </div>
                <div>
                  <h3 class="font-semibold text-gray-800">Settings</h3>
                  <p class="text-sm text-gray-600">Configure system settings</p>
                </div>
              </div>
            </a>
          </div>
        </div>     
      </div>

      <!-- Sidebar -->
      <div class="space-y-8">
        <!-- Conference Deadlines -->
        <div class="bg-white rounded-lg shadow-md p-6">
          <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
            <i class="fas fa-clock text-red-500 mr-3"></i>
            Important Deadlines
          </h3>
          <div class="space-y-4">
            <div class="border-l-4 border-red-500 pl-4">
              <div class="font-semibold text-gray-800">Paper Submission Deadline</div>
              <div class="text-sm text-gray-600">{{ $deadLines['submission'] }}</div>
            </div>
            <div class="border-l-4 border-yellow-500 pl-4">
              <div class="font-semibold text-gray-800">Review Period Ends</div>
              <div class="text-sm text-gray-600">{{ $deadLines['review'] }}</div>
            </div>
       
            <div class="border-l-4 border-blue-500 pl-4">
              <div class="font-semibold text-gray-800">Camera Ready </div>
              <div class="text-sm text-gray-600">{{ $deadLines['camera_ready'] }}</div>
            </div>
            <div class="border-l-4 border-blue-500 pl-4">
              <div class="font-semibold text-gray-800">Registration Deadline </div>
              <div class="text-sm text-gray-600">{{ $deadLines['registration'] }}</div>
            </div>



          </div>
        </div>


      </div>
    </div>
  </main>

@endsection
