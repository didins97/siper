@extends('app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">Admin Operator</h1>
    <div class="row">
        <div class="col">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Status Pekerjaan</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2">
                        <canvas id="myPieChart"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fas fa-circle text-warning"></i> Dalam Antrian
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-primary"></i> Di Kerjakan
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-success"></i> Selesai
                        </span>
                        <span class="mr-2">
                            <i class="fas fa-circle text-danger"></i> Dibatalkan
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="col-xl-12 col-md-6 mb-2">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Di Kerjakan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <h5>{{ App\Models\PrintingJob::where('status', 'inprogress')->count() }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-12 col-md-6 mb-2">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Selesai</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <h5>{{ App\Models\PrintingJob::where('status', 'completed')->count() }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-12 col-md-6 mb-2">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Dalam Antrian</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <h5>{{ App\Models\PrintingJob::where('status', 'pending')->count() }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-12 col-md-6 mb-2">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Dibatalkan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"></div>
                            </div>
                            <div class="col-auto">
                                <h5>{{ App\Models\PrintingJob::where('status', 'cancelled')->count() }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('assets') }}/vendor/chart.js/Chart.min.js"></script>
    <script>
        $(document).ready(function() {
            $.ajax({
                type: "GET",
                url: "/operator/job-pie-chart",
                success: function(data) {
                    var data = data

                    console.log(data);

                    var ctx = document.getElementById("myPieChart");
                    var myPieChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ["Dalam Antrian", "Di Kerjakan", "Selesai", "Dibatalkan"],
                            datasets: [{
                                data: [data.pending, data.inProgress, data.completed,
                                    data.cancelled
                                ],
                                backgroundColor: ['#f7c64c', '#4e73df', '#1cc88a',
                                    '#e74a3b'
                                ],
                                hoverBackgroundColor: ['#e2b344', '#3c62c9', '#17a673',
                                    '#e74a3b'
                                ],
                                hoverBorderColor: "rgba(234, 236, 244, 1)",
                            }],
                        },
                        options: {
                            maintainAspectRatio: false,
                            tooltips: {
                                backgroundColor: "rgb(255,255,255)",
                                bodyFontColor: "#858796",
                                borderColor: '#dddfeb',
                                borderWidth: 1,
                                xPadding: 15,
                                yPadding: 15,
                                displayColors: false,
                                caretPadding: 10,
                            },
                            legend: {
                                display: false
                            },
                            cutoutPercentage: 80,
                        },
                    });
                }
            });
        });
    </script>
@endpush
