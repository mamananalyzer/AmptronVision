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
              <div id="container" style="width: 535px; height: 335px; overflow: hidden;"></div>
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
    <div class="col-sm-6 col-xl-3">
      <div class="card">
        <div class="card-body">
          <div class="d-flex align-items-start justify-content-between">
            <div class="content-left">
              <span>Frequency</span>
              <div class="d-flex align-items-end mt-2">
                <h4 class="mb-0 me-2">4,567</h4>
                <small class="text-success">(+18%)</small>
              </div>
              <p class="mb-0">Last week analytics </p>
            </div>
            <div class="avatar">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="bx bx-user-check bx-sm"></i>
              </span>
            </div>
          </div>
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