@extends('layouts.admin.main')
@section('title')
PT. Trisurya Solusindo Utama || Admin
@endsection 
@section('pages')
Dashboard
@endsection
@section('content')
<div class="row">
    <div class="ms-3">
      <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
      <p class="mb-4">
        Check the sales, value and bounce rate by country.
      </p>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Total Produk</p>
              @php
                $produk = \App\Models\ProdukM::all()->count();
              @endphp
              <h4 class="mb-0">{{$produk}}</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Total Customer</p>
              @php
                $customer = \App\Models\CustomerM::all()->count();
              @endphp
              <h4 class="mb-0">{{$customer}}</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">person</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Total Pemesan</p>
              @php
                $pemesan = \App\Models\PesananM::all()->count();
                
              @endphp
              <h4 class="mb-0">{{$pemesan}}</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">leaderboard</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-header p-2 ps-3">
          <div class="d-flex justify-content-between">
            <div>
              <p class="text-sm mb-0 text-capitalize">Total Project</p>
              @php
              $project = \App\Models\ProjectM::all()->count();
              
            @endphp
              <h4 class="mb-0">{{$project}}</h4>
            </div>
            <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
              <i class="material-symbols-rounded opacity-10">weekend</i>
            </div>
          </div>
        </div>
        <hr class="dark horizontal my-0">
        <div class="card-footer p-2 ps-3">
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card">
        <div class="card-body">
          <h6 class="mb-0 ">Pembelian</h6>
          <p class="text-sm ">Performa Pembelian</p>
          <div class="pe-2">
            <div class="chart">
              <canvas id="myChart" class="chart-canvas" height="170"></canvas>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

              <script>
                  // Data pembelian per bulan dari server
                  const pembelianData = @json($pembelianPerBulan);

                  // Label bulan
                  const bulanLabels = [
                      "Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                  ];

                  // Inisialisasi chart
                  const ctx = document.getElementById('myChart').getContext('2d');
                  new Chart(ctx, {
                      type: "bar",
                      data: {
                          labels: bulanLabels, // Gunakan label bulan
                          datasets: [{
                              label: "Pembelian Per Bulan",
                              tension: 0.4,
                              borderWidth: 0,
                              borderRadius: 4,
                              borderSkipped: false,
                              backgroundColor: "#43A047",
                              data: pembelianData, // Data pembelian dari controller
                              barThickness: 'flex'
                          }],
                      },
                      options: {
                          responsive: true,
                          maintainAspectRatio: false,
                          plugins: {
                              legend: {
                                  display: false,
                              }
                          },
                          interaction: {
                              intersect: false,
                              mode: 'index',
                          },
                          scales: {
                              y: {
                                  grid: {
                                      drawBorder: false,
                                      display: true,
                                      drawOnChartArea: true,
                                      drawTicks: false,
                                      borderDash: [5, 5],
                                      color: '#e5e5e5'
                                  },
                                  ticks: {
                                      suggestedMin: 0,
                                      suggestedMax: 300,
                                      beginAtZero: true,
                                      padding: 10,
                                      font: {
                                          size: 14,
                                          lineHeight: 2
                                      },
                                      color: "#737373"
                                  },
                              },
                              x: {
                                  grid: {
                                      drawBorder: false,
                                      display: false,
                                      drawOnChartArea: false,
                                      drawTicks: false,
                                      borderDash: [5, 5]
                                  },
                                  ticks: {
                                      display: true,
                                      color: '#737373',
                                      padding: 10,
                                      font: {
                                          size: 14,
                                          lineHeight: 2
                                      },
                                  }
                              },
                          },
                      },
                  });
              </script>

          </div>
          <hr class="dark horizontal">
          <div class="d-flex ">
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6 mt-4 mb-4">
      <div class="card">
          <div class="card-body">
              <h6 class="mb-0">Pemesanan</h6>
              <p class="text-sm"><span>Performa Pemesanan</span></p>
              <div class="pe-2">
                  <div class="chart">
                      <canvas id="pemesanan-chart" class="chart-canvas" height="170"></canvas>
                  </div>
              </div>
              <hr class="dark horizontal">
          </div>
      </div>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
      document.addEventListener('DOMContentLoaded', function () {
          const ctx = document.getElementById('pemesanan-chart').getContext('2d');
          const data = @json($pesananPerBulan);
  
          new Chart(ctx, {
              type: 'line',
              data: {
                  labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                  datasets: [{
                      label: 'Pemesanan per Bulan',
                      data: data,
                      borderColor: '#4caf50',
                      backgroundColor: 'rgba(76, 175, 80, 0.2)',
                      tension: 0.4,
                  }]
              },
              options: {
                  responsive: false,
                  plugins: {
                      legend: { display: true },
                      tooltip: { enabled: true }
                  },
                  scales: {
                      x: { grid: { display: false } },
                      y: { beginAtZero: true }
                  }
              }
          });
      });
  </script>
  

  <div class="col-lg-4 mt-4 mb-3">
    <div class="card">
        <div class="card-body">
            <h6 class="mb-0">Category</h6>
            <p class="text-sm">Total Produk by Category</p>
            <div class="pe-2">
                <div class="chart">
                    <canvas id="category-chart" class="chart-canvas" height="170"></canvas>
                </div>
            </div>
            <hr class="dark horizontal">
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctx = document.getElementById('category-chart').getContext('2d');
        const categoryNames = @json($categoryNames);
        const categoryTotals = @json($categoryTotals);

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: categoryNames,
                datasets: [{
                    label: 'Total Produk',
                    data: categoryTotals,
                    backgroundColor: [
                        '#FF6384',
                        '#36A2EB',
                        '#FFCE56',
                        '#4CAF50',
                        '#FF9F40',
                        '#9966FF'
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: false,
                plugins: {
                    legend: { position: 'top' },
                    tooltip: { enabled: true }
                }
            }
        });
    });
</script>


  <div class="row mb-4">
    <div class="col-lg-12 col-md-6 mb-md-0 mb-4">
      <div class="card">
        <div class="card-header pb-0">
          <div class="row">
            <div class="col-lg-6 col-7">
              <h6>Recents Pemesanan</h6>
              <p class="text-sm mb-0">
                <i class="fa fa-check text-info" aria-hidden="true"></i>
                <span class="font-weight-bold ms-1">Pesanan terbaru </span>
              </p>
            </div>
            
          </div>
        </div>
        <div class="card-body px-0 pb-2">
          <div class="table-responsive">
            <table class="table align-items-center mb-0">
              <thead>
                <tr class="ml-3">
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Company</th>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Company's Email</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($pesananbaru as $baru)
                <tr>
                  <td>
                    <span class="text-xs font-weight-bold"> {{$baru->created_at}} </span>
                    
                  </td>
                  <td>
                    <span class="text-xs font-weight-bold"> {{$baru->email}} </span>
                  </td>
                  <td>
                    <span class="text-xs font-weight-bold"> {{$baru->company_name}} </span>
                  </td>
                  <td>
                    <span class="text-xs font-weight-bold"> {{$baru->email_perusahaan}} </span>
                  </td>
                </tr> 
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    
</div>
@endsection