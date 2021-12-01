<?php
include '../../database/security.php';
$title = "User";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->

   <?php
    if(($_SESSION['user_role'] != "SuperUser")){
    ?>  
      <!--<div class="content-header"></div>
        <br><br><br>
        <section class="content">     
          <h1 class="text-justify text-center"><i class="fa fa-exclamation-circle" style="color:red;"></i> Access Denied </h1><br>
          <h2 class="text-justify text-center">You have no permission to view this page.</h2><br>
          <h2 class="text-justify text-center">You may <a href="../dashboard/">CLICK HERE</a> to return. </h2>    
        </section>-->
        <script> location.replace("../users/index.php?usernotfound"); </script>
    <?php
    }else{
    ?>
     <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Edit User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="../users">Users</a></li>
            <li class="breadcrumb-item active">Edit User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <div class="alert alert-info alert-dismissible" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <i class="fa fa-exclamation-triangle"></i> Notes: The maximum image attached file size is 5MB.
                  The only accepted format are png, jpg and jpeg.
              </div>
          <!-- general form elements -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Edit User</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php
        

            if (isset($_SESSION['editid'])) {
              $id = $_SESSION['editid'];
              $query = "SELECT * FROM users where userId='$id'";
              $query_run = mysqli_query($connection, $query);

              foreach ($query_run as $row) {

            ?>
                <form action="code.php" id="editForm" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                    <?php
                            if (isset($_SESSION['statusEmail']) && $_SESSION['statusEmail'] != '') {
                              echo '
                                    <div class="alert alert-danger alert-dismissible" >
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <i class="fa fa-exclamation-circle"></i>  ' . $_SESSION['statusEmail'] . '
                                    </div>
                                    ';
                              unset($_SESSION['statusEmail']);
                            }
                          ?>
                    <input type="hidden" class="form-control" id="userid" value="<?php echo $row['userId'] ?>" placeholder="Username" name="userid">

                     <div class="form-group">
                              <label>Image Preview: </label>
                              <?php
                                if($row["profileImg"] == ""){
                                  ?>
                                  <img class="img-profile rounded-circle" src="../../dist/img/avatar9.png" height="112px;" width="112px;">
                                  <?php
                                }else{
                                  echo '<a href="../../dist/img/profile/'.$row['profileImg'].'"><img src="../../dist/img/profile/'.$row['profileImg'].'" width="112" height="112" class="img-circle" alt="image" /></a>';
                                }
                              ?>
                            </div>

                    <div class="form-group">
                   <label for="product_image">Profile Image</label>
                    <div class="kv-avatar">
                        <div class="file-loading">
                            <input id="profile_image" name="profile_image" type="file">
                        </div>
                    </div>
                  </div>

                     <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="name" value="<?php echo $row['userName']?>" placeholder="Username" name="username">
                                  </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="<?php echo $row['userEmail']?>" placeholder="Email" name="email">
                                  </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact">Contact</label>
                                    <input type="text" class="form-control" id="phone" value="<?php echo $row['userContact']?>" placeholder="Phone Number" name="contact">
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label>Birthday</label>
                                    <input type="date" id="dob" class="form-control" value="<?php echo $row['userBirthDate']?>" placeholder="Enter Birthday" name="dob">
                                </div>
                            </div>
                        </div>


                    <div class="form-group">
                      <label>User Roles</label>
                      <?php
                      if ($row['userRoles'] == "SuperUser") {
                      ?>
                        <select class="form-control" name="role">
                          <option value="<?php echo $row['userRoles'] ?>"><?php echo $row['userRoles'] ?></option>
                        </select>
                      <?php
                      } else {
                      ?>
                        <select class="form-control" name="role">
                          <option value="<?php echo $row['userRoles'] ?>"><?php echo $row['userRoles'] ?></option>
                          <option value="Admin">Admin</option>
                          <option value="Staff">Staff</option>
                        </select>
                      <?php
                      }
                      ?>

                    </div>

                     <div class="form-group">
                      <label>Status</label>  
                       <?php
                      if ($row['userRoles'] == "SuperUser") {
                      ?>     
                        <select class="form-control" name="status">
                          <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>
                        </select>
                       <?php
                      } else {
                      ?>
                         <select class="form-control" name="status">
                          <option value="<?php echo $row['status'] ?>"><?php echo $row['status'] ?></option>
                          <option value="Active">Active</option>
                          <option value="Banned">Banned</option>
                        </select>
                      <?php
                      }
                      ?>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputFile">Gender</label>
                      <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="radioPrimary1" name="gender" class="male" value="Male" <?php if ($row['userGender'] == "Male") { echo "checked";} ?> >
                          <label for="radioPrimary1">
                            Male
                          </label>
                        </div>
                        <div class="icheck-primary d-inline">
                          <input type="radio" id="radioPrimary2" name="gender" class="female" value="Female" <?php if ($row['userGender'] == "Female") { echo "checked";} ?> >
                          <label for="radioPrimary2">
                            Female
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="alert alert-info alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-comment"></i> Leave the password empty if you don't want to change.
                      </div>
                    </div>


                    <div class="form-group">
                      <label for="exampleInputPassword1">Current Password</label>
                      <span class="fas fa-eye field-icon toggle-opassword" toggle="#password-field"></span>
                      <input type="password" class="form-control" id="opass" placeholder="Current Password" name="oldpass" value="">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <span class="fas fa-eye field-icon toggle-password" toggle="#password-field"></span>
                      <input type="password" class="form-control" id="pass" placeholder="New Password" name="password" value="">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <span class="fas fa-eye field-icon toggle-cpassword" toggle="#password-field"></span>
                      <input type="password" class="form-control" id="cpass" placeholder="Confirm New Password" name="cpassword" value="">
                    </div>


                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <a href="../users/" class="btn btn-secondary">Cancel</a>
                    <!--<button type="submit" class="btn btn-secondary">Cancel</button>-->
                    <button type="submit" name="edituser_btn" class="btn btn-primary">Update</button>
                  </div>
                </form>
            <?php
              }
             
            }elseif(!isset($_SESSION['editid'])){
              ?>
              <!--<br>
                <p class="text-justify text-center">
                  User Not Found! <br>
                  You may <a href="../users/">CLICK HERE</a> to return.
                </p>
              <br>-->
              <script> location.replace("../users/index.php?idnotfound"); </script>
              <?php
            }
            
            ?>

          </div>
          <!-- /.card -->

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->

    <?php
  }
