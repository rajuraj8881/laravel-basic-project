<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Forgot Password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/dist/css/style.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script>
        function viewPassword()
        {
            var passwordInput = document.getElementById('password-field');
            var passStatus = document.getElementById('pass-status');

            if (passwordInput.type == 'password'){
                passwordInput.type='text';
                passStatus.className='fa fa-eye-slash';

            }
            else{
                passwordInput.type='password';
                passStatus.className='fa fa-eye';
            }
        }

        function myFunction() {
            var password = document.getElementById("password").value;
            var password_confirmation = document.getElementById("password_confirmation").value;
            if (password != password_confirmation) {
                //alert("Passwords Do not match");
                document.getElementById("password").style.borderColor = "#E34234";
                document.getElementById("password_confirmation").style.borderColor = "#E34234";
                return false;
            }
        }
    </script>
</head>
<body class="hold-transition login-page">
