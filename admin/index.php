<?php 
  require_once "object.php";

  if (isset($_COOKIE['name'])) {
    session_start();
    $_SESSION['id'] = $_COOKIE['id'];
    $_SESSION['name'] = $_COOKIE['name'];
    $_SESSION['email'] = $_COOKIE['email'];
    $_SESSION['image'] = $_COOKIE['image'];
    $_SESSION['role_id'] = $_COOKIE['role_id'];
    $_SESSION['role_name'] = $_COOKIE['rname'];
    header('location:dashboard.php');
  }

  if(isset($_POST['btnLogin'])){
    $err = [];
    if(isset($_POST['email']) && !empty($_POST['email'])){
      if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
         $user->set('email',$_POST['email']);
      }
      else{
        $err['email'] = "Invalid format";
      }
    }
    else{
      $err['email'] ="Please enter email";
    }

    if(isset($_POST['password']) && !empty($_POST['password'])){
      /*special character, number, Capital, min 8 max 20
      if (preg_match("/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,20}$/",$_POST['password'])) {
        $user->set('password',$_POST['password']);
      }
      else{
        $err['password'] ="Invalid format";
      }   */
      $user->set('password',md5($_POST['password']));
    }
    else{
      $err['password'] ="Please enter password";
    }

    if(count($err)==0){
      $loginStatus = $user->login();
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>News Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link href="css/custom.css" rel="stylesheet">

 

</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back Admin !</h1>
                  </div>
                  <?php if(isset($loginStatus)){ ?>
                      <div class = "alert alert-danger">Login Failed</div>
                  <?php } ?>
                  <?php if(isset($_GET['msg']) && $_GET['msg'] == 1){ ?>
                      <div class = "alert alert-danger">Please login to access dashboard</div>
                  <?php } ?>
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF']?>" id="loginform"class="user" novalidate>
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="email" placeholder="Enter Email Address...">
                      <?php if(isset($err['email'])){ ?>
                        <label id="exampleInputEmail-error" class="error" for="exampleInputEmail"><?php echo $err['email']; ?></label>
                      <?php } ?>
                    </div>
                    <div class="form-group" id="show_hide_password">
                      

                      <div class="input-group-prepend">
                        <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                        <div class="input-group-text">
                          <a href=""><i class="fa fa-eye-slash" id="custom-color" aria-hidden="true"></i></a>
                        </div>
                      </div>
                      <!-- password show-hide -->
                      <!-- <div class="input-group-addon">
                        <a href=""><i class="fa fa-eye-slash" id="custom-color" aria-hidden="true"></i></a>
                      </div> -->
                      <!-- password show-hide ends-->
                      <?php if(isset($err['password'])){ ?>
                        <label id="exampleInputPassword-error" class="error" for="exampleInputPassword"><?php echo $err['password']; ?></label>
                      <?php } ?>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" id="remember">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="btnLogin">
                      Login
                    </button>
                  </form>
                  <hr>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <script type="text/javascript" src="js/jquery_validation/dist/jquery.validate.min.js"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#loginform1').validate({
        rules: {
          password: "required",
          email:{
            required:true,
            email:true
          }
        }
      });
      // Password show-hide js
      $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
    });
  </script>

</body>

</html>
