<?php
session_start();
$title = "Reset Password";
include('../../includes/header.php');
include ('../../database/dbconfig.php');
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


<!--<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="../../dist/img/tabLogo.png" alt="AdminLTELogo" height="50" width="50" class="img-circle">
  </div>-->

<?php
$currentDate = date("U");
$email = $_GET["email"];
$stmt = $connection -> prepare("SELECT * FROM password_reset WHERE email=?");
$stmt->bind_param('s', $email);
$stmt->execute(); 
$result = $stmt->get_result();

if(!mysqli_num_rows($result) >= 1){
  ?>
  <script> location.replace("../error/404.php"); </script>
  <?php
}

while ($row = $result->fetch_assoc()) {
    $cdate = $row["expires"];

    if(isset($_GET["selector"]) == "" && isset($_GET["validator"]) == "" || $currentDate >= $cdate){
      ?>
      <script type="text/javascript">window.location = "<?php echo $base."error/404.php"; ?>";</script>
      <?php
    }else{
      if(ctype_xdigit($_GET["selector"]) !== false && ctype_xdigit($_GET["validator"]) !== false){
        ?>
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
              <p class="login-card-description "> Reset Password Here :)</p>
              <p class="text-danger" style="font-size:16px;">*This link will EXPIRED after 30 minutes.</p>
              
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

             <form action="code.php" method="post" id="loginForm">

                   <input type="hidden" name="selector" value="<?php echo $_GET["selector"] ?>"> 
                     <input type="hidden" name="validator" value="<?php echo $_GET["validator"] ?>"> 
                      <input type="hidden" name="email" value="<?php echo $_GET["email"] ?>">

                    <div class="input-group mb-4 ">
                  <input type="password" class="form-control" placeholder="New Password" name="password" id="password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-eye field-icon toggle-password" toggle="#password-field" style="font-size:14px;"></span>
                    </div>
                  </div>
                </div>

                    <div class="input-group mb-4">
                      <input type="password" class="form-control" placeholder="Confirm New Password" name="cpassword" id="cpassword">
                      <div class="input-group-append">
                        <div class="input-group-text">
                          <span class="fas fa-eye field-icon toggle-cpassword" toggle="#password-field"></span>
                        </div>
                      </div>
                    </div>

    
                 
                    <div class="row">

                      <!-- /.col -->
                      <div class="col-12">
                        <button type="submit" name="resetPasswordBtn" class="btn btn-primary btn-block">Change</button>
                      </div>
                      <!-- /.col -->
                    </div>

                <br>
                      <p class="login-card-footer-text">
                        <a href="../auth/"><i class="fa fa-unlock"></i> Remember Password?</a>
                      </p>

                  </form>

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
      }
    }
  }


?>


    <?php
    include('../../includes/script.php');
    //include('includes/footer.php');
    ?>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>


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
            password: {
              required: true,
              regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/
              //minlength: 5
            },
            cpassword: {
              required: true,
              regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/,
             equalTo : "#password",
            },
          },
          messages: {
            password: {
              required: "Please enter your password",
              regex: "Your password must at least 8 characters which is contained 1 number, 1 uppercase, 1 lowercase letter"
              //minlength: "Your password must be at least 5 characters"
            },
            cpassword: {
              required: "Please confirm your password",
              regex: "Your password must at least 8 characters which is contained 1 number, 1 uppercase, 1 lowercase letter",
               equalTo : "Confirm Password must be same with Password"
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

      $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#password");;
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });

      $(".toggle-cpassword").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#cpassword");;
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
      });
    </script>

