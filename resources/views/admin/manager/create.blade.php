@extends('admin.layouts.app')
@section('content')
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <div class="d-flex flex-column">
                <h3>Manager</h3>
                <nav aria-label="breadcrumb" class="d-flex justify-content-between pb-3">
                    <ol class="breadcrumb -0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.manager.index') }}"
                                class="breadcrumb-link">Manager</a></li>
                        <!---->
                        <li aria-current="page" class="breadcrumb-item active text-capitalize">
                            Create
                        </li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.manager.index') }}" class="btn btn-info">Go Back</a>
        </div>
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Create New Manager</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.manager.store') }}">
                            @csrf
                            <div class="form-group">
                                <label class="form-label" for="email1101">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="email1101">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email1101">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="email1101">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email1101">Email</label>
                                <input type="email" name="email" class="form-control" id="email1101">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email1101">Skype</label>
                                <input type="text" name="skype" class="form-control" id="email1101">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email1101">Balance</label>
                                <input type="number" name="balance" class="form-control" id="email1101">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <select class="form-select mb-3 shadow-none" name="country">
                                    <option selected="">Select a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pwd">Password</label>
                                <input type="password" class="form-control" name="password" id="pwd">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pwd">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="pwd">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Status</label>
                                <select class="form-select mb-3 shadow-none" name="status">
                                    <option selected="">Select a status</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Pending">Pending</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.manager.index') }}" class="btn btn-danger">cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
