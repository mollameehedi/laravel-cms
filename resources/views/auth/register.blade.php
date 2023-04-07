@extends('auth.layout.app')
@section('content')
    <form method="POST" action="{{ route('register') }}" class="register">
        @csrf
        <h2>Welcome Back!</h2>
        <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control input" name="first_name" value="{{ old('first_name') }}" required
                        autocomplete="first_name" autofocus placeholder="Enter  your first name" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control input" name="last_name" value="{{ old('last_name') }}"
                        required autocomplete="last_name" autofocus placeholder="Enter  your last name" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="email" class="form-control input" name="email" value="{{ old('email') }}" required
                        autocomplete="email" autofocus placeholder="Enter  your email" />
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="text" class="form-control input" name="skype" value="{{ old('skype') }}" required
                        autocomplete="skype" autofocus placeholder="Enter your skype" />
                </div>
            </div>
            <div class="col-lg-6">
                @php
                    $coutnries = App\Models\Country::all();
                @endphp
                <div class="input-group">
                    <select name="country" id="" class="form-select">
                        <option value="">Select your country</option>
                        @foreach ($coutnries as $country)
                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <select name="role" id="" class="form-select">
                        <option value="">Select user type</option>
                        <option value="Manager">Manager</option>
                        <option value="Affiliate">Affiliate</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="password" id="txtPassword" class="form-control input"name="password" required
                        autocomplete="current-password" placeholder="Enter Your Password" />
                    <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="input-group">
                    <input type="password" id="txtPassword2" class="form-control input"name="password_confirmation" required
                        autocomplete="current-password" placeholder="Enter Your Confirm Password" />
                    <button type="button" id="btnToggle2" class="toggle"><i id="eyeIcon2" class="fa fa-eye"></i></button>
                </div>
            </div>
        </div>








        <div class="input-group">
            <label for="txtUserName"> <input type="checkbox" name="check" /> I accept the <a href="">Terms</a> of
                Use & <a href="">Privacy Policy</a></label>

        </div>
        <button type="submit" class="btn btn-lg btn-primary  m-0 btn-block w-100">Register</button>
        @if (Route::has('password.request'))
            <a class="btn btn-lg btn-secondary btn-block w-100" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        <div class="mt-3 text-center">
            <p class="mb-0">I already have an account <a href="{{ route('login') }}">Sign In</a></p>
            <ul class="d-flex ">
                <li><a href=""></a></li>
            </ul>
        </div>
    </form>
@endsection
