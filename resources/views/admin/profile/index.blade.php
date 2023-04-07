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
                                class="breadcrumb-link">Profile</a></li>
                        <!---->
                        <li aria-current="page" class="breadcrumb-item active text-capitalize">
                            My Profile
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
                            <h4 class="card-title">Profile Information</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label class="form-label" for="email1101">First Name</label>
                                <input type="text" name="first_name" class="form-control" id="email1101"
                                    value="{{ Auth::user()->first_name }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email1101">Last Name</label>
                                <input type="text" name="last_name" class="form-control" id="email1101"
                                    value="{{ Auth::user()->last_name }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email1101">Email</label>
                                <input type="email" name="email" class="form-control" id="email1101"
                                    value="{{ Auth::user()->email }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email1101">Skype</label>
                                <input type="text" name="skype" class="form-control" id="email1101"
                                    value="{{ Auth::user()->skype }}">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <select class="form-select mb-3 shadow-none" name="country">
                                    <option selected="">Select a country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" {{ Auth::user()->country }}
                                            {{ Auth::user()->country == $country->id ? 'selected' : '' }}>
                                            {{ $country->name }}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="customFile" class="form-label custom-file-input">Avatar</label>
                                <input class="form-control" type="file" onchange="readURL(this);" name="avatar">
                                <img id="blah" src="{{ Auth::user()->getFirstMediaUrl('avatar') }}" height="150"
                                    width="150" />
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">cancel</a>
                        </form>
                    </div>
                </div>
                <div class="card">
                    <form method="post" action="{{ route('admin.profile.password') }}">
                        @csrf
                        @method('put')
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Change Your Password</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="form-label" for="pwd">Old Password</label>
                                <input type="password" class="form-control" name="old_password" id="pwd">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pwd">New Password</label>
                                <input type="password" class="form-control" name="password" id="pwd">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="pwd">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="pwd">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger">cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@section('script')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
