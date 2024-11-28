@extends('base.0layout')

@section('title', 'Quick Pin')

@section('link')
<script src="sneat/assets/vendor/libs/apex-charts/echarts.min.js"></script>
<script src="sneat/assets/vendor/libs/flatpickr/flatpickr.js"></script>
@section('zone-link')
<!-- Optional: jQuery (required for DataTables) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script src="sneat/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- DataTables Bootstrap 5 JS -->
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<!-- Optional: Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
@endsection

@section('content')
<div class="flex-grow-1 container-p-y container-fluid">
  <div class="row mb-12 g-6">
    <div class="col-md-6 col-lg-6">
      <div style="margin-bottom: 20px;">
        <label for="datePicker" style="font-weight: bold; margin-right: 10px;">Select Date :</label>
        <input id="datePicker" type="text" placeholder="Pick a date" />
      </div>
      <!-- <div class="mb-4">
        <label for="datePicker">Select Date :</label>
        <input type="date" id="datePicker" />
      </div>-->
      <!--<h6 class="mt-2 text-muted">Data Real Time Monitoring</h6>-->
      <div class="card">
        <div class="card-header py-4">
          <ul class="nav nav-pills" role="tablist">
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                data-bs-target="#navs-pills-F" aria-controls="navs-pills-F" aria-selected="true">Freq</button>
            </li>
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-V1"
                aria-controls="navs-pills-V1" aria-selected="false" tabindex="-1">Voltage 1</button>
            </li>
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-V2"
                aria-controls="navs-pills-V2" aria-selected="false" tabindex="-1">Voltage 2</button>
            </li>
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-V3"
                aria-controls="navs-pills-V3" aria-selected="false" tabindex="-1">Voltage 3</button>
            </li>
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-VAvg"
                aria-controls="navs-pills-VAvg" aria-selected="false" tabindex="-1">Avg Voltage</button>
            </li>
          </ul>
        </div>
        <div class="tab-content pt-0">
          <div class="tab-pane fade active show" id="navs-pills-F" role="tabpanel">
            <div class="table-responsive text-start">
              <!--<table class="table table-borderless text-nowrap"></table>-->
              <div id="containerF" style="width: 530px; height: 330px; overflow: hidden;"></div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-V1" role="tabpanel">
            <div class="table-responsive text-start">
              <!--<table class="table table-borderless text-nowrap"></table>-->
              <div id="containerV1" style="width: 530px; height: 330px; overflow: hidden;"></div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-V2" role="tabpanel">
            <div class="table-responsive text-start">
              <!--<table class="table table-borderless text-nowrap"></table>-->
              <div id="containerV2" style="width: 530px; height: 330px; overflow: hidden;"></div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-V3" role="tabpanel">
            <div class="table-responsive text-start">
              <!--<table class="table table-borderless text-nowrap"></table>-->
              <div id="containerV3" style="width: 530px; height: 330px; overflow: hidden;"></div>
            </div>
          </div>
          <div class="tab-pane fade" id="navs-pills-VAvg" role="tabpanel">
            <div class="table-responsive text-start">
              <!--<table class="table table-borderless text-nowrap"></table>-->
              <div id="containerVAvg" style="width: 530px; height: 330px; overflow: hidden;"></div>
            </div>
          </div>
        </div>

        <script type="text/javascript">
          async function fetchData() {
            try {
              const response = await fetch('http://127.0.0.1:8000/api/v1/metering');
              return await response.json();
            } catch (error) {
              console.error('Error fetching data:', error);
              return [];
            }
          }

          function renderChart(containerId, titleText, yAxisName, dataKey, unit, selectedDate) {
            var dom = document.getElementById(containerId);
            var myChart = echarts.init(dom, null, {
              renderer: 'canvas',
              useDirtyRect: false
            });

            fetchData()
              .then(data => {
                let filteredData = data.filter(item => {
                  let itemDate = new Date(item.updated_at).toISOString().split('T')[0];
                  return itemDate === selectedDate;
                });

                let chartData = filteredData.map(item => ({
                  name: item.updated_at,
                  value: [item.updated_at, item[dataKey]]
                }));

                let values = chartData.map(item => item.value[1]).filter(val => val !== null);
                let minVal = Math.min(...values);
                let maxVal = Math.max(...values);
                let rangePadding = (maxVal - minVal) * 0.1;
                let yAxisMin = minVal - rangePadding;
                let yAxisMax = maxVal + rangePadding;

                let option = {
                  title: { text: titleText },
                  tooltip: {
                    trigger: 'axis',
                    formatter: function (params) {
                      params = params[0];
                      let date = new Date(params.name);
                      return (
                        date.getHours().toString().padStart(2, '0') + ':' +
                        date.getMinutes().toString().padStart(2, '0') + ':' +
                        date.getSeconds().toString().padStart(2, '0') +
                        ' : ' + (params.value[1] !== null ? params.value[1] + ' ' + unit : 'No Data')
                      );
                    },
                    axisPointer: { animation: false }
                  },
                  xAxis: { type: 'time', splitLine: { show: false } },
                  yAxis: {
                    type: 'value',
                    boundaryGap: [0, '100%'],
                    splitLine: { show: false },
                    name: yAxisName,
                    min: yAxisMin,
                    max: yAxisMax
                  },
                  dataZoom: [
                    { type: 'inside', start: 90, end: 100 },
                    { start: 90, end: 100 }
                  ],
                  series: [
                    {
                      name: titleText,
                      type: 'line',
                      showSymbol: true,
                      connectNulls: false,
                      data: chartData
                    }
                  ]
                };

                myChart.setOption(option);
              })
              .catch(error => console.error('Error rendering chart:', error));

            window.addEventListener('resize', myChart.resize);
          }

          async function initializeFlatpickrAndCharts() {
            const data = await fetchData();

            const latestDate = data.length > 0 ? new Date(data[data.length - 1].updated_at).toISOString().split('T')[0] : null;

            if (latestDate) {
              // Initialize Flatpickr
              flatpickr('#datePicker', {
                defaultDate: latestDate, // Set default date
                dateFormat: 'Y-m-d', // Format to match API
                onChange: (selectedDates, dateStr) => {
                  syncCharts(dateStr); // Update charts on date change
                }
              });

              // Render charts with the latest date
              syncCharts(latestDate);
            } else {
              console.error('No data available to initialize the charts.');
            }
          }

          function syncCharts(selectedDate) {
            renderChart('containerF', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz', selectedDate);
            renderChart('containerV1', 'Voltage 1 Over Time', 'Voltage (V)', 'U1', 'V', selectedDate);
            renderChart('containerV2', 'Voltage 2 Over Time', 'Voltage (V)', 'U2', 'V', selectedDate);
            renderChart('containerV3', 'Voltage 3 Over Time', 'Voltage (V)', 'U3', 'V', selectedDate);
            renderChart('containerVAvg', 'Average Voltage Over Time', 'Voltage (V)', 'Uavg', 'V', selectedDate);
          }

          // Initialize everything
          initializeFlatpickrAndCharts();
        </script>


        <!--<script type="text/javascript">
          // Helper function to add missing data points as null to break the line
          function fillMissingData(data, intervalMinutes) {
            const filledData = [];
            const intervalMillis = intervalMinutes * 60 * 1000; // Convert minutes to milliseconds

            for (let i = 0; i < data.length - 1; i++) {
              filledData.push(data[i]);

              const currentTime = new Date(data[i].name).getTime();
              const nextTime = new Date(data[i + 1].name).getTime();

              // If the gap between data points is greater than the interval, insert a null value
              if (nextTime - currentTime > intervalMillis) {
                filledData.push({ name: data[i + 1].name, value: [data[i + 1].name, null] });
              }
            }

            // Add the last data point
            filledData.push(data[data.length - 1]);
            return filledData;
          }

          function renderChart(containerId, titleText, yAxisName, dataKey, unit) {
            var dom = document.getElementById(containerId);
            var myChart = echarts.init(dom, null, {
              renderer: 'canvas',
              useDirtyRect: false
            });

            fetch('http://127.0.0.1:8000/api/v1/metering')
              .then(response => response.json())
              .then(data => {
                // Extract updated_at and specified dataKey values for the chart
                let chartData = data.map(item => ({
                  name: item.updated_at,
                  value: [item.updated_at, item[dataKey]]
                }));

                // Calculate the minimum and maximum values for y-axis range
                let values = chartData.map(item => item.value[1]).filter(val => val !== null);
                let minVal = Math.min(...values);
                let maxVal = Math.max(...values);

                // Add some padding to the range for better readability
                let rangePadding = (maxVal - minVal) * 0.1;
                let yAxisMin = minVal - rangePadding;
                let yAxisMax = maxVal + rangePadding;

                // Fill missing data with nulls to break the line
                let filledData = fillMissingData(chartData, 1); // 1-minute interval

                var option = {
                  title: {
                    text: titleText
                  },
                  tooltip: {
                    trigger: 'axis',
                    formatter: function (params) {
                      params = params[0];
                      let date = new Date(params.name);
                      return (
                        date.getHours().toString().padStart(2, '0') + ':' +
                        date.getMinutes().toString().padStart(2, '0') + ':' +
                        date.getSeconds().toString().padStart(2, '0') +
                        ' : ' + (params.value[1] !== null ? params.value[1] + ' ' + unit : 'No Data')
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
                    name: yAxisName,
                    min: yAxisMin,
                    max: yAxisMax
                  },

                  dataZoom: [
                    {
                      type: 'inside',
                      start: 90,
                      end: 100
                    },
                    {
                      start: 90,
                      end: 100
                    }
                  ],

                  series: [
                    {
                      name: titleText,
                      type: 'line',
                      showSymbol: true,
                      connectNulls: false, // Don't connect null values
                      data: filledData
                    }
                  ]
                };

                myChart.setOption(option);
              })
              .catch(error => console.error('Error fetching data:', error));

            window.addEventListener('resize', myChart.resize);
          }

          // Render charts with dynamic y-axis range
          renderChart('containerF', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz');
          renderChart('containerV1', 'Voltage 1 Over Time', 'Voltage (V)', 'U1', 'V');
          renderChart('containerV2', 'Voltage 2 Over Time', 'Voltage (V)', 'U2', 'V');
          renderChart('containerV3', 'Voltage 3 Over Time', 'Voltage (V)', 'U3', 'V');
          renderChart('containerVAvg', 'Avg Voltage Over Time', 'Voltage (V)', 'Uavg', 'V');
        </script>-->

        <!--<script type="text/javascript">
        // Helper function to add missing data points as null to break the line
        function fillMissingData(data, intervalMinutes) {
            const filledData = [];
            const intervalMillis = intervalMinutes * 60 * 1000; // Convert minutes to milliseconds

            for (let i = 0; i < data.length - 1; i++) {
                filledData.push(data[i]);

                const currentTime = new Date(data[i].name).getTime();
                const nextTime = new Date(data[i + 1].name).getTime();

                // If the gap between data points is greater than the interval, insert a null value
                if (nextTime - currentTime > intervalMillis) {
                    filledData.push({ name: data[i + 1].name, value: [data[i + 1].name, null] });
                }
            }

            // Add the last data point
            filledData.push(data[data.length - 1]);
            return filledData;
        }

        function renderChart(containerId, titleText, yAxisName, dataKey, unit) {
            var dom = document.getElementById(containerId);
            var myChart = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
            });

            fetch('http://127.0.0.1:8000/api/v1/metering')
                .then(response => response.json())
                .then(data => {
                    // Extract updated_at and specified dataKey values for the chart
                    let chartData = data.map(item => ({
                        name: item.updated_at,
                        value: [item.updated_at, item[dataKey]]
                    }));

                    // Fill missing data with nulls to break the line
                    let filledData = fillMissingData(chartData, 1); // 1-minute interval

                    var option = {
                        title: {
                            text: titleText
                        },
                        tooltip: {
                            trigger: 'axis',
                            formatter: function (params) {
                                params = params[0];
                                let date = new Date(params.name);
                                return (
                                    date.getHours().toString().padStart(2, '0') + ':' +
                                    date.getMinutes().toString().padStart(2, '0') + ':' +
                                    date.getSeconds().toString().padStart(2, '0') +
                                    ' : ' + (params.value[1] !== null ? params.value[1] + ' ' + unit : 'No Data')
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
                            name: yAxisName
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
                                name: titleText,
                                type: 'line',
                                showSymbol: true,
                                connectNulls: false, // Don't connect null values
                                data: filledData
                            }
                        ]
                    };

                    myChart.setOption(option);
                })
                .catch(error => console.error('Error fetching data:', error));

            window.addEventListener('resize', myChart.resize);
        }

        // Render Frequency and U1 charts
        renderChart('containerF', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz');
        renderChart('containerV1', 'U1 Over Time', 'Voltage (V)', 'U1', 'V');
        renderChart('containerV2', 'U2 Over Time', 'Voltage (V)', 'U2', 'V');
        // renderChart('U3', 'U3 Over Time', 'Voltage (V)', 'U3', 'V');
        // renderChart('U12', 'U12 Over Time', 'Voltage (V)', 'U12', 'V');
        // renderChart('U23', 'U23 Over Time', 'Voltage (V)', 'U23', 'V');
        // renderChart('U31', 'U31 Over Time', 'Voltage (V)', 'U31', 'V');
    </script> -->


        <!-- 
        <script type="text/javascript">
          function renderChart(containerId, titleText, yAxisName, seriesName, unit, data) {
            var dom = document.getElementById(containerId);
            var myChart = echarts.init(dom, null, {
              renderer: 'canvas',
              useDirtyRect: false
            });
            //var app = {};

            var option = {
              title: {
                text: titleText
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
                    ' : ' + params.value[1] + unit
                  );
                },
                axisPointer: {
                  animation: false
                }
              },
              xAxis: {
                type: 'time',
                splitLine: { show: false }
              },
              yAxis: {
                type: 'value',
                boundaryGap: [0, '100%'],
                splitLine: { show: false },
                name: yAxisName
              },
              dataZoom: [
                { type: 'inside', start: 0, end: 100 },
                { start: 0, end: 100 }
              ],
              series: [
                {
                  name: seriesName,
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
          }

          // Data untuk setiap grafik
          let dataFrequency = [
            { name: '2024/11/13 00:01:00', value: ['2024/11/13 00:01:00', 50] },
            { name: '2024/11/13 00:02:00', value: ['2024/11/13 00:02:00', 52] },
            { name: '2024/11/13 00:03:00', value: ['2024/11/13 00:03:00', 48] },
            { name: '2024/11/13 00:04:00', value: ['2024/11/13 00:04:00', 49] },
            { name: '2024/11/13 00:05:00', value: ['2024/11/13 00:05:00', 51] }
          ];
          let dataVoltage1 = [
            { name: '2024/11/13 00:01:00', value: ['2024/11/13 00:01:00', 150] },
            { name: '2024/11/13 00:02:00', value: ['2024/11/13 00:02:00', 170] },
            { name: '2024/11/13 00:03:00', value: ['2024/11/13 00:03:00', 160] },
            { name: '2024/11/13 00:04:00', value: ['2024/11/13 00:04:00', 180] },
            { name: '2024/11/13 00:05:00', value: ['2024/11/13 00:05:00', 175] }
          ];
          let dataVoltage2 = [
            { name: '2024/11/13 00:01:00', value: ['2024/11/13 00:01:00', 220] },
            { name: '2024/11/13 00:02:00', value: ['2024/11/13 00:02:00', 225] },
            { name: '2024/11/13 00:03:00', value: ['2024/11/13 00:03:00', 210] },
            { name: '2024/11/13 00:04:00', value: ['2024/11/13 00:04:00', 230] },
            { name: '2024/11/13 00:05:00', value: ['2024/11/13 00:05:00', 240] }
          ];

          // Render masing-masing grafik
          renderChart('containerF', 'Frequency Over Time', 'Frequency (Hz)', 'Frequency', ' Hz', dataFrequency);
          renderChart('containerV1', 'Voltage 1 Over Time', 'Voltage (V)', 'Voltage 1', ' V', dataVoltage1);
          renderChart('containerV2', 'Voltage 2 Over Time', 'Voltage (V)', 'Voltage 2', ' V', dataVoltage2);
        </script> -->
      </div>
    </div>

    <style>
      .text-successF {
        color: #28a745;
      }
    </style>

    <div class="col-sm-6 col-xl-3">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Frequency</span>
              <div class="d-flex align-items-end mt-2">
                <h4 id="f-value" class="mb-0 me-2">-- Hz</h4>
                <small id="f-change" class="text-success">-- </small>
              </div>
              <p class="mb-0">Real Time Frequency </p>
            </div>
            <div class="avatar">
              <img src="sneat/assets/img/icons/unicons/freq.png" alt="chart success" class="rounded" />
              <!--<span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-user-check bx-sm"></i> 
              </span> -->
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Voltage 1</span>
              <div class="d-flex align-items-end mt-2">
                <h4 id="v1-value" class="mb-0 me-2">-- V</h4>
                <small id="v1-change" class="text-success">-- </small>
              </div>
              <p class="mb-0">Real Time Voltage 1 </p>
            </div>
            <div class="avatar">
              <img src="sneat/assets/img/icons/unicons/freq.png" alt="chart success" class="rounded" />
              <!--<span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-user-check bx-sm"></i> 
              </span> -->
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Voltage 2</span>
              <div class="d-flex align-items-end mt-2">
                <h4 id="v2-value" class="mb-0 me-2">-- V</h4>
                <small id="v2-change" class="text-success">-- </small>
              </div>
              <p class="mb-0">Real Time Voltage 2 </p>
            </div>
            <div class="avatar">
              <img src="sneat/assets/img/icons/unicons/freq.png" alt="chart success" class="rounded" />
              <!--<span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-user-check bx-sm"></i> 
              </span> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-3">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Voltage 3</span>
              <div class="d-flex align-items-end mt-2">
                <h4 id="v3-value" class="mb-0 me-2">-- V</h4>
                <small id="v3-change" class="text-success">-- </small>
              </div>
              <p class="mb-0">Real Time Voltage 3 </p>
            </div>
            <div class="avatar">
              <img src="sneat/assets/img/icons/unicons/freq.png" alt="chart success" class="rounded" />
              <!--<span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-user-check bx-sm"></i> 
              </span> -->
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Voltage Average</span>
              <div class="d-flex align-items-end mt-2">
                <h4 id="vavg-value" class="mb-0 me-2">-- V</h4>
                <small id="vavg-change" class="text-success">-- </small>
              </div>
              <p class="mb-0">Real Time Average Voltage</p>
            </div>
            <div class="avatar">
              <img src="sneat/assets/img/icons/unicons/freq.png" alt="chart success" class="rounded" />
              <!--<span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-user-check bx-sm"></i> 
              </span> -->
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Total Energy</span>
              <div class="d-flex align-items-end mt-2">
                <h4 id="totE-value" class="mb-0 me-2">-- kWh</h4>
                <small id="totE-change" class="text-success">-- </small>
              </div>
              <p class="mb-0">Real Time Total Energy</p>
            </div>
            <div class="avatar">
              <img src="sneat/assets/img/icons/unicons/freq.png" alt="chart success" class="rounded" />
              <!--<span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-user-check bx-sm"></i> 
              </span> -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


  <script type="text/javascript">
    const apiUrl = 'http://127.0.0.1:8000/api/v1/metering'; // Replace with your API URL

    let previousFrequency = null; // Store previous frequency
    let previousVoltage = null; // Store previous voltage
    let previousFrequencyChange = null; // Store previous frequency change percentage
    let previousVoltageChange = null; // Store previous voltage change percentage
    let previousVoltage2 = null; // Store previous voltage
    let previousVoltageChange2 = null; // Store previous voltage change percentage
    let previousVoltage3 = null; // Store previous voltage
    let previousVoltageChange3 = null; // Store previous voltage change percentage
    let previousVoltageAvg = null; // Store previous voltage
    let previousVoltageChangeAvg = null; // Store previous voltage change percentage
    let previousTotalEnergy = null; // Store previous total energy
    let previousTotalEnergyChange = null; // Store previous total energy change percentage

    // Function to fetch and display the last 2 data points' frequency and voltage values
    function fetchAndDisplayLastTwoData() {
      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          console.log('API Response:', data); // Debug: Log the data

          // Check if there are at least two data points
          if (data.length < 2) {
            console.log('Not enough data to fetch the last 2 entries');
            return;
          }

          // Get the last 2 data entries
          const lastTwoData = data.slice(-2);

          // Get frequency (F) and voltage (U1) from the second-to-last entry (the last one was already displayed)
          const currentFrequency = lastTwoData[1].F;
          const currentVoltage = lastTwoData[1].U1;
          const currentVoltage2 = lastTwoData[1].U2;
          const currentVoltage3 = lastTwoData[1].U3;
          const currentVoltageAvg = lastTwoData[1].Uavg;
          const currentTotalEnergy = lastTwoData[1].Ep_sum;

          // Get HTML elements for displaying values
          const fValueElement = document.getElementById('f-value');
          const v1ValueElement = document.getElementById('v1-value');
          const v2ValueElement = document.getElementById('v2-value');
          const v3ValueElement = document.getElementById('v3-value');
          const vAvgValueElement = document.getElementById('vavg-value');
          const TotEValueElement = document.getElementById('totE-value');
          const fChangeElement = document.getElementById('f-change');
          const v1ChangeElement = document.getElementById('v1-change');
          const v2ChangeElement = document.getElementById('v2-change');
          const v3ChangeElement = document.getElementById('v3-change');
          const vAvgChangeElement = document.getElementById('vavg-change');
          const TotEChangeElement = document.getElementById('totE-change');

          // Calculate the percentage change for frequency
          let frequencyChange = 0;
          if (previousFrequency !== null && currentFrequency !== previousFrequency) {
            frequencyChange = ((currentFrequency - previousFrequency) / previousFrequency) * 100;
          } else {
            frequencyChange = previousFrequencyChange || 0; // If no change, keep the last change
          }

          // Calculate the percentage change for voltage
          let voltageChange = 0;
          if (previousVoltage !== null && currentVoltage !== previousVoltage) {
            voltageChange = ((currentVoltage - previousVoltage) / previousVoltage) * 100;
          } else {
            voltageChange = previousVoltageChange || 0; // If no change, keep the last change
          }

          let voltageChange2 = 0;
          if (previousVoltage2 !== null && currentVoltage2 !== previousVoltage2) {
            voltageChange2 = ((currentVoltage2 - previousVoltage2) / previousVoltage2) * 100;
          } else {
            voltageChange2 = previousVoltageChange2 || 0; // If no change, keep the last change
          }

          let voltageChange3 = 0;
          if (previousVoltage3 !== null && currentVoltage3 !== previousVoltage3) {
            voltageChange3 = ((currentVoltage3 - previousVoltage3) / previousVoltage3) * 100;
          } else {
            voltageChange3 = previousVoltageChange3 || 0; // If no change, keep the last change
          }

          let voltageChangeAvg = 0;
          if (previousVoltageAvg !== null && currentVoltageAvg !== previousVoltageAvg) {
            voltageChangeAvg = ((currentVoltageAvg - previousVoltageAvg) / previousVoltageAvg) * 100;
          } else {
            voltageChangeAvg = previousVoltageChangeAvg || 0; // If no change, keep the last change
          }

          let TotEChange = 0;
          if (previousTotalEnergy !== null && currentTotalEnergy !== previousTotalEnergy) {
            TotEChange = ((currentTotalEnergy - previousTotalEnergy) / previousTotalEnergy);
          } else {
            TotEChange = previousTotalEnergyChange || 0; // If no change, keep the last change
          }

          // Update the DOM with the frequency and voltage values
          fValueElement.textContent = `${currentFrequency} Hz`;
          v1ValueElement.textContent = `${currentVoltage} V`;
          v2ValueElement.textContent = `${currentVoltage2} V`;
          v3ValueElement.textContent = `${currentVoltage3} V`;
          vAvgValueElement.textContent = `${currentVoltageAvg} V`;
          TotEValueElement.textContent = `${currentTotalEnergy} kWh`;

          // Update the percentage change elements
          fChangeElement.textContent = `${frequencyChange.toFixed(2)}%`;
          v1ChangeElement.textContent = `${voltageChange.toFixed(2)}%`;
          v2ChangeElement.textContent = `${voltageChange2.toFixed(2)}%`;
          v3ChangeElement.textContent = `${voltageChange3.toFixed(2)}%`;
          vAvgChangeElement.textContent = `${voltageChangeAvg.toFixed(2)}%`;
          TotEChangeElement.textContent = `${TotEChange.toFixed(2)}`;

          // Store the current frequency, voltage, and changes as previous values for the next update
          previousFrequency = currentFrequency;
          previousVoltage = currentVoltage;
          previousFrequencyChange = frequencyChange;
          previousVoltageChange = voltageChange;
          previousVoltage2 = currentVoltage2;
          previousVoltageChange2 = voltageChange2;
          previousVoltage3 = currentVoltage3;
          previousVoltageChange3 = voltageChange3;
          previousVoltageAvg = currentVoltageAvg;
          previousVoltageChangeAvg = voltageChangeAvg;
          previousTotalEnergy = currentTotalEnergy;
          previousTotalEnergyChange = TotEChange;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    }

    // Fetch and display the data when the page loads
    document.addEventListener('DOMContentLoaded', fetchAndDisplayLastTwoData);

    // Optionally, update the data every few seconds (e.g., every 3 seconds)
    setInterval(fetchAndDisplayLastTwoData, 3000);
  </script>

  <!-- <script type="text/javascript">
    const apiUrl = 'http://127.0.0.1:8000/api/v1/metering'; // Replace with your API URL

    // Function to fetch and display the last 2 data points' frequency and voltage values
    function fetchAndDisplayLastTwoData() {
        fetch(apiUrl)
            .then(response => response.json())
            .then(data => {
                console.log('API Response:', data); // Debug: Log the data

                // Check if there are at least two data points
                if (data.length < 2) {
                    console.log('Not enough data to fetch the last 2 entries');
                    return;
                }

                // Get the last 2 data entries
                const lastTwoData = data.slice(-2);

                // Get frequency (F) and voltage (U1) from the last two data entries
                const frequency = lastTwoData[0].F; // Frequency of the second-to-last entry
                const voltage = lastTwoData[0].U1; // Voltage of the second-to-last entr

                // Get HTML elements for displaying values
                const fValueElement = document.getElementById('f-value');
                const v1ValueElement = document.getElementById('v1-value');

                // Update the DOM with the frequency and voltage values from the last two entries
                fValueElement.textContent = `${frequency} Hz`;
                v1ValueElement.textContent =` ${voltage} V`;

            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

    // Fetch and display the data when the page loads
    document.addEventListener('DOMContentLoaded', fetchAndDisplayLastTwoData);
</script>-->

  <!--<script type="text/javascript">
    const apiUrl = 'http://127.0.0.1:8000/api/v1/metering'; // Replace with your API URL

    let previousFValue = null; // Store the previous frequency value
    let updateTimeout = null; // Timeout reference for synchronized updates

    function updateFreqDisplay() {
      fetch(apiUrl) // Replace with your API URL
        .then(response => response.json())
        .then(data => {
          
          const latestData = data[data.length - 1];

          // Get the current frequency value
          const currentFValue = latestData.F;
          const fValueElement = document.getElementById('f-value');
          const fChangeElement = document.getElementById('f-change');

          // Calculate the percentage change for frequency
          let fChange = 0;
          if (previousFValue !== null) {
            // Calculate percentage change only if previous value exists
            fChange = ((currentFValue - previousFValue) / previousFValue)*100;
          }

          // Update the frequency value and percentage change
          fValueElement.textContent = `${currentFValue} Hz`;
          fChangeElement.textContent = `(${fChange.toFixed(2)}%)`;

          // Clear any existing timeout to prevent overlapping updates
          if (updateTimeout) {
            clearTimeout(updateTimeout);
          }

          // Set a timeout to clear both value and percentage change after 3 seconds
          updateTimeout = setTimeout(() => {
            fValueElement.textContent = ''; // Clear the frequency value
            fChangeElement.textContent = ''; // Clear the percentage change
          }, 3000); // Timeout duration in milliseconds

          // Store the current frequency value as the previous value for the next update
          previousFValue = currentFValue;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    }

    // Update every 3 seconds to match the timeout duration
    setInterval(updateFreqDisplay, 3000);
  </script> -->


  <div class="row mb-12 g-6">
    <div class="col-12 col-xl-12 mb-4">
      <div class="dt-action-buttons text-end pt-3 pt-md-5">
        <div class="dt-buttons btn-group flex-wrap">
          <div class="btn-group">
            <button class="btn buttons-collection dropdown-toggle btn-label-primary me-2" tabindex="0"
              aria-controls="DataTables_Table_0" type="button" aria-haspopup="dialog" aria-expanded="false">
              <span><i class="bx bx-export me-sm-1"></i>
                <span class="d-none d-sm-inline-block">Export</span>
              </span>
            </button>
          </div>
          <button class="btn btn-secondary create-new btn-primary" data-bs-toggle="modal"
            data-bs-target="#newLabelModal">
            <span><i class="bx bx-plus me-sm-1"></i>
              <span class="d-none d-sm-inline-block">Add Labels</span>
            </span>
          </button>
        </div>
      </div>
    </div>

    <div class="modal fade" id="newLabelModal" tabindex="-1" aria-modal="true" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel1">Add Labels</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post" action="{{ route('Quickpin_Label.create') }}" enctype="multipart/form-data"
              class="add-new-user pt-0 fv-plugins-bootstrap5 fv-plugins-framework" id="addNewQuotForm">
              @csrf <!-- CSRF protection -->
              @method('POST')
              <div class="card-body">
                <div class="mb-3">
                  {{-- <label for="node" class="form-label">Jenis Belanja</label> --}}
                  <select class="form-select" id="brand" aria-label="Default select example" name="brand">
                    <option selected="">Select Brand</option>
                    <option value="Rishabh">Rishabh</option>
                    <option value="Accuenergy">Accuenergy</option>
                    <option value="Camille Bauer">Camille Bauer</option>
                  </select>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="customer" name="customer" placeholder="PT. LyZer Tech"
                    aria-label="DE96" aria-describedby="customerHelp">
                  <label for="customer">Customer</label>
                </div>
                <div class="form-floating mb-3">
                  <input type="text" class="form-control" id="PO" name="PO" placeholder="2303 12341234"
                    aria-describedby="POHelp">
                  <label for="PO">PO Number</label>
                  {{-- <div id="POHelp" class="form-text">We'll never share your details with anyone else.
                  </div> --}}
                </div>
                <div class="row g-1" id="dynamicTypeQty">
                  <div class="col">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="type" name="type[]" placeholder="DE96"
                        aria-label="DE96" aria-describedby="typeHelp">
                      <label for="type">Type</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="scale" name="scale[]" placeholder="10"
                        aria-label="DE96" aria-describedby="scaleHelp">
                      <label for="scale">Scale</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="input" name="input[]" placeholder="10"
                        aria-label="DE96" aria-describedby="inputHelp">
                      <label for="input">Input</label>
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-floating">
                      <input type="text" class="form-control" id="qty" name="qty[]" placeholder="10" aria-label="DE96"
                        aria-describedby="qtyHelp">
                      <label for="qty">Quantity</label>
                    </div>
                  </div>
                  <div class="col-1 d-flex justify-content-center mx-1">
                    {{-- <span class="input-group-text btn btn-outline-danger" onclick="removeTypeQty(this)">
                      <i class="fa-solid fa-trash"></i>
                    </span> --}}
                  </div>
                  <div id="typeHelp" class="form-text mx-4" onclick="addTypeQty()">Add More</div>
                </div>
              </div>
              <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 mt-3">Submit</button>
                <button type="reset" class="btn btn-label-secondary btn-reset mt-3" data-bs-dismiss="modal"
                  aria-label="Close">Cancel</button>
                <input type="hidden">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script>
      function addTypeQty() {
        const div = document.createElement('div');
        div.innerHTML = `
                                  <div class="row g-1" id="dynamicTypeQty">
                                    <div class="col">
                                      <div class="form-floating">
                                        <input type="text" class="form-control" id="type" name="type[]" placeholder="DE96" aria-label="DE96" aria-describedby="typeHelp">
                                        <label for="type">Type</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-floating">
                                        <input type="text" class="form-control" id="scale" name="scale[]" placeholder="10" aria-label="DE96" aria-describedby="scaleHelp">
                                        <label for="scale">Scale</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-floating">
                                        <input type="text" class="form-control" id="input" name="input[]" placeholder="10" aria-label="DE96" aria-describedby="inputHelp">
                                        <label for="input">Input</label>
                                      </div>
                                    </div>
                                    <div class="col">
                                      <div class="form-floating">
                                        <input type="text" class="form-control" id="qty" name="qty[]" placeholder="10" aria-label="DE96" aria-describedby="qtyHelp">
                                        <label for="qty">Quantity</label>
                                      </div>
                                    </div>
                                    <div class="col-1 d-flex justify-content-center mx-1">
                                      <span class="input-group-text btn btn-outline-danger" onclick="removeTypeQty(this)">
                                        <i class="fa-solid fa-trash"></i>
                                      </span>
                                    </div>
                                    <div id="typeHelp" class="form-text mx-4" onclick="addTypeQty()">Add More</div>
                                  </div>
                                `;
        document.getElementById('dynamicTypeQty').appendChild(div);
      }

      function removeTypeQty(btn) {
        // btn.parent.parentNode.remove();
        btn.closest('.row').remove();
      }
    </script>
  </div>

  <div class="card card-datatable table-responsive mt-3">
    <table class="table table-bordered" id="label-table" data-page-length='7'>
      <thead>
        <tr>
          <th>SN</th>
          <th>Brand</th>
          <th>Customer</th>
          <th>PO</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
    </table>
  </div>

  <script type="text/javascript">
    $(document).ready(function () {
      // Destroy existing DataTable before re-initializing
      if ($.fn.DataTable.isDataTable('#label-table')) {
        $('#label-table').DataTable().destroy();
      }

      // Initialize DataTable
      $('#label-table').DataTable({
        serverSide: true,
        ajax: '{{ route(name: 'Quickpin_Label.data') }}',
        columns: [
          { data: 'id_label', name: 'id_label' },
          { data: 'brand', name: 'brand' },
          { data: 'customer', name: 'customer' },
          { data: 'PO', name: 'PO' },
          { data: 'created_at', name: 'created_at' },
          { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[4, 'desc']] // Order by the created_at column (index 4) in descending order
      });
    });
  </script>

</div>
</div>
</div>
</div>
</div>
@endsection