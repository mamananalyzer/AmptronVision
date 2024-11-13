@extends('base.0layout')

@section('title', 'Monitoring')

@section('link')

@endsection

{{-- @section('zone-link')
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="sneat/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="sneat/assets/vendor/libs/i18n/i18n.js"></script>
    <script src="sneat/assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="sneat/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="sneat/assets/vendor/libs/moment/moment.js"></script>
    <script src="sneat/assets/vendor/libs/datatable-bs5/datatable-bootstrap5.js"></script>
    <script src="sneat/assets/vendor/libs/select2/select2.js"></script>
    <script src="sneat/assets/vendor/libs/%40form-validation/umd/bundle/popular.min.js"></script>
    <script src="sneat/assets/vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="sneat/assets/vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js"></script>
    <script src="sneat/assets/vendor/libs/cleavejs/cleave.js"></script>
    <script src="sneat/assets/vendor/libs/cleavejs/cleave-phone.js"></script>

    <!-- Page JS -->
    <script src="sneat/assets/js/app-user-list.js"></script>
@endsection --}}

@section('content')

<div class="flex-grow-1 container-p-y container-fluid">
    <div class="col-12">
        <div class="card">
        </div>
    </div>
</div>

<div class="flex-grow-1 container-p-y container-fluid">
    <div class="col-12 mb-4">
        <div class="card">
            {{-- <div class="card-header header-elements">

            </div> --}}
            {{-- <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <div class="row">
                            <div class="card">
                                <div class="row">
                                    <div class="card mx-2">
                                        <div class="d-flex align-items-start">
                                            <div class="avatar me-3">
                                                <img src="../sneat/assets/img/avatars/2.png" alt="Avatar" class="rounded-circle" style="width: 50px; height: 50px;">
                                            </div>
                                            <div class="me-2">
                                                <span>Good Evening</span>
                                                <h3>Mr. LyZer</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <span class="my-2">My Room</span>
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <div class="col card mx-2 my-1 py-3 d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="bx bx-user"></i>
                                                    <br>
                                                    <span>Good Evening</span>
                                                </div>
                                            </div>
                                            <div class="col card mx-2 my-1 py-3 d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="bx bx-user"></i>
                                                    <br>
                                                    <span>Good Evening</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col card mx-2 my-1 py-3 d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="bx bx-user"></i>
                                                    <br>
                                                    <span>Good Evening</span>
                                                </div>
                                            </div>
                                            <div class="col card mx-2 my-1 py-3 d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="bx bx-user"></i>
                                                    <br>
                                                    <span>Good Evening</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col card mx-2 my-1 py-3 d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="bx bx-user"></i>
                                                    <br>
                                                    <span>Good Evening</span>
                                                </div>
                                            </div>
                                            <div class="col card mx-2 my-1 py-3 d-flex align-items-start">
                                                <div class="me-2">
                                                    <i class="bx bx-user"></i>
                                                    <br>
                                                    <span>Good Evening</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col card mx-2 my-1 py-3 d-flex align-items-start">
                                                <span>Set Room Environment</span>
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <i class="bx bx-user"></i>
                                                        <a href="">Music</a>
                                                    </div>
                                                    <div class="col text-center">
                                                        <i class="bx bx-user"></i>
                                                        <a href="">Music</a>
                                                    </div>
                                                    <div class="col text-center">
                                                        <i class="bx bx-user"></i>
                                                        <a href="">Music</a>
                                                    </div>
                                                    <div class="col text-center">
                                                        <i class="bx bx-user"></i>
                                                        <a href="">Music</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="row px-3">
                                <span>Voice Assistance</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="row">
                            <div class="col card">
                                <div class="row">
                                    <div class="col">
                                        <h2>My Workstation</h2>
                                        <a href="">Entrance</a>
                                    </div>
                                    <div class="col">
                                        <a href="">Entrance</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="row">
                                    <div class="col card mx-2">
                                        <a href="">Entrance</a>
                                    </div>
                                    <div class="col card mx-2">
                                        <a href="">Entrance</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card">
                                <div class="row">
                                    <div class="col card my-1">
                                        <h2>Accessories</h2>
                                        <div class="row">
                                            <div class="col">
                                                <a href="">Wifi</a>
                                            </div>
                                            <div class="col">
                                                <a href="">Wifi</a>
                                            </div>
                                            <div class="col">
                                                <a href="">Wifi</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <a href="">Music</a>
                                        </div>
                                    </div>
                                    <div class="col card my-1">
                                        <div class="row card mx-1 my-1">
                                            <h2>Accessories</h2>
                                            <div class="col">
                                                <a href="">Wifi</a>
                                            </div>
                                            <div class="col">
                                                <a href="">Wifi</a>
                                            </div>
                                            <div class="col">
                                                <a href="">Wifi</a>
                                            </div>
                                        </div>
                                        <div class="row card mx-1 my-1">
                                            <h3>LED Strips Light</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="row my-3">
                                    <div class="col card ms-3">
                                        <h3>Air Conditioner</h3>
                                    </div>
                                    <div class="col-7 card mx-3">
                                        <div class="card-header header-elements">
                                            <div>
                                            <h5 class="card-title mb-0">Statistics</h5>
                                            <small class="text-muted">Commercial networks and enterprises</small>
                                            </div>
                                            <div class="card-header-elements ms-auto py-0">
                                            <h5 class="mb-0 me-3">$ 78,000</h5>
                                            <span class="badge bg-label-secondary">
                                                <i class="bx bx-up-arrow-alt bx-xs text-success"></i>
                                                <span class="align-middle">37%</span>
                                            </span>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <canvas id="lineChart" class="chartjs" data-height="500" height="500" style="display: block; box-sizing: border-box; height: 500px; width: 988px;" width="988"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
      </div>
</div>

{{-- <div class="flex-grow-1 container-p-y container-fluid">
    <div class="col-12 mb-4">
        <div class="card">
          <div class="card-header header-elements">
            <div>
              <h5 class="card-title mb-0">Statistics</h5>
              <small class="text-muted">Commercial networks and enterprises</small>
            </div>
            <div class="card-header-elements ms-auto py-0">
              <h5 class="mb-0 me-3">$ 78,000</h5>
              <span class="badge bg-label-secondary">
                <i class="bx bx-up-arrow-alt bx-xs text-success"></i>
                <span class="align-middle">37%</span>
              </span>
            </div>
          </div>
          <div class="card-body">
            <canvas id="lineChart" class="chartjs" data-height="500" height="500" style="display: block; box-sizing: border-box; height: 500px; width: 988px;" width="988"></canvas>
          </div>
        </div>
      </div>
</div> --}}

<div class="flex-grow-1 container-p-y container-fluid">
    <style>
        .text-l {
            font-size: 20px;
            color: #282828;
            font-weight: 500;
            letter-spacing: 2%;
        }

        .text-sm {
            font-size: 12px;
            color: #808692;
            letter-spacing: -2%;
        }

        .text-m {
            font-size: 16px;
            color: #282828;
            font-weight: 500;
            letter-spacing: -2%;
        }
    </style>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row align-items-center" style="padding-bottom: 28px; margin: 12px 0 0 0; border-bottom: 1px solid #DEE6ED;">
                <div class="col">
                    <span class="text-l">IPP Hambapraing Januari 2024</span>
                </div>
                <div class="col-auto">
                    <a href="sementara/yearly" class="btn-secondary">
                        <span>Filter Data</span>
                        <img src="uploads/img/filter.svg" width="14" height="14" alt="">
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-9" style="margin-top: 18px;">
                    <div class="card border-0" style="margin-bottom: 18px;">
                        <div class="row">
                            <div class="col-4">
                                <div class="card border-0" style="border-radius: 6px; background: #F7F8FA;">
                                    <div class="head" style="padding: 12px 0px; margin: 0 18px; border-bottom: 1px solid #DEE6ED;">
                                        <span style="font-size: 12px; color: #282828; font-weight: 500;">Suuny Days</span>
                                    </div>
                                    <div class="body align-items-center d-flex" style="padding: 0 18px; margin: 14px 0; flex-direction: column;">
                                        <span style="font-size: 1px; color: #F7F8FA;">dshbdaj</span>
                                        <canvas id="sunnyDays"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card border-0" style="border-radius: 6px; background: #F7F8FA;">
                                    <div class="head" style="padding: 12px 0px; margin: 0 18px; border-bottom: 1px solid #DEE6ED;">
                                        <span style="font-size: 12px; color: #282828; font-weight: 500;">Energy Achievement</span>
                                    </div>
                                    <div class="body" style="padding: 0 18px; margin: 14px 0;">
                                        <div class="card border-0" style="padding: 8px 12px 12px 12px; margin-bottom: 8px;">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="uploads/img/pln.svg" alt="" style="margin-top: 8px;">
                                                </div>
                                                <div class="col">
                                                    <div class="target">
                                                        <span style="font-size: 10px; color: #282828;">100 Kw to your achievement</span>
                                                        <div class="w-100 mt-1" style="background-color: #FEF3E6; border-radius: 10px; height: 4px;">
                                                            <div class="w3" style="height:4px; width:80%; background: #F69022; border-radius: 10px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="value" style="margin: 18px 0 0 18px; font-size: 10px; color: #808692;">
                                                        <span>100%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border-0" style="padding: 8px 12px 12px 12px;">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <img src="uploads/img/sesna.svg" alt="" style="margin-top: 8px;">
                                                </div>
                                                <div class="col">
                                                    <div class="target">
                                                        <span style="font-size: 10px; color: #282828;">100 Kw to your achievement</span>
                                                        <div class="w-100 mt-1" style="background-color: #F1F5FE; border-radius: 10px; height: 4px;">
                                                            <div class="w3" style="height:4px; width:39%; background: #2C65EB; border-radius: 10px;"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-auto">
                                                    <div class="value" style="margin: 18px 0 0 18px; font-size: 10px; color: #808692;">
                                                        <span>100%</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card border-0" style="border-radius: 6px; background: #F7F8FA;">
                                    <div class="head" style="padding: 12px 0px; margin: 0 18px; border-bottom: 1px solid #DEE6ED;">
                                        <span style="font-size: 12px; color: #282828; font-weight: 500;">Energy Delivered</span>
                                    </div>
                                    <div class="body" style="padding: 0 18px; margin: 14px 0;">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card border-0" style="padding: 10px; border-radius: 6px;">
                                                    <span style="font-size: 10px; color: #808692;">Energy Production</span>
                                                    <p class="mb-0" style="font-size: 10px; font-weight: 500; color: #282828;">125.708 kWh</p>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card border-0" style="padding: 10px; border-radius: 6px;">
                                                    <span style="font-size: 10px; color: #808692;">Energy Production</span>
                                                    <p class="mb-0" style="font-size: 10px; font-weight: 500; color: #282828;">125.708 kWh</p>
                                                </div>
                                            </div>
                                            <div class="col-12" style="margin-top: 16px;">
                                                <div class="card border-0" style="padding: 10px; border-radius: 6px;">
                                                    <span style="font-size: 10px; color: #808692;">Energy Production</span>
                                                    <p class="mb-0" style="font-size: 10px; font-weight: 500; color: #282828;">125.708 kWh</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card" style="border-radius: 6px; border: 1px solid #DEE6ED;">
                            <div class="head" style="padding: 12px 0px; margin: 0 18px; border-bottom: 1px solid #DEE6ED;">
                                <span style="font-size: 12px; color: #282828; font-weight: 500;">Energy</span>
                            </div>
                            <div class="body" style="padding: 0 18px; margin-bottom: 14px;">
                                <span style="font-size: 1px; color: #F7F8FA; position: relative;">dshbdaj</span>
                                <canvas id="energyDelivered"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-3 d-flex">
                    <div class="card" style="border-radius: 0px; border-right: 0; border-left: 1px solid #DEE6ED; border-bottom: 0; border-top: 0;">
                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="border-radius: 0px; border-right: 0; border-left: 0; border-bottom: 1px solid #DEE6ED; border-top: 0;">
                                    <div class="head" style="padding: 12px 0px; margin: 0 18px;">
                                        <span style="font-size: 12px; color: #282828; font-weight: 500;">Periode Hours</span>
                                    </div>
                                    <div class="body align-items-center d-flex" style="padding: 0 18px; margin: 14px 0; flex-direction: column;">
                                        <span style="font-size: 1px; color: #ffffff;">dshbdaj</span>
                                        <canvas id="periodeHours"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card" style="border-radius: 0px; border-right: 0; border-left: 0; border-bottom: 1px solid #DEE6ED; border-top: 0;">
                                    <div class="head" style="padding: 12px 0px 8px 0px; margin: 0 18px;">
                                        <span style="font-size: 12px; color: #282828; font-weight: 500;">PV Perfomance</span>
                                    </div>
                                    <div class="body" style="padding: 0 18px; margin-bottom: 14px;">
                                        <div class="row">
                                            <div class="col-12 d-flex" style="border-bottom: 1px solid #DEE6ED;">
                                                <div class="card w-100 text-center" style="padding: 12px 0; border-right: 1px solid #DEE6ED; border-bottom: 0; border-left: 0; border-top: 0; border-radius: 0px;">
                                                    <span class="text-sm">Capacity Factor</span>
                                                    <p class="text-m mb-0">38.13%</p>
                                                </div>
                                                <div class="card w-100 border-0 text-center" style="padding: 12px 0;">
                                                    <span class="text-sm">Maintenance Outage</span>
                                                    <p class="text-m mb-0">38.13%</p>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex">
                                                <div class="card w-100 text-center" style="padding: 12px 0; border-right: 1px solid #DEE6ED; border-bottom: 0; border-left: 0; border-top: 0; border-radius: 0px;">
                                                    <span class="text-sm">Outage Factor</span>
                                                    <p class="text-m mb-0">38.13%</p>
                                                </div>
                                                <div class="card w-100 border-0 text-center" style="padding: 12px 0;">
                                                    <span class="text-sm">RSF</span>
                                                    <p class="text-m mb-0">38.13%</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card" style="border-radius: 0px; border-right: 0; border-left: 0; border-bottom: 1px solid #DEE6ED; border-top: 0;">
                                    <div class="head" style="padding: 12px 0px; margin: 0 18px;">
                                        <span style="font-size: 12px; color: #282828; font-weight: 500;">Trip Hours</span>
                                    </div>
                                    <div class="body align-items-center d-flex" style="padding: 0 18px; margin: 14px 0; flex-direction: column;">
                                        <span style="font-size: 1px; color: #ffffff;">dshbdaj</span>
                                        <canvas id="tripHours"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="card border-0">
                                    <div class="head" style="padding: 12px 0px; margin: 0 18px;">
                                        <span style="font-size: 12px; color: #282828; font-weight: 500;">Trip Hours</span>
                                    </div>
                                    <div class="body align-items-center d-flex" style="padding: 0 18px; flex-direction: column;">
                                        <span style="font-size: 1px; color: #ffffff;">dshbdaj</span>
                                        <canvas id="tripHoursBar" height="180"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var ctx = document.getElementById('sunnyDays').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Good Sunny', 'Bad Sunny'],
                datasets: [{
                    label: 'My Dataset',
                    data: [30, 70], // Masukkan nilai parameter di sini
                    backgroundColor: [
                        'rgba(44, 101, 235)', // Warna untuk Parameter 1
                        'rgba(246, 144, 34)' // Warna untuk Parameter 2
                    ],
                    borderRadius: 100,
                    cutout: '80%'
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 2.44,
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'rectRounded'
                        },
                        position: 'right'
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('energyDelivered').getContext('2d');
        var myCombinedChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'],
                datasets: [{
                    type: 'line',
                    label: 'Line Dataset 1',
                    data: [100, 100, 100, 100, 100, 100, 100], // Data untuk garis 1 pada setiap bulan
                    backgroundColor: 'rgba(44, 101, 235)',
                    borderColor: 'rgba(41, 101, 235)',
                    fill: false
                }, {
                    type: 'line',
                    label: 'Line Dataset 2',
                    data: [80, 80, 80, 80, 80, 80, 80], // Data untuk garis 2 pada setiap bulan
                    backgroundColor: 'rgba(13, 51, 140)',
                    borderColor: 'rgba(13, 51, 140)',
                    fill: false
                }, {
                    type: 'line',
                    label: 'Line Dataset 3',
                    data: [90, 90, 90, 90, 90, 90, 90], // Data untuk garis 3 pada setiap bulan
                    backgroundColor: 'rgba(249, 77, 77)',
                    borderColor: 'rgba(249, 77, 77)',
                    fill: false
                }, {
                    type: 'bar',
                    label: 'Bar Dataset 1',
                    data: [40, 30, 20, 10, 30, 50, 70], // Data untuk batang 1 pada setiap bulan
                    backgroundColor: 'rgba(250, 195, 31)'
                }, {
                    type: 'bar',
                    label: 'Bar Dataset 2',
                    data: [20, 40, 60, 80, 60, 40, 20], // Data untuk batang 2 pada setiap bulan
                    backgroundColor: 'rgba(246, 144, 34)'
                }, {
                    type: 'bar',
                    label: 'Bar Dataset 3',
                    data: [10, 20, 30, 40, 20, 10, 5], // Data untuk batang 3 pada setiap bulan
                    backgroundColor: 'rgba(52, 168, 83)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index'
                    },
                    legend: {
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'rectRounded'
                        },
                        position: 'bottom'
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('periodeHours').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['RSF', 'SF', 'EFOR'],
                datasets: [{
                    label: 'My Dataset',
                    data: [30, 50, 20], // Masukkan nilai parameter di sini
                    backgroundColor: [
                        'rgba(44, 101, 235)', // Warna untuk Parameter 1
                        'rgba(246, 144, 34)', // Warna untuk Parameter 2
                        'rgba(52, 168, 83)', // Warna untuk Parameter 3
                    ],
                    borderRadius: 100,
                    cutout: '80%'
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 2.44,
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'rectRounded'
                        },
                        position: 'right'
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('tripHours').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['PLN Trip', 'PLTS Trip', 'PPA Trip'],
                datasets: [{
                    label: 'My Dataset',
                    data: [30, 50, 20], // Masukkan nilai parameter di sini
                    backgroundColor: [
                        'rgba(44, 101, 235)', // Warna untuk Parameter 1
                        'rgba(246, 144, 34)', // Warna untuk Parameter 2
                        'rgba(52, 168, 83)', // Warna untuk Parameter 3
                    ],
                    borderRadius: 100,
                    cutout: '80%'
                }]
            },
            options: {
                responsive: true,
                aspectRatio: 2.44,
                plugins: {
                    legend: {
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'rectRounded'
                        },
                        position: 'right'
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('lineChart').getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [
                    @foreach($monitoring as $mon)
                        "{{ $mon->created_at->format('H:i') }}",
                    @endforeach
                ],
                datasets: [{
                    label: 'Active Power (kW)',
                    data: [
                        @foreach($monitoring as $mon)
                            // {{ floatval(str_replace('_kW', '', $mon->active_power)) }},
                            {{ $mon->phase_a_current }},
                        @endforeach
                    ],
                    tension: 0.5,
                    pointRadius: 0, // Remove the data point dots
                    backgroundColor: 'rgba(168, 19, 62)',
                    borderColor: 'rgba(168, 19, 62)',
                    fill: false
                },
                {
                    label: 'Active Power (kW)',
                    data: [
                        @foreach($monitoring as $mon)
                            // {{ floatval(str_replace('_kW', '', $mon->active_power)) }},
                            {{ $mon->phase_b_current }},
                        @endforeach
                    ],
                    tension: 0.5,
                    pointRadius: 0, // Remove the data point dots
                    backgroundColor: 'rgba(237, 187, 0)',
                    borderColor: 'rgba(237, 187, 0)',
                    fill: false
                },
                {
                    label: 'Active Power (kW)',
                    data: [
                        @foreach($monitoring as $mon)
                            // {{ floatval(str_replace('_kW', '', $mon->active_power)) }},
                            {{ $mon->phase_c_current }},
                        @endforeach
                    ],
                    tension: 0.5,
                    pointRadius: 0, // Remove the data point dots
                    backgroundColor: 'rgba(0, 77, 152)',
                    borderColor: 'rgba(0, 77, 152)',
                    fill: false
                }]
            },
            options: {
                hover: {
                    mode: 'nearest',
                    intersect: false,
                },
                tooltips: {
                    mode: 'nearest',
                    intersect: false,
                },
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        mode: 'index'
                    },
                    legend: {
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle'
                        },
                        position: 'bottom'
                    }
                },
                transitions: {
                    show: {
                        animations: {
                            x: {
                                from: 0
                            },
                            y: {
                                from: 0,
                                to: 1,
                                type: 'easeInOutCubic',
                                duration: function(context) {
                                    return context.active.length * 1000;
                                }
                            }
                        }
                    },
                    hide: {
                        animations: {
                            x: {
                                to: 0
                            },
                            y: {
                                from: 0,
                                to: 1,
                                type: 'easeInOutCubic',
                                duration: function(context) {
                                    return context.active.length * 1000;
                                }
                            }
                        }
                    }
                }
            }
        });
    </script>

    <script>
        var ctx = document.getElementById('tripHoursBar').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['PLN Trip', 'PLTS Trip', 'PPA Trip', 'Total Trip'],
                datasets: [{
                    label: 'My Dataset',
                    data: [30, 10, 20, 50], // Masukkan nilai parameter di sini
                    backgroundColor: [
                        'rgba(44, 101, 235)', // Warna untuk Parameter 1
                        'rgba(246, 144, 34)', // Warna untuk Parameter 2
                        'rgba(250, 195, 31)', // Warna untuk Parameter 3
                        'rgba(52, 168, 83)', // Warna untuk Parameter 4
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</div>

@endsection
