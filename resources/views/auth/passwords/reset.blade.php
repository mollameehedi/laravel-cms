@extends('auth.layout.app')
@section('content')
    <form method="POST" action="{{ route('password.update') }}" class="p-0 ">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="card">
            <div class="card-header p-3">
                <h3>{{ __('Reset Password') }}</h3>
            </div>

            <div class="card-body p-3">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="input-group">
                    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                        value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus
                        placeholder="Enter Your Email" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group">
                    <input type="password" id="txtPassword"
                        class="form-control input  @error('password') is-invalid @enderror" name="password" required
                        autocomplete="new-password" placeholder="Enter Your Password" />
                    <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon" class="fa fa-eye"></i></button>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="input-group">
                    <input type="password" id="txtPassword2" class="form-control input" name="password_confirmation"
                        required autocomplete="new-password" placeholder="Enter Your Confirm Password" />
                    <button type="button" id="btnToggle2" class="toggle"><i id="eyeIcon2" class="fa fa-eye"></i></button>
                </div>
                <button type="submit" class="btn btn-lg btn-primary  m-0 btn-block w-100">Send Password Reset Link</button>
            </div>
        </div>
        </div>
    </form>
@endsection
