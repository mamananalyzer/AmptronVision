@extends('base.1layout')

@section('title', 'Monitoring')

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
    <div class="row mb-4 g-6 justify-content-center">
        <div class="col-md-7 order-3 order-lg-4 mb-4 mb-lg-0">
            <div class="card text-center">
                <div class="card-header py-3">
                    <ul class="nav nav-pills" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-F" aria-controls="navs-pills-F" aria-selected="true">Freq</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-U1" aria-controls="navs-pills-U1" aria-selected="false" tabindex="-1">V1</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-U2" aria-controls="navs-pills-U2" aria-selected="false" tabindex="-1">V2</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-U3" aria-controls="navs-pills-U3" aria-selected="false" tabindex="-1">V3</button>
                    </li>
                    </ul>
                </div>
                <div class="tab-content pt-0">
                    <div class="tab-pane fade active show" id="navs-pills-F" role="tabpanel">
                        <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                            <div id="F" style="width: 939px; height: 444px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-U1" role="tabpanel">
                        <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                            <div id="U1" style="width: 939px; height: 444px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-U2" role="tabpanel">
                        <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                            <div id="U2" style="width: 939px; height: 444px;"></div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="navs-pills-U3" role="tabpanel">
                        <div class="col-lg-12 col-md-12 d-flex justify-content-center">
                            <div id="U3" style="width: 939px; height: 444px;"></div>
                        </div>
                    </div>
                </div>
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
        renderChart('Freq', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz');
        renderChart('U1', 'U1 Over Time', 'Voltage (V)', 'U1', 'V');
        renderChart('U2', 'U2 Over Time', 'Voltage (V)', 'U2', 'V');
        renderChart('U3', 'U3 Over Time', 'Voltage (V)', 'U3', 'V');
        renderChart('U12', 'U12 Over Time', 'Voltage (V)', 'U12', 'V');
        renderChart('U23', 'U23 Over Time', 'Voltage (V)', 'U23', 'V');
        renderChart('U31', 'U31 Over Time', 'Voltage (V)', 'U31', 'V');
    </script>


    <div class="row mb-12 g-6">
        <div class="col-lg-3 col-md-6">
            <div id="F" style="width: 450px; height: 200px;"></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div id="U1" style="width: 450px; height: 200px;"></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div id="U2" style="width: 450px; height: 200px;"></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div id="U3" style="width: 450px; height: 200px;"></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div id="U12" style="width: 450px; height: 200px;"></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div id="U23" style="width: 450px; height: 200px;"></div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div id="U31" style="width: 450px; height: 200px;"></div>
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
            renderChart('F', 'Frequency Over Time', 'Frequency (Hz)', 'F', 'Hz');
            renderChart('U1', 'U1 Over Time', 'Voltage (V)', 'U1', 'V');
            renderChart('U2', 'U2 Over Time', 'Voltage (V)', 'U2', 'V');
            renderChart('U3', 'U3 Over Time', 'Voltage (V)', 'U3', 'V');
            renderChart('U12', 'U12 Over Time', 'Voltage (V)', 'U12', 'V');
            renderChart('U23', 'U23 Over Time', 'Voltage (V)', 'U23', 'V');
            renderChart('U31', 'U31 Over Time', 'Voltage (V)', 'U31', 'V');
        </script>
    </div>
</div>
@endsection
