<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BCGEMPPC | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="admin/includes/assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="admin/includes/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="admin/includes/assets/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <style>
    body {
      background-image: url('admin/includes/assets/dist/img/logo.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="admin/includes/assets/index2.html"><b>BCGEMPPC</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in as Admin/Employee to start your session</p>

      <form action="controllers/adminlogin.php" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <?php
        if(isset($_SESSION['status'])){
          if($_SESSION['status']=='success'){
            ?>
            <div class="alert alert-success" role="alert">
              <?php echo $_SESSION['message']?>
            </div>
            <?php
          }else{
            ?>
            <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['message']?>
            </div>
            <?php
          }
          unset($_SESSION['message']);
          unset($_SESSION['status']);
        }
        ?>
        <div class="row">
          <div class="col-8">
            
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="signin" class="btn btn-warning btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a onclick="checkcamera()" class="btn btn-block btn-warning">
          <i class="fa fa-camera mr-2"></i> Sign in using Face Recognition
        </a>
        
      </div> -->
      <!-- /.social-auth-links -->

      
      <p class="mb-0">
        <a href="registration" class="text-center" >Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="admin/includes/assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="admin/includes/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="admin/includes/assets/dist/js/adminlte.min.js"></script>
<script>
    //check if the machine has a camera
    function checkcamera(){
        if (navigator.mediaDevices.getUserMedia) {
            window.location.href = 'faceverify';
        } else {
            alert('Camera is not available');
        }
    }
</script>
</body>
</html>
