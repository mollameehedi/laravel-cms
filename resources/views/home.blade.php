<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
    <main>
        <div class="container">
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
                    <button type="button" id="btnToggle" class="toggle"><i id="eyeIcon"
                            class="fa fa-eye"></i></button>
                </div>
                <div class="input-group">
                    <label for="txtUserName"> <input type="checkbox" name="check" /> I accept the <a
                            href="">Terms</a> of Use & <a href="">Privacy Policy</a></label>

                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block w-100">Login</button>
                @if (Route::has('password.request'))
                    <a class="btn btn-lg btn-secondary btn-block w-100" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
                <div class="mt-3 text-center">
                    <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
                </div>
            </form>
        </div>
    </main>
    <script>
        let passwordInput = document.getElementById('txtPassword'),
            toggle = document.getElementById('btnToggle'),
            icon = document.getElementById('eyeIcon');

        function togglePassword() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.add("fa-eye-slash");
                //toggle.innerHTML = 'hide';
            } else {
                passwordInput.type = 'password';
                icon.classList.remove("fa-eye-slash");
                //toggle.innerHTML = 'show';
            }
        }

        function checkInput() {
            //if (passwordInput.value === '') {
            //toggle.style.display = 'none';
            //toggle.innerHTML = 'show';
            //  passwordInput.type = 'password';
            //} else {
            //  toggle.style.display = 'block';
            //}
        }

        toggle.addEventListener('click', togglePassword, false);
        passwordInput.addEventListener('keyup', checkInput, false);
    </script>
</body>

</html>
