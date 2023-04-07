@extends('admin.layouts.app')
@section('content')
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <div class="d-flex flex-column">
                <h3>Affiliates</h3>
                <nav aria-label="breadcrumb" class="d-flex justify-content-between pb-3">
                    <ol class="breadcrumb -0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="breadcrumb-link">Dashboard</a></li>

                        <li aria-current="page" class="breadcrumb-item active text-capitalize">
                            Affiliate
                        </li>
                    </ol>
                    <div>
                        <!---->
                    </div>
                </nav>
            </div>
            <a href="{{ route('admin.affiliate.create') }}" class="btn btn-info">Create</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Affiliates</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fancy-table table-responsive rounded">
                            <table class="table table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Manager Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Country</th>
                                        <th scope="col">Skype</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function() {
            $(document).ready(function() {
                // let params = "{{ Request::get('user_type') }}"
                let url = "{{ route('admin.offer.index') }}";
                // if (params != '') {
                //     url += "?user_type=" + params;
                // }
                var table = $('.dt-table').DataTable({
                    lengthChange: false,
                    processing: true,
                    // dom: 'Bfrtip',
                    serverSide: true,
                    // bFilter: false,
                    sScrollX: "100%",
                    // sScrollXInner: "110%",
                    ajax: url,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'Name'
                        },
                        {
                            data: 'email',
                            name: 'Email'
                        },
                        {
                            data: 'manger_id',
                            name: 'Manger'
                        },
                        {
                            data: 'status',
                            name: 'Stutas'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: true,
                            searchable: true
                        },
                    ],
                });
                // table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
                // $(".dataTables_length select").addClass('form-select form-select-sm');
            });
        });
    </script>
@endsection
