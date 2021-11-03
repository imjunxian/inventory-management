<?php
session_start();
$title = "Forget Password";
include('../../includes/header.php');
//include('../includes/navbar.php');
?>

<style type="text/css">
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
  border-radius: 10px;
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
        padding: 35px 24px; } }
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


<body>
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
              <p class="login-card-description"> Forget Password</p>
              <p class="login-card-description" style="font-size:16px;color:#666666;">Enter your Email to reset the Password :)</p>
               <?php
                if (isset($_SESSION['sendStatus']) && $_SESSION['sendStatus'] != '') {
                  echo '
                        <div class="form-group" style="max-width: 400px;" id="success-alert">
                        <div class="alert alert-danger alert-dismissible ">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-exclamation-circle"></i> ' . $_SESSION['sendStatus'] . '
                        </div>
                        </div>
                        ';
                  unset($_SESSION['sendStatus']);
                }
            ?>

            <?php
                if (isset($_SESSION['sendsuccessStatus']) && $_SESSION['sendsuccessStatus'] != '') {
                  echo '
                        <div class="form-group"  style="max-width: 400px;" id="success-alert">
                        <div class="alert alert-success alert-dismissible " >
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle"></i> ' . $_SESSION['sendsuccessStatus'] . '
                        </div>
                        </div>
                        ';
                  unset($_SESSION['sendsuccessStatus']);
                }
            ?>

             <form action="code.php" method="post" id="loginForm">

                  <div class="input-group mb-4 ">
 
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>              
                </div>
   

                  <div class="row">
                  <!-- /.col -->
                  <div class="col-12">
                    <button type="submit" name="sendBtn" class="btn btn-primary btn-block" id="login">Send</button>
                  </div>
                  <!-- /.col -->
                  </div>
                <br>
                <p class="login-card-footer-text "><a href="../auth/"><i class="fa fa-unlock"></i> Remember Password?</a></p>

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

          },
          messages: {
            email: {
              required: "Please enter your email",
              email: "Please enter a vaild email",
              regex: "Please enter a valid email"
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

