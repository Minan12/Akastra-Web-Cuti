<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Akastra</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="/modules/bootstrap-social/bootstrap-social.css">
    <link rel="stylesheet" href="/modules/izitoast/css/iziToast.min.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/components.css">

<body>
    <div id="app">
        <section class="section">
        <div class="container mt-5">
            <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">

                @if(session()->has('loginFailed'))
                    <div class="col-12 col-md-12 col-sm-6 col-lg-12">
                        <div class="alert alert-danger">
                            {{ session('loginFailed') }}
                        </div>
                    </div>
                @endif

                <div class="card card-primary">
                <div class="card-header text-center"><h4>Login</h4></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('authenticate') }}" class="needs-validation" novalidate="">
                        @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                        Please fill in your email
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="d-block">
                            <label for="password" class="control-label">Password</label>
                        <div class="float-right">
                            {{-- <a href="auth-forgot-password.html" class="text-small">
                            Forgot Password?
                            </a> --}}
                        </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                        <div class="invalid-feedback">
                        please fill in your password
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Login
                        </button>
                    </div>
                    </form>
                </div>
                </div>


                <div class="simple-footer">
                Copyright &copy; Akastra
                </div>
            </div>
            </div>
        </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="/modules/jquery.min.js"></script>
    <script src="/modules/popper.js"></script>
    <script src="/modules/tooltip.js"></script>
    <script src="/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="/modules/moment.min.js"></script>
    <script src="/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="/modules/izitoast/js/iziToast.min.js"></script>

    <!-- Page Specific JS File -->

    <!-- Template JS File -->
    <script src="/js/scripts.js"></script>
    <script src="/js/custom.js"></script>
</body>
</html>
