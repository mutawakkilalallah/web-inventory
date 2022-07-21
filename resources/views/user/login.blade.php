<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Web Inventory | Log in</title>

    <link rel="shortcut icon" href="wifi-signal.png" type="image/x-icon">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet" href="/assets/plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="/assets/dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="hold-transition login-page bg-dark">
    @if (session()->has('invalidLogin'))
        <script>
            alert('Username atau Password Salah')
        </script>
    @endif
    <div class="login-box">
        <img src="wifi-signal.png" class="mb-3" alt="">
        <div class="card">
            <div class="card-body login-card-body">
                <form action="/login" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-4">
                            <button type="submit" class="btn bg-gradient-navy btn-block">Login</button>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>


    <script src="/assets/plugins/jquery/jquery.min.js"></script>

    <script src="/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/dist/js/adminlte.min.js?v=3.2.0"></script>
</body>

</html>
