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
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
    <main>
        <div class="container">
            @yield('content')
        </div>
    </main>
    {{-- <script>
        let passwordInput = document.getElementById('txtPassword2'),
            toggle2 = document.getElementById('btnToggle2'),
            icon2 = document.getElementById('eyeIcon2');

        function togglePassword() {
            if (passwordInput2.type === 'password') {
                passwordInput2.type = 'text';
                icon2.classList.add("fa-eye-slash");
                toggle.innerHTML = 'hide';
            } else {
                passwordInput2.type = 'password';
                icon2.classList.remove("fa-eye-slash");
                toggle2.innerHTML = 'show';
            }
        }

        function checkInput2() {
            if (passwordInput2.value === '') {
                toggle2.style.display = 'none';
                toggle2.innerHTML = 'show';
                passwordInput2.type = 'password';
            } else {
                toggle2.style.display = 'block';
            }
        }

        toggle2.addEventListener('click', togglePassword2, false);
        passwordInput2.addEventListener('keyup', checkInput2, false);
    </script> --}}
    <script>
        let passwordInput = document.getElementById('txtPassword'),
            toggle = document.getElementById('btnToggle'),
            icon = document.getElementById('eyeIcon');

        function togglePassword() {
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.add("fa-eye-slash");
                // toggle.innerHTML = 'hide';
            } else {
                passwordInput.type = 'password';
                icon.classList.remove("fa-eye-slash");
                // toggle.innerHTML = 'show';
            }
        }

        function checkInput() {
            if (passwordInput.value === '') {
                toggle.style.display = 'none';
                toggle.innerHTML = 'show';
                passwordInput.type = 'password';
            } else {
                toggle.style.display = 'block';
            }
        }

        toggle.addEventListener('click', togglePassword, false);
        passwordInput.addEventListener('keyup', checkInput, false);
    </script>
    <script src="{{ asset('assets') }}/js/core/libs.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    {!! Toastr::message() !!}
    <script>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>

</html>
