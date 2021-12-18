<?php
session_start();
$title = "Login";
include('../../includes/header.php');
//include('../includes/navbar.php');

?>


<style type="text/css">
  .btn-default{
    background-color: #f8f9fa;
    border-color: #ddd;
    color: #444;
  }
  body {
  background-color: #e9ecef;
  min-height: 100vh; }

.brand-wrapper {
  margin-bottom: 19px; }
  .brand-wrapper .logo {
    height: 37px; }

.input-group-text{
  background-color: transparent;
}

.login-card {
  border: 0;
  border-radius: .35rem;
  box-shadow: 0 10px 35px 0 rgba(172, 168, 168, 0.43);
  overflow: hidden; }
  .login-card-img {
    border-radius: 0;
    position: absolute;
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
       object-fit: cover; }
  .login-card .card-body {
    padding: 85px 60px 60px; }
    @media (max-width: 422px) {
      .login-card .card-body {
        padding: 30px 24px; } }
  .login-card-description {
    font-size: 23px;
    color: #000;
    font-weight: normal;
    margin-bottom: 23px; }
  .login-card form {
    max-width: 400px; }
  .login-card .form-control{

    padding: 15px 25px;

    min-height: 45px;
    font-size: 16px;

    font-weight: normal; }
    .login-card .form-control::-webkit-input-placeholder {
      color: #919aa3; }
    .login-card .form-control::-moz-placeholder {
      color: #919aa3; }
    .login-card .form-control:-ms-input-placeholder {
      color: #919aa3; }
    .login-card .form-control::-ms-input-placeholder {
      color: #919aa3; }
    .login-card .form-control::placeholder {
      color: #919aa3; }
  .login-card .login-btn {
    padding: 13px 20px 12px;
    background-color: #000;
    border-radius: 4px;
    font-size: 17px;
    font-weight: bold;
    line-height: 20px;
    color: #fff;
    margin-bottom: 24px; }
    .login-card .login-btn:hover {
      border: 1px solid #000;
      background-color: transparent;
      color: #000; }
  .login-card .forgot-password-link {
    font-size: 14px;
    color: #919aa3;
    margin-bottom: 12px; }
  .login-card-footer-text {
    font-size: 16px;
    color: #0d2366;
    margin-bottom: 60px; }
    @media (max-width: 767px) {
      .login-card-footer-text {
        margin-bottom: 24px; } }
  .login-card-footer-nav a {
    font-size: 14px;
    color: #919aa3; }

/*# sourceMappingURL=login.css.map */

</style>

<body id="body">
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="../../dist/img/login3.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <br>
                 <p class="h2 "><img src="../../dist/img/tabLogo.png" alt="logo" class="img-circle logo" style="margin-top:-1%"> INVENTORY</p>
              </div>
              <p class="login-card-description ">Welcome Back :)</p>

              <?php
                if (isset($_SESSION['status']) && $_SESSION['status'] != '') {
                  echo '

                        <div class="alert alert-danger alert-dismissible" style="max-width: 400px;" id="success-alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-exclamation-circle"></i> ' . $_SESSION['status'] . '
                        </div>
   
                        ';
                  unset($_SESSION['status']);
                }
            ?>
            <!--Password changed-->
            <?php
                if (isset($_SESSION['successStatus']) && $_SESSION['successStatus'] != '') {
                  echo '
                        <div class="alert alert-success alert-dismissible" style="max-width: 400px;" id="success-alert">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle"></i> ' . $_SESSION['successStatus'] . '
                        </div>
                        ';
                  unset($_SESSION['successStatus']);
                }
            ?>

             <form action="code.php" method="post" id="loginForm">

                  <div class="input-group mb-4 ">
                  <!--Display email if email is exists and password invalid-->
                  <?php
                  if (isset($_SESSION['loginEmail']) && $_SESSION['loginEmail'] != '') {
                  ?>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php echo $_SESSION['loginEmail'] ?>">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  <?php
                    unset($_SESSION['loginEmail']);
                  } else {
                  ?>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; }else{ echo "";} ?>"> 
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  <?php
                  }
                  ?>
                </div>
                <!--End Here for email-->

                <div class="input-group mb-4 ">
                  <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; }else{ echo "";} ?>">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-eye field-icon toggle-password" toggle="#password-field" style="font-size:14px;"></span>
                    </div>
                  </div>
                </div>
                <!--<?php if(isset($_COOKIE["email"])) { ?> checked <?php } ?>-->
                   <div class="icheck-primary mb-4">
                    <input type="checkbox" id="remember" name="rememberme"  >
                    <label for="remember" style="color: #666666;">
                      Remember Me
                    </label>
                  </div>
                  
                  <div class="row">
                  <!-- /.col -->
                  <div class="col-12">
                    <button type="submit" name="loginBtn" class="btn btn-primary btn-block" id="login">Sign In</button>
                  </div>
                  <!-- /.col -->
                  </div>
                <br>
                <p class="login-card-footer-text "><a href="../auth/forgetPassword.php"><i class="fa fa-lock"></i> Forget Password?</a></p>
                </form>
                <form>
                  <button type="submit" name="faceLogin" class="btn btn-default shadow-sm" id="">Login with Face ID &nbsp;<img src="../../dist/img/faceid.png" height="20" width="20"></button>
                </form>
                
              
            </div>
          </div>
        </div>
      </div>
  
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>





<?php
include('../../includes/script.php');
//include('includes/footer.php');
?>

<script>
      $(function() {

        $.validator.addMethod(
          "regex",
          function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
          },
          "Please check your input."
        );

        $('#loginForm').validate({
          rules: {
            email: {
              required: true,
              email: true,
              regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
            },
            password: {
              required: true,
              regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/
              //minlength: 5
            },
          },
          messages: {
            email: {
              required: "Please enter your email",
              email: "Please enter a vaild email",
              regex: "Please enter a valid email"
            },
            password: {
              required: "Please enter your password",
              regex: "Your password must at least 8 characters which is contained 1 number, 1 uppercase, 1 lowercase letter"
              //minlength: "Your password must be at least 5 characters"
            },
          },
          errorElement: 'span',
          errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').append(error);
          },
          highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
          },
          unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
          }
        });
      });
    </script>

    <script>
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }

      $(".toggle-password").on("click", function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });

    </script>

    <style type="text/css">
        .icheck-primary[class*=icheck-]>input:first-child+input[type=hidden]+label::before, [class*=icheck-]>input:first-child+label::before {
          content: "";
          display: inline-block;
          position: absolute;
          width: 22px;
          height: 22px;
          border: 1px solid #D3CFC8;
          border-radius: 15%;
          margin-left: -29px;
        }
    </style>

    