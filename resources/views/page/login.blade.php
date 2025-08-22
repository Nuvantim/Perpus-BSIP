<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perpus BSIP RumBes | Log in</title>
  <link rel="stylesheet" href="{{ asset('/plugins/toastr/toastr.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="login-logo">
      <img src="{{ asset('/icon/logo.png') }}" width="90" 
      alt="Logo BSIP Ruminansia Besar" 
      class="img-fluid mb-3"><br>
      <a href="#"><b>Sistem Perpustakaan <br></b>BSIP RumBes</a>
    </div>
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>

      <form action="{{ route('autenticate') }}" method="POST">
        @csrf
        <div class="input-group mb-3">
          <input type="email" class="form-control" 
          placeholder="Email" autofocus required name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password" required name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<x-alert />
<!-- /.login-box -->
<script src="{{ asset('/plugins/toastr/toastr.min.js') }}"></script>

<!-- jQuery -->
<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/dist/js/adminlte.min.js') }}"></script>
</body>
</html>
