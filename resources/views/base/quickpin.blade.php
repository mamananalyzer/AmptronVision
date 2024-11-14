@extends('base.0layout')

@section('title', 'Quick Pin')

@section('link')
<script src="sneat/assets/vendor/libs/apex-charts/echarts.min.js"></script>
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
  <div class="row mb-12 g-6">
    <div class="card">
      <div class="col-md-6 col-lg-8">
        <!--<h6 class="mt-2 text-muted">Data Real Time Monitoring</h6>-->
        <div class="card">
          <div class="card-header py-4">
            <ul class="nav nav-pills" role="tablist">
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-pills-browser" aria-controls="navs-pills-browser"
                  aria-selected="true">Frequency</button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-os"
                  aria-controls="navs-pills-os" aria-selected="false" tabindex="-1">Voltage 1</button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" data-bs-toggle="tab"
                  data-bs-target="#navs-pills-country" aria-controls="navs-pills-country" aria-selected="false"
                  tabindex="-1">Voltage 2</button>
              </li>
            </ul>
          </div>
          <div class="tab-content pt-0">
            <div class="tab-pane fade active show" id="navs-pills-browser" role="tabpanel">
              <div class="table-responsive text-start">
                <!--<table class="table table-borderless text-nowrap"></table>-->
                  <div id="container" style="width: 600px; height: 400px; overflow: hidden;"></div>
                  <style>
                    #container {
                      width: 100%;
                      /* Pastikan menempati seluruh lebar kontainer induk */
                      height: 400px;
                      /* Tinggi spesifik agar tidak terpotong */
                      overflow: hidden;
                    }

                    /* Pastikan tabel responsif tidak menyebabkan overflow */
                    .table-responsive {
                      overflow-x: auto;
                    }
                  </style>
                <script type="text/javascript">
                  var dom = document.getElementById('container');
                  var myChart = echarts.init(dom, null, {
                    renderer: 'canvas',
                    useDirtyRect: false
                  });
                  var app = {};

                  var option;

                  // Data voltase berdasarkan waktu (menit dan detik)
                  let data = [
                    { name: '2024/11/13 00:01:00', value: ['2024/11/13 00:01:00', 150] },
                    { name: '2024/11/13 00:02:00', value: ['2024/11/13 00:02:00', 215] },
                    { name: '2024/11/13 00:03:00', value: ['2024/11/13 00:03:00', 180] },
                    { name: '2024/11/13 00:04:00', value: ['2024/11/13 00:04:00', 130] },
                    { name: '2024/11/13 00:05:00', value: ['2024/11/13 00:05:00', 225] },
                    { name: '2024/11/13 00:06:00', value: ['2024/11/13 00:06:00', 190] },
                    { name: '2024/11/13 00:07:00', value: ['2024/11/13 00:07:00', 222] }
                  ];

                  option = {
                    title: {
                      text: 'Voltage Over Time (Minutes and Seconds)'
                    },
                    tooltip: {
                      trigger: 'axis',
                      formatter: function (params) {
                        params = params[0];
                        var date = new Date(params.name);
                        return (
                          date.getHours().toString().padStart(2, '0') + ':' +
                          date.getMinutes().toString().padStart(2, '0') + ':' +
                          date.getSeconds().toString().padStart(2, '0') +
                          ' : ' + params.value[1] + ' V'
                        );
                      },
                      axisPointer: {
                        animation: false
                      }
                    },
                    xAxis: {
                      type: 'time',
                      splitLine: {
                        show: false
                      }
                    },
                    yAxis: {
                      type: 'value',
                      boundaryGap: [0, '100%'],
                      splitLine: {
                        show: false
                      },
                      name: 'Voltage (V)'
                    },

                    dataZoom: [
                      {
                        type: 'inside',
                        start: 0,
                        end: 100
                      },
                      {
                        start: 0,
                        end: 100
                      }
                    ],

                    series: [
                      {
                        name: 'Voltage',
                        type: 'line',
                        showSymbol: true,
                        data: data
                      }
                    ]
                  };

                  if (option && typeof option === 'object') {
                    myChart.setOption(option);
                  }

                  window.addEventListener('resize', myChart.resize);
                </script>

              </div>
            </div>
          </div>
        </div>
      </div>
      @endsection