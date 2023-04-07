@extends('admin.layouts.app')
@section('style')
    <!-- Quill Editor css -->
    <link rel="stylesheet" href="{{ asset('assets') }}/vendor/quill/quill.snow.css">
@endsection
@section('content')
    <div class="content-inner container-fluid pb-0" id="page_layout">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4 gap-3">
            <div class="d-flex flex-column">
                <h3>Offer</h3>
                <nav aria-label="breadcrumb" class="d-flex justify-content-between pb-3">
                    <ol class="breadcrumb -0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"
                                class="breadcrumb-link">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.offer.index') }}"
                                class="breadcrumb-link">Offers</a></li>
                        <!---->
                        <li aria-current="page" class="breadcrumb-item active text-capitalize">
                            Create
                        </li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.offer.index') }}" class="btn btn-info">Go Back</a>
        </div>
        <div class="row">
            <div class="col-lg-10 m-auto">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="header-title">
                            <h4 class="card-title">Create New Offer</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.offer.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Advertise</label>
                                        <select class="form-select mb-3 shadow-none" name="advertiser_id">
                                            <option selected="">Select a Advertiser</option>
                                            @foreach ($advertisers as $advertiser)
                                                <option value="{{ $advertiser->id }}">{{ $advertiser->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Category</label>
                                        <select class="form-select mb-3 shadow-none" name="category_id">
                                            <option selected="">Select a Category</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email1101">name</label>
                                        <input type="text" name="name" class="form-control" id="email1101">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email1101">Preview Url</label>
                                        <input type="text" name="preview" class="form-control" id="email1101">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email1101">Traking Url With Tokent</label>
                                        <input type="text" name="url" class="form-control" id="email1101">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email1101">Revenue</label>
                                        <input type="text" name="revenue" class="form-control" id="email1101">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email1101">Payout</label>
                                        <input type="text" name="payout" class="form-control" id="email1101">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email1101">Daily Cap</label>
                                        <input type="text" name="daily_cap" class="form-control" id="email1101">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label" for="email1101">Expiration</label>
                                        <input type="date" name="expiration_date" class="form-control" id="email1101">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Type</label>
                                        <select class="form-select mb-3 shadow-none" name="type">
                                            <option selected="">Select a Type</option>
                                            <option value="offer">Offer</option>
                                            <option value="smartlink">Smart Link</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Conversion Status</label>
                                        <select class="form-select mb-3 shadow-none" name="conversion_status">
                                            <option selected="">Select a Type</option>
                                            <option value="1">Auto Approved</option>
                                            <option value="0">Pending</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Offer Status</label>
                                        <select class="form-select mb-3 shadow-none" name="status">
                                            <option selected="">Select a Type</option>
                                            <option value="Active">Active</option>
                                            <option value="Pending">Pending</option>
                                            <option value="RequestApproved">Request Approved</option>

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <select class="select2-placeholder select2-option-creation form-control"
                                            multiple="multiple" name="country_id[]">
                                            <option value="">Select a country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label class="form-label">Alt Offer</label>
                                        <select class="form-select mb-3 shadow-none" name="alt_offer_id">
                                            <option value="">Select a Offer</option>
                                            @foreach ($alt_offers as $Offer)
                                                <option value="{{ $Offer->id }}">
                                                    {{ $Offer->first_name . $Offer->last_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="customFile" class="form-label custom-file-input">Avatar</label>
                                        <input class="form-control" type="file" id="customFile" name="photo">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-label" for="exampleFormControlTextarea1">Description</label>
                                        <textarea class="form-control" id="editor" rows="5" name="description"></textarea>
                                    </div>
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.offer.index') }}" class="btn btn-danger">cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <!-- Quill Editor Script -->
    <script src="{{ asset('assets') }}/vendor/quill/quill.min.js"></script>
    <script src="{{ asset('assets') }}/js/plugins/quill.js" defer></script>
@endsection
