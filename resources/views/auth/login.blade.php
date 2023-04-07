@extends('auth.layout.app')
@section('content')
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Welcome Back!</h2>
        <div class="input-group">
            {{-- <label for="txtUserName">User Name</label> --}}
            <input type="text" class="form-control input" name="email" value="{{ old('email') }}" required
                autocomplete="email" autofocus placeholder="Enter Your Email" />
        </div>
        <div class="input-group">
            {{-- <label for="txtPassword">Password</label> --}}
            <input type="password" id="txtPassword" class="form-control input"name="password" required
                autocomplete="current-password" placeholder="Enter Your Password" />
            <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
        </div>
        <div class="input-group">
            <label for="txtUserName"> <input type="checkbox" name="check" /> I accept the <a href="">Terms</a> of
                Use & <a href="">Privacy Policy</a></label>

        </div>
        <button type="submit" class="btn btn-lg btn-primary  m-0 btn-block w-100">Login</button>
        @if (Route::has('password.request'))
            <a class="btn btn-lg btn-secondary btn-block w-100" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
        @endif
        <div class="mt-3 text-center">
            <p class="mb-0">Don't have an account yet? <a href="{{ route('register') }}">Sign Up</a></p>
            <ul class="d-flex ">
                <li><a href=""></a></li>
            </ul>
        </div>
    </form>
@endsection
