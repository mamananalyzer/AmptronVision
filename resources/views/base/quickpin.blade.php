@extends('base.0layout')

@section('title', 'Quick Pin')

@section('link')
<script src="sneat/assets/vendor/libs/apex-charts/echarts.min.js"></script>
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
      <!--<h6 class="mt-2 text-muted">Data Real Time Monitoring</h6>-->
      <div class="card">
        <div class="card-header py-4">
          <ul class="nav nav-pills" role="tablist">
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab"
                data-bs-target="#navs-pills-F" aria-controls="navs-pills-F" aria-selected="true">Frequency</button>
            </li>
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-V1"
                aria-controls="navs-pills-V1" aria-selected="false" tabindex="-1">Voltage 1</button>
            </li>
            <li class="nav-item" role="presentation">
              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-V2"
                aria-controls="navs-pills-V2" aria-selected="false" tabindex="-1">Voltage 2</button>
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
        </div>

        <script type="text/javascript">
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

          // Render charts with dynamic y-axis range
          renderChart('containerF', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz');
          renderChart('containerV1', 'Voltage 1 Over Time', 'Voltage (V)', 'U1', 'V');
          renderChart('containerV2', 'Voltage 2 Over Time', 'Voltage (V)', 'U2', 'V');
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
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="sneat/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Voltage 1</span>
          <h3 id="v1-value" class="card-title mb-2">-- V</h3>
          <small id="v1-change" class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i>-- V</small>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Active Users</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">19,860</h4>
                <small class="text-danger">(-14%)</small>
              </div>
              <p class="mb-0">Last week analytics</p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-group bx-sm"></i>
              </span>
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
              <span>Active Users</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">19,860</h4>
                <small class="text-danger">(-14%)</small>
              </div>
              <p class="mb-0">Last week analytics</p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-success">
                <i class="bx bx-group bx-sm"></i>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-body">
          <div class="card-title d-flex align-items-start justify-content-between">
            <div class="avatar flex-shrink-0">
              <img src="sneat/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded" />
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
              </div>
            </div>
          </div>
          <span class="fw-semibold d-block mb-1">Voltage 2</span>
          <h3 class="card-title mb-2">180 V</h3>
          <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +30 V</small>
        </div>
      </div>
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Pending Users</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">237</h4>
                <small class="text-success">(+42%)</small>
              </div>
              <p class="mb-0">Last week analytics</p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-warning">
                <i class="bx bx-user-voice bx-sm"></i>
              </span>
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

          // Get HTML elements for displaying values
          const fValueElement = document.getElementById('f-value');
          const v1ValueElement = document.getElementById('v1-value');
          const fChangeElement = document.getElementById('f-change');
          const v1ChangeElement = document.getElementById('v1-change');

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

          // Update the DOM with the frequency and voltage values
          fValueElement.textContent = `${currentFrequency} Hz`;
          v1ValueElement.textContent = `${currentVoltage} V`;

          // Update the percentage change elements
          fChangeElement.textContent = `${frequencyChange.toFixed(2)}%`;
          v1ChangeElement.textContent = `${voltageChange.toFixed(2)}%`;

          // Store the current frequency, voltage, and changes as previous values for the next update
          previousFrequency = currentFrequency;
          previousVoltage = currentVoltage;
          previousFrequencyChange = frequencyChange;
          previousVoltageChange = voltageChange;
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