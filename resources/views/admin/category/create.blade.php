@extends('admin.layouts.app')
@section('content')
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <div class="d-flex flex-column">
                <h3>Category</h3>
                <nav aria-label="breadcrumb" class="d-flex justify-content-between pb-3">
                    <ol class="breadcrumb -0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.category.index') }}"
                                class="breadcrumb-link">Category</a></li>
                        <!---->
                        <li aria-current="page" class="breadcrumb-item active text-capitalize">
                            Create
                        </li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.category.index') }}" class="btn btn-info">Go Back</a>
        </div>
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Create New Category</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.category.store') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="email1101">Name</label>
                                <input type="text" name="name" class="form-control" id="email1101">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.category.index') }}" class="btn btn-danger">cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
