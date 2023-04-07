@extends('admin.layouts.app')
@section('content')
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <div class="d-flex flex-column">
                <h3>Categorys</h3>
                <nav aria-label="breadcrumb" class="d-flex justify-content-between pb-3">
                    <ol class="breadcrumb -0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="breadcrumb-link">Dashboard</a></li>

                        <li aria-current="page" class="breadcrumb-item active text-capitalize">
                            Category
                        </li>
                    </ol>
                    <div>
                        <!---->
                    </div>
                </nav>
            </div>
            <a href="{{ route('admin.category.create') }}" class="btn btn-info">Create</a>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Create New Category</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="fancy-table table-responsive rounded ">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">SL</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
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
                let url = "{{ route('admin.category.index') }}";
                // if (params != '') {
                //     url += "?user_type=" + params;
                // }
                var table = $('.dt-table').DataTable({
                    lengthChange: false,
                    processing: true,
                    dom: 'Bfrtip',
                    serverSide: true,
                    ajax: url,
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        }
                    ],
                });
                table.buttons().container().appendTo('#datatable-buttons_wrapper .col-md-12:eq(0)');
                $(".dataTables_length select").addClass('form-select form-select-sm');
            });
        });
    </script>
@endsection
