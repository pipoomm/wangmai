<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="WangMai - Eng CMU 30Years building room checker" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="002-w-1.png" />
    <meta property="og:url" content="https://wangmai.eng.cmu.ac.th" />
    <title>Sign in / WangMai</title>
    <link rel="icon" href="004-w-4.png" type="image/png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Google Font: Kanit -->
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,300;0,400;0,700;1,400&display=fallback"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.6/dist/sweetalert2.all.min.js"
        integrity="sha256-RRb75FFB4bqHpBTVaEua+QNVpKSI5m4HBvQKgY1E8S4=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body class="hold-transition login-page" style="background-image: linear-gradient(to top, #e6e9f0 0%, #eef1f5 100%);">
    <div class="login-box">
        <div class="login-logo">
            <p href="index2.html"><span><b>WangMai:</b></span><span style="font-family: 'Noto Sans Thai Light';"> ว่างไหม</span></p>
        </div>
        <!-- /.login-logo -->
        <div class="card" id="logincard">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="" method="POST">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="uname" id="uname">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password"
                            id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" data-com.bitwarden.browser.user-edited="yes">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" name="login">Sign in</button>
                            <?php include('login_function.php'); ?>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <div class="social-auth-links text-center mb-3">
                    <button type="submit" class="btn btn-block"
                        style="color: rgb(245, 245, 245); background-color: rgb(122, 82, 181);"
                        onclick="location.href='https://oauthcmu.hubhoo.com/callback?type=wangmai'"" onmouseover="
                        this.style.backgroundColor='#a182d0'" onmouseout="
                        this.style.backgroundColor='#7a52b5'"><img src="https://elearning.cmu.ac.th/cmu_logo.png" alt="" width="24" height="24"> Sign in with CMU IT
                        Account</button>
                </div>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
</body>

</html>