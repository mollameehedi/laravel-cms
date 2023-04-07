@extends('auth.layout.app')
@section('content')
    <form method="POST" action="{{ route('verification.resend') }}" class="p-0 ">
        @csrf
        <div class="card">
            <div class="card-header p-3">
                <h3>{{ __('Verify Your Email Address') }}</h3>
            </div>

            <div class="card-body p-3">
                @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        {{ __('A fresh verification link has been sent to your email address.') }}
                    </div>
                @endif

                <p>{{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, </p>


                <button type="submit"
                    class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>
                .

            </div>
        </div>
    </form>
@endsection