?>    
 
</div>
<!-- /.content-wrapper -->


<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>

<script>
  $(function() {
    $.validator.addMethod("valueNotEquals", function(value, element, arg) {
      return arg !== value;
    }, "Value must not equal arg.");

    $.validator.addMethod(
      "regex",
      function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      },
      "Please check your input."
    );

    $('#editForm').validate({
      rules: {
        email: {
          required: true,
          email: true,
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        },
        password: {
          required: false,
          regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/
        },
        oldpass: {
          required: false,
          regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/
        },
        cpassword: {
          required: false,
          regex: /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/,
          equalTo: "#pass"
        },
        username: {
          required: true,
          minlength: 5
        },
        contact: {
          required: true,
          minlength: 10,
          digits: true
        },
        gender: {
          required: true,
        },
        dob: {
          required: true,
        },
      },
      messages: {
        email: {
          required: "Please enter a email address",
          email: "Please enter a vaild email eg demo@demo.com",
          regex: "Please enter a vaild email eg demo@demo.com"
        },
        oldpass: {
          required: "Please provide current password",
          regex: "Your password must at least 8 characters which is contained 1 number, 1 uppercase, 1 lowercase letter"
        },
        password: {
          required: "Please provide new password",
          regex: "Your password must at least 8 characters which is contained 1 number, 1 uppercase, 1 lowercase letter"
        },
        cpassword: {
          required: "Please confirm your new password",
          regex: "Your password must at least 8 characters which is contained 1 number, 1 uppercase, 1 lowercase letter",
          equalTo: "Confirm Password must be same with password"
        },
        username: {
          required: "Please provide a username",
          minlength: "Your username must be at least 5 characters long"
        },
        contact: {
          required: "Please provide a contact number",
          minlength: "Please enter valid phone number eg. 0123456789"
        },
        gender: {
          required: "Please select your gender",
        },
        dob: {
          required: "Date of Birth cannot be empty",
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
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
</script>

<script type="text/javascript">

    $(".toggle-password").on("click", function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#pass");
        if (input.attr("type") == "password") {
          input.attr("type", "text");
        } else {
          input.attr("type", "password");
        }
    });
    $(".toggle-cpassword").on("click", function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
        var cp = $("#cpass");
        if (cp.attr("type") == "password") {
          cp.attr("type", "text");
        } else {
          cp.attr("type", "password");
        }
    });
    $(".toggle-opassword").on("click", function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
        var op = $("#opass");
        if (op.attr("type") == "password") {
          op.attr("type", "text");
        } else {
          op.attr("type", "password");
        }
    });
                 
</script>

<script type="text/javascript">
  $(document).ready(function() {
  
    $("#mainProductNav").addClass('active');
    $("#addProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Please dont click this &#128561;\')">' +
        '<i class="fa fa-tag"></i>' +
        '</button>'; 
    $("#profile_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: 'Profile',
        removeLabel: '',
        browseIcon: '<i class="fa fa-folder-open"></i>',
        removeIcon: '<i class="fa fa-times"></i>',
        removeTitle: 'Reset or Cancel Image',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "jpeg", "svg"]
    });

  });

</script>