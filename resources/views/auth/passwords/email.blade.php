@extends('auth.layout.app')
@section('content')
    <form method="POST" action="{{ route('password.email') }}" class="p-0 ">
        @csrf
        <div class="card">
            <div class="card-header p-3">
                <h3>{{ __('Reset My Password') }}</h3>
            </div>

            <div class="card-body p-3">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="input-group">
                    <input type="text" class="form-control input @error('email') is-invalid @enderror" name="email"
                        value="{{ old('email') }}" required autocomplete="email" autofocus
                        placeholder="Enter Your Email" />
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-lg btn-primary  m-0 btn-block w-100">Send Password Reset Link</button>
            </div>
        </div>
        </div>
    </form>
@endsection
