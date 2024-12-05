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

<style>
  /* Styling for the period buttons inside the calendar */
  .flatpickr-calendar .period-buttons {
    display: flex;
    justify-content: space-between;
    gap: 5px;
    margin: 10px;
  }

  .flatpickr-calendar .period-buttons button {
    padding: 5px 10px;
    cursor: pointer;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 5px;
    transition: background-color 0.2s;
  }

  .flatpickr-calendar .period-buttons button:hover {
    background-color: #0056b3;
  }

  #chartContainer>div {
    margin-top: 20px;
  }
</style>

@section('content')
<div class="flex-grow-1 container-p-y container-fluid">
  <div class="row mb-12 g-6">
    <div class="col-md-6 col-lg-6">
      <div style="margin-bottom: 20px" id="calendar-container">
        <span id="calendar-label">Select a Date : </span>
        <input type="text" id="datePicker" />
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

        <!--<script type="text/javascript">
          async function fetchData() {
            try {
              const response = await fetch('http://127.0.0.1:8000/api/v1/metering');
              return await response.json();
            } catch (error) {
              console.error('Error fetching data:', error);
              return [];
            }
          }

          function renderChart(containerId, titleText, yAxisName, dataKey, unit, selectedDate, chartInstances) {
            const dom = document.getElementById(containerId);
            if (!chartInstances[containerId]) {
              chartInstances[containerId] = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
              });
            }
            const myChart = chartInstances[containerId];

            fetchData()
              .then(data => {
                // Filter data berdasarkan tanggal yang dipilih
                const filteredData = data.filter(item => {
                  const itemDate = new Date(item.updated_at).toISOString().split('T')[0];
                  return itemDate === selectedDate;
                });

                // Format data untuk ECharts
                const chartData = filteredData.map(item => ({
                  name: item.updated_at,
                  value: [item.updated_at, item[dataKey]]
                }));

                // Hitung batas minimum dan maksimum Y-axis
                const values = chartData.map(item => item.value[1]).filter(val => val !== null);
                const minVal = values.length > 0 ? Math.min(...values) : 0;
                const maxVal = values.length > 0 ? Math.max(...values) : 10;
                const rangePadding = (maxVal - minVal) * 0.1;
                const yAxisMin = minVal - rangePadding;
                const yAxisMax = maxVal + rangePadding;

                // Konfigurasi ECharts
                const option = {
                  title: { text: titleText },
                  tooltip: {
                    trigger: 'axis',
                    formatter: function (params) {
                      params = params[0];
                      const date = new Date(params.name);
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

                // Tampilkan data pada grafik
                myChart.setOption(option);
              })
              .catch(error => console.error('Error rendering chart:', error));
          }

          async function initializeFlatpickrAndCharts() {
            const data = await fetchData();

            // Mendapatkan tanggal hari ini dalam format "YYYY-MM-DD"
            const todayDate = new Date().toISOString().split('T')[0];

            // Jika data tersedia, gunakan tanggal terbaru dari data, jika tidak gunakan hari ini
            const latestDate = data.length > 0
              ? new Date(data[data.length - 1].updated_at).toISOString().split('T')[0]
              : todayDate;

            // Initialize Flatpickr dengan tanggal default
            flatpickr('#datePicker', {
              defaultDate: latestDate, // Set default date ke tanggal terbaru atau hari ini
              dateFormat: 'Y-m-d', // Format untuk mencocokkan API
              onChange: (selectedDates, dateStr) => {
                syncCharts(dateStr); // Perbarui grafik saat tanggal berubah
              }
            });

            // Render grafik dengan tanggal default
            syncCharts(latestDate);
          }

          function syncCharts(selectedDate) {
            const chartInstances = {};
            renderChart('containerF', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz', selectedDate, chartInstances);
            renderChart('containerV1', 'Voltage 1 Over Time', 'Voltage (V)', 'U1', 'V', selectedDate, chartInstances);
            renderChart('containerV2', 'Voltage 2 Over Time', 'Voltage (V)', 'U2', 'V', selectedDate, chartInstances);
            renderChart('containerV3', 'Voltage 3 Over Time', 'Voltage (V)', 'U3', 'V', selectedDate, chartInstances);
            renderChart('containerVAvg', 'Average Voltage Over Time', 'Voltage (V)', 'Uavg', 'V', selectedDate, chartInstances);
          }

          // Initialize everything
          initializeFlatpickrAndCharts();

        </script>-->

        <!-- <script type="text/javascript">
          let latestData = {}; // Menyimpan data terakhir per grafik agar bisa membandingkan perubahan

          async function fetchData() {
            try {
              const response = await fetch('http://127.0.0.1:8000/api/v1/metering');
              return await response.json();
            } catch (error) {
              console.error('Error fetching data:', error);
              return [];
            }
          }

          function renderChart(containerId, titleText, yAxisName, dataKey, unit, selectedDate, chartInstances) {
            const dom = document.getElementById(containerId);
            if (!chartInstances[containerId]) {
              chartInstances[containerId] = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
              });
            }
            const myChart = chartInstances[containerId];

            fetchData()
              .then(data => {
                // Filter data berdasarkan tanggal yang dipilih
                const filteredData = data.filter(item => {
                  const itemDate = new Date(item.updated_at).toISOString().split('T')[0];
                  return itemDate === selectedDate;
                });

                // Format data untuk ECharts
                const chartData = filteredData.map(item => ({
                  name: item.updated_at,
                  value: [item.updated_at, item[dataKey]]
                }));

                // Cek jika ada perubahan data untuk refresh grafik
                if (JSON.stringify(latestData[containerId]) !== JSON.stringify(chartData)) {
                  latestData[containerId] = chartData; // Simpan data terbaru

                  // Hitung batas minimum dan maksimum Y-axis
                  const values = chartData.map(item => item.value[1]).filter(val => val !== null);
                  const minVal = values.length > 0 ? Math.min(...values) : 0;
                  const maxVal = values.length > 0 ? Math.max(...values) : 10;
                  const rangePadding = (maxVal - minVal) * 0.1;
                  const yAxisMin = minVal - rangePadding;
                  const yAxisMax = maxVal + rangePadding;

                  // Konfigurasi ECharts
                  const option = {
                    title: { text: titleText },
                    tooltip: {
                      trigger: 'axis',
                      formatter: function (params) {
                        params = params[0];
                        const date = new Date(params.name);
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

                  // Update grafik dengan data baru
                  myChart.setOption(option);
                }
              })
              .catch(error => console.error('Error rendering chart:', error));
          }

          async function initializeFlatpickrAndCharts() {
            const data = await fetchData();

            // Mendapatkan tanggal hari ini dalam format "YYYY-MM-DD"
            const todayDate = new Date().toISOString().split('T')[0];

            // Jika data tersedia, gunakan tanggal terbaru dari data, jika tidak gunakan hari ini
            const latestDate = data.length > 0
              ? new Date(data[data.length - 1].updated_at).toISOString().split('T')[0]
              : todayDate;

            // Initialize Flatpickr dengan tanggal default
            flatpickr('#datePicker', {
              defaultDate: latestDate, // Set default date ke tanggal terbaru atau hari ini
              dateFormat: 'Y-m-d', // Format untuk mencocokkan API
              onChange: (selectedDates, dateStr) => {
                syncCharts(dateStr); // Perbarui grafik saat tanggal berubah
              }
            });

            // Render grafik dengan tanggal default
            syncCharts(latestDate);

            // Cek setiap 5 detik untuk perubahan data dan refresh grafik jika ada update
            setInterval(() => {
              const selectedDate = document.querySelector('#datePicker').value;
              syncCharts(selectedDate); // Refresh grafik setiap interval
            }, 5000);
          }

          function syncCharts(selectedDate) {
            const chartInstances = {};
            renderChart('containerF', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz', selectedDate, chartInstances);
            renderChart('containerV1', 'Voltage 1 Over Time', 'Voltage (V)', 'U1', 'V', selectedDate, chartInstances);
            renderChart('containerV2', 'Voltage 2 Over Time', 'Voltage (V)', 'U2', 'V', selectedDate, chartInstances);
            renderChart('containerV3', 'Voltage 3 Over Time', 'Voltage (V)', 'U3', 'V', selectedDate, chartInstances);
            renderChart('containerVAvg', 'Average Voltage Over Time', 'Voltage (V)', 'Uavg', 'V', selectedDate, chartInstances);
          }

          // Initialize everything
          initializeFlatpickrAndCharts();

        </script>-->


        <script>
          let selectedPeriod = 'today'; // Default ke hari ini
          const latestData = {};
          const chartInstances = {};

          async function fetchData() {
            try {
              const response = await fetch('http://127.0.0.1:8000/api/v1/metering');
              return await response.json();
            } catch (error) {
              console.error('Error fetching data:', error);
              return [];
            }
          }

          function renderChart(containerId, titleText, yAxisName, dataKey, unit, startDate, endDate) {
            const dom = document.getElementById(containerId);
            if (!chartInstances[containerId]) {
              chartInstances[containerId] = echarts.init(dom, null, {
                renderer: 'canvas',
                useDirtyRect: false
              });
            }
            const myChart = chartInstances[containerId];

            fetchData()
              .then(data => {
                const filteredData = data.filter(item => {
                  const itemTime = new Date(item.updated_at).getTime();
                  return itemTime >= startDate && itemTime <= endDate;
                });

                const chartData = filteredData.map(item => ({
                  name: item.updated_at,
                  value: [item.updated_at, item[dataKey]]
                }));

                if (JSON.stringify(latestData[containerId]) !== JSON.stringify(chartData)) {
                  latestData[containerId] = chartData;

                  const values = chartData.map(item => item.value[1]).filter(val => val !== null);
                  const minVal = values.length > 0 ? Math.min(...values) : 0;
                  const maxVal = values.length > 0 ? Math.max(...values) : 10;
                  const rangePadding = (maxVal - minVal) * 0.1;
                  const yAxisMin = minVal - rangePadding;
                  const yAxisMax = maxVal + rangePadding;

                  const option = {
                    title: { text: titleText },
                    tooltip: {
                      trigger: 'axis',
                      formatter: function (params) {
                        params = params[0];
                        const date = new Date(params.name);
                        return (
                          `${date.toLocaleString()} : ` +
                          (params.value[1] !== null ? params.value[1] + ' ' + unit : 'No Data')
                        );
                      }
                    },
                    xAxis: {
                      type: 'time',
                      min: startDate,
                      max: endDate
                    },
                    yAxis: {
                      type: 'value',
                      name: yAxisName,
                      min: yAxisMin,
                      max: yAxisMax
                    },
                    series: [
                      {
                        name: titleText,
                        type: 'line',
                        showSymbol: true,
                        data: chartData
                      }
                    ],
                    dataZoom: [
                      {
                        type: 'inside',  // Zoom menggunakan mouse scroll
                        start: 0,        // Persentase awal zoom
                        end: 100         // Persentase akhir zoom
                      },
                      {
                        type: 'slider', // Slider zoom di bawah grafik
                        start: 0,
                        end: 100,
                        bottom: '10%'   // Menempatkan slider sedikit lebih rendah
                      }
                    ],
                    toolbox: {
                      show: true,
                      orient: 'horizontal', // Menyusun toolbox secara vertikal
                      right: '10%',       // Menempatkan toolbox di sisi kanan
                      // top: 'center',      // Posisi toolbox di tengah vertikal
                      feature: {
                        dataZoom: {
                          show: true,
                          title: {
                            zoom: 'Zoom',
                            back: 'Reset Zoom'
                          }
                        },
                        restore: {
                          show: true,
                          title: 'Reset'
                        },
                        saveAsImage: {
                          show: true,
                          title: 'Simpan Gambar'
                        }
                      }
                    }
                  };

                  myChart.setOption(option);
                }
              })
              .catch(error => console.error('Error rendering chart:', error));
          }

          function initializeCharts(startDate, endDate) {
            renderChart('containerF', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz', startDate, endDate);
            renderChart('containerV1', 'Voltage 1 Over Time', 'Voltage (V)', 'U1', 'V', startDate, endDate);
            renderChart('containerV2', 'Voltage 2 Over Time', 'Voltage (V)', 'U2', 'V', startDate, endDate);
            renderChart('containerV3', 'Voltage 3 Over Time', 'Voltage (V)', 'U3', 'V', startDate, endDate);
            renderChart('containerVAvg', 'Average Voltage Over Time', 'Voltage (V)', 'Uavg', 'V', startDate, endDate);
          }

          function calculateDateRange(period, baseDate) {
            const endDate = baseDate.getTime();
            let startDate;

            switch (period) {
              case 'yesterday': // Kemarin
                startDate = new Date(baseDate.getFullYear(), baseDate.getMonth(), baseDate.getDate() - 1).getTime();
                break;
              case 'today': // Hari ini
                startDate = new Date(baseDate.getFullYear(), baseDate.getMonth(), baseDate.getDate()).getTime();
                break;
              case '3d': // 3 Hari terakhir
                startDate = endDate - 3 * 24 * 60 * 60 * 1000;
                break;
              case '1w': // 1 Minggu terakhir
                startDate = endDate - 7 * 24 * 60 * 60 * 1000;
                break;
              case '1m': // 1 Bulan terakhir
                startDate = new Date(baseDate.getFullYear(), baseDate.getMonth() - 1, baseDate.getDate()).getTime();
                break;
              default:
                startDate = endDate;
            }

            return { startDate, endDate };
          }

          async function initializeFlatpickrAndCharts() {
            const data = await fetchData();

            const todayDate = new Date();
            const { startDate, endDate } = calculateDateRange('today', todayDate); // Default ke hari ini
            initializeCharts(startDate, endDate);

            flatpickr('#datePicker', {
              defaultDate: new Date(), // Default date ke hari ini
              dateFormat: 'Y-m-d',
              onChange: (selectedDates, dateStr, instance) => {
                const baseDate = new Date(selectedDates[0] || new Date());
                // Ketika pengguna memilih tanggal di kalender, tampilkan data untuk tanggal tersebut
                const startDate = baseDate.getTime();
                const endDate = startDate + 24 * 60 * 60 * 1000 - 1; // Satu hari penuh
                initializeCharts(startDate, endDate); // Update grafik berdasarkan tanggal yang dipilih
              },
              onOpen: (selectedDates, dateStr, instance) => {
                const calendar = instance.calendarContainer;
                if (!calendar.querySelector('.period-buttons')) {
                  const periodButtons = document.createElement('div');
                  periodButtons.className = 'period-buttons';

                  const periods = [
                    { label: 'Kemarin', value: 'yesterday' },
                    { label: '3 Hari', value: '3d' },
                    { label: '1 Minggu', value: '1w' },
                    { label: '1 Bulan', value: '1m' }
                  ];

                  periods.forEach(period => {
                    const button = document.createElement('button');
                    button.textContent = period.label;
                    button.onclick = () => {
                      selectedPeriod = period.value;
                      const baseDate = new Date(instance.selectedDates[0] || new Date());
                      const { startDate, endDate } = calculateDateRange(selectedPeriod, baseDate);
                      initializeCharts(startDate, endDate); // Update grafik berdasarkan periode yang dipilih
                      instance.setDate([new Date(startDate), new Date(endDate)], true); // Update date range di kalender
                      instance.close();
                    };
                    periodButtons.appendChild(button);
                  });

                  calendar.appendChild(periodButtons);
                }
              }
            });
          }

          initializeFlatpickrAndCharts();
        </script>

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
    let lastFetchedEnergy = null; // Store previous total energy change percentage

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

          // Hanya lakukan perubahan jika data baru berbeda dari yang terakhir diperiksa
          if (lastFetchedEnergy === currentTotalEnergy) {
          }

          let TotEDifference = 0;
          if (previousTotalEnergy !== null) {
            TotEDifference = currentTotalEnergy - previousTotalEnergy;
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
          TotEChangeElement.textContent = `${TotEDifference.toFixed(2)} kWh`;

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
          lastFetchedEnergy = currentTotalEnergy;
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

  <div class="card-body">
    <div style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">
      <div id="frequency-gauge" style="width: 300px; height: 300px;"></div>
      <div id="voltage1-group" style="display: flex; align-items: center;">
        <div id="voltage1-gauge" style="width: 300px; height: 300px;"></div>
        <div id="average-voltage-gauge" style="width: 300px; height: 300px;"></div>
      </div>
      <div id="voltage2-gauge" style="width: 300px; height: 300px;"></div>
      <div id="voltage3-gauge" style="width: 300px; height: 300px;"></div>
      <div id="total-energy-gauge" style="width: 300px; height: 300px;"></div>
    </div>
  </div>

  <script>
    // Inisialisasi ECharts untuk masing-masing gauge
    const charts = {
      frequency: echarts.init(document.getElementById('frequency-gauge')),
      voltage1: echarts.init(document.getElementById('voltage1-gauge')),
      voltage2: echarts.init(document.getElementById('voltage2-gauge')),
      voltage3: echarts.init(document.getElementById('voltage3-gauge')),
      averageVoltage: echarts.init(document.getElementById('average-voltage-gauge')),
      totalEnergy: echarts.init(document.getElementById('total-energy-gauge')),
    };

    // Template untuk opsi gauge chart
    function createGaugeOption(title, min, max, value, unit) {
      return {
        title: {
          text: title,
          left: 'center',
          top: '3%',
          textStyle: {
            fontSize: 16,
            fontWeight: 'bold'
          }
        },
        tooltip: {
          formatter: `{b} : {c} ${unit}`
        },
        series: [
          {
            name: title,
            type: 'gauge',
            min: min,
            max: max,
            splitNumber: 5,
            progress: {
              show: true,
              width: 15
            },
            axisLine: {
              lineStyle: {
                width: 15,
                color: [
                  [0.3, '#FF4500'],
                  [0.7, '#FFD700'],
                  [1, '#32CD32']
                ]
              }
            },
            detail: {
              valueAnimation: true,
              formatter: `{value} ${unit}`,
              fontSize: 14
            },
            data: [{ value: value, name: title }]
          }
        ]
      };
    }

    // Fungsi untuk mengambil data dari API dan memperbarui semua gauge
    function fetchAndUpdateGauges() {
      const apiUrl = 'http://127.0.0.1:8000/api/v1/metering'; // URL API

      fetch(apiUrl)
        .then((response) => response.json())
        .then((data) => {
          console.log('API Response:', data); // Debug log

          // Pastikan data tidak kosong
          if (data.length === 0) {
            console.warn('No data received from API');
            return;
          }

          // Ambil data terakhir
          const lastData = data[data.length - 1];

          // Ambil nilai parameter
          const frequency = parseFloat(lastData.F); // Frekuensi
          const voltage1 = parseFloat(lastData.U1); // Voltase 1
          const voltage2 = parseFloat(lastData.U2); // Voltase 2
          const voltage3 = parseFloat(lastData.U3); // Voltase 3
          const averageVoltage = parseFloat(lastData.Uavg); // Rata-rata voltase
          const totalEnergy = parseFloat(lastData.Ep_sum); // Total energi

          // Perbarui masing-masing chart dengan data terbaru
          charts.frequency.setOption(createGaugeOption('Frequency', 45, 55, frequency, 'Hz'));
          charts.voltage1.setOption(createGaugeOption('Voltage 1', 0, 250, voltage1, 'V'));
          charts.voltage2.setOption(createGaugeOption('Voltage 2', 0, 250, voltage2, 'V'));
          charts.voltage3.setOption(createGaugeOption('Voltage 3', 0, 250, voltage3, 'V'));
          charts.averageVoltage.setOption(createGaugeOption('Avg Voltage', 0, 250, averageVoltage, 'V'));
          charts.totalEnergy.setOption(createGaugeOption('Total Energy', 0, 5000, totalEnergy, 'kWh'));
        })
        .catch((error) => {
          console.error('Error fetching gauge data:', error);
        });
    }

    // Panggilan pertama untuk mengambil data
    fetchAndUpdateGauges();

    // Perbarui data setiap 5 detik
    setInterval(fetchAndUpdateGauges, 5000);
  </script>


  <!--<script>
    // Inisialisasi chart menggunakan ECharts
    const chartDom = document.getElementById('frequency-gauge');
    const myChart = echarts.init(chartDom);

    // Opsi awal untuk gauge chart
    const option = {
      tooltip: {
        formatter: '{a} <br/>{b} : {c} Hz'
      },
      series: [
        {
          name: 'Frequency',
          type: 'gauge',
          min: 45, // Nilai minimum tetap
          max: 55, // Nilai maksimum tetap
          splitNumber: 5, // Jumlah pembagian (10 tick untuk 45-55)
          progress: {
            show: true,
            width: 10 // Lebar garis progress
          },
          axisLine: {
            lineStyle: {
              width: 10,
              color: [
                [0.4, '#FF4500'], // Warna merah untuk bagian bawah rentang
                [0.7, '#FFD700'], // Warna kuning untuk rentang menengah
                [1, '#32CD32'] // Warna hijau untuk rentang atas
              ]
            }
          },
          axisLabel: {
            formatter: '{value} Hz' // Menambahkan satuan pada label
          },
          detail: {
            valueAnimation: true,
            formatter: '{value} Hz', // Menampilkan satuan pada nilai
            fontSize: 16
          },
          data: [
            {
              value: 50, // Nilai awal frekuensi
              name: 'Frequency',
              fontSize: 16
            }
          ]
        }
      ]
    };

    // Terapkan opsi awal ke chart
    myChart.setOption(option);

    // Fungsi untuk mengambil data dan memperbarui chart
    function fetchAndDisplayFrequencyData() {
      const apiUrl = 'http://127.0.0.1:8000/api/v1/metering'; // URL API

      fetch(apiUrl)
        .then(response => response.json())
        .then(data => {
          console.log('API Response:', data); // Debug: Log the data

          // Pastikan data memiliki entri
          if (data.length === 0) {
            console.log('No data received from API');
            return;
          }

          // Ambil nilai frekuensi terakhir
          const lastFrequency = parseFloat(data[data.length - 1].F) || 45; // Default ke 45 jika gagal

          // Validasi nilai frekuensi dalam rentang 45-55
          if (lastFrequency < 45 || lastFrequency > 55) {
            console.warn('Frequency out of range:', lastFrequency);
            return;
          }

          // Perbarui nilai pada chart
          option.series[0].data[0].value = lastFrequency;
          myChart.setOption(option); // Terapkan pembaruan ke chart
        })
        .catch(error => {
          console.error('Error fetching frequency data:', error);
        });
    }

    // Panggilan pertama untuk mengambil data
    fetchAndDisplayFrequencyData();

    // Memanggil fungsi fetch setiap 5 detik untuk memperbarui data
    setInterval(fetchAndDisplayFrequencyData, 5000);
  </script>-->

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