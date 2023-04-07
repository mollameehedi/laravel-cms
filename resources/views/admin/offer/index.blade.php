@extends('admin.layouts.app')

@section('content')
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <div class="d-flex flex-column">
                <h3>Offer</h3>
                <nav aria-label="breadcrumb" class="d-flex justify-content-between pb-3">
                    <ol class="breadcrumb -0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="breadcrumb-link">Dashboard</a></li>

                        <li aria-current="page" class="breadcrumb-item active text-capitalize">
                            Offer
                        </li>
                    </ol>
                    <div>
                        <!---->
                    </div>
                </nav>
            </div>
            <a href="{{ route('admin.offer.create') }}" class="btn btn-info">Create</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">All Offers</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fancy-table table-responsive rounded">
                            <table class="table table-striped dt-table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Advertiser</th>
                                        <th scope="col">Preview Url</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Revenue</th>
                                        <th scope="col">Payout</th>
                                        <th scope="col">Conversion</th>
                                        <th scope="col">Alt Offer</th>
                                        <th scope="col">Daily Cap</th>
                                        <th scope="col">Expire Date</th>
                                        <th scope="col">Status</th>
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
                            data: 'photo',
                            name: 'name'
                        },
                        {
                            data: 'category_id',
                            name: 'Category'
                        },
                        {
                            data: 'advertiser_id',
                            name: 'Advertiser'
                        },
                        {
                            data: 'preview',
                            name: 'Preview Url'
                        },
                        {
                            data: 'type',
                            name: 'Type'
                        },
                        {
                            data: 'revenue',
                            name: 'Revenue'
                        },
                        {
                            data: 'payout',
                            name: 'Payout'
                        },
                        {
                            data: 'conversion_status',
                            name: 'Conversion Status'
                        },
                        {
                            data: 'alt_offer_id',
                            name: 'Offer'
                        },
                        {
                            data: 'daily_cap',
                            name: 'Daily Cap'
                        },
                        {
                            data: 'expiration_date',
                            name: 'expiration_date'
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
