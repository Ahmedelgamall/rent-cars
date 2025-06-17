<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> {{ settings('system_name') }} | {{ getTranslatedWords('login') }}</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('dist/css/icons/font-awesome/css/fontawesome-all.min.css') }}">


    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/adminlte.min.css') }}">
    <style>
        body::after {
            content: "";

            background: url("{{ asset('assets/background.jpeg') }}");
            background-repeat: no-repeat;
            background-size: cover;
            opacity: 0.7;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            z-index: -1;
        }

        .input-group-text {

            color: #fff;
            background-color: #1f262d;
            border: none;

        }

        .card-primary.card-outline {
            border-top: 3px solid #27a9e3;
        }

        .btn-primary {
            background-color: #27a9e3;
            border-color: #27a9e3;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="text-center card-header">
                <a href="{{ url('/') }}" class="h1">

                    <img width="70" class="animation__shake img-fluid"
                        src="{{ route('file_show', [settings('logo'), 'settings']) }}"
                        alt="{{ settings('system_name') }}">
                </a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">{{ getTranslatedWords('login') }}</p>

                <form action="{{ route('login') }}" method="post">
                    @csrf
                    <div class="mb-3 input-group">
                        <input name="email" type="email" class="text-right form-control"
                            placeholder="{{ getTranslatedWords('email') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    @error('email')
                        <div class="text-danger">{{ $errors->first('email') }}</div>
                    @enderror

                    <div class="mb-3 input-group">
                        <input name="password" type="password" class="text-right form-control"
                            placeholder="{{ getTranslatedWords('password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <div class="text-danger">{{ $errors->first('password') }}</div>
                    @enderror
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit"
                                class="btn btn-primary btn-block">{{ getTranslatedWords('submit') }}</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            {{-- @if ($errors->any())
                @foreach ($errors->all() as $error)
                    toastr['error']("{{ $error }}")
                @endforeach
            @endif --}}
            @if (session()->has('success'))
                toastr['success']("{{ session()->get('success') }}")
            @elseif (session()->has('error'))
                toastr['error']("{{ session()->get('error') }}")
            @endif
        });
    </script>
</body>

</html>
