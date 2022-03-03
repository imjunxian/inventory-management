<?php
include('../../database/security.php');
$title = "Settings";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Profile</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active"><a href="../Settings/">Account Settings</a></li>
                <li class="breadcrumb-item active">Edit Profile</li>
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
                <h3 class="card-title">Edit Profile</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php


                if($_SESSION['user_id']){
                    $id = $_SESSION['user_id'];
                    $query = "SELECT * FROM users where userId='$id'";
                    $query_run = mysqli_query($connection, $query);

                    foreach ($query_run as $row){

                    ?>
                      <form action="code.php" id="editForm" method="post" enctype="multipart/form-data">
                        <div class="card-body">

                           <?php
                            if (isset($_SESSION['statusProfile']) && $_SESSION['statusProfile'] != '') {
                              echo '

                                    <div class="alert alert-danger alert-dismissible" >
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                       <i class="fa fa-exclamation-circle"></i> ' . $_SESSION['statusProfile'] . '
                                    </div>
                             
                                    ';
                              unset($_SESSION['statusProfile']);
                            }
                          ?>

                            <input type="hidden" class="form-control" id="userid" value="<?php echo $row['userId']?>" placeholder="Username" name="userid">

                            <div class="form-group">
                              <label>Image Preview: </label>
                              <?php
                                if($row["profileImg"] == ""){
                                  ?>
                                  <img class="img-profile rounded-circle" src="../../dist/img/avatar9.png" height="100px;" width="100px;" style="margin-top: -2px;">
                                  <?php
                                }else{
                                  echo '<img src="../../dist/img/profile/'.$row['profileImg'].'" width="112" height="112" class="img-circle" alt="image" />';
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

                        <!--<div class="form-group">
                          <label>User Roles</label>
                            <select class="form-control" name="role" disabled>
                              <option value="<?php echo $row['userRoles']?>"><?php echo $row['userRoles']?></option>
                            </select>
                          </div>-->

                          <div class="form-group">
                            <label for="exampleInputFile">Gender</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary1" name="gender" class="male" value="Male" <?php if($row['userGender']=="Male") {echo "checked";}?>>
                                  <label for="radioPrimary1">
                                    Male
                                  </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                  <input type="radio" id="radioPrimary2" name="gender" class="female" value="Female" <?php if($row['userGender']=="Female") {echo "checked";}?>>
                                  <label for="radioPrimary2">
                                    Female
                                  </label>
                                </div>
                            </div>
                          </div>

                          <div class="form-group">
                          <label>Password</label><br>
                            <button type="button" class="btn btn-default" onclick='window.location.href="../settings/editPassword.php"'>
                            Change Password  <i class="fa fa-pencil-alt"></i>
                            </button>
                          </div>

                          <!--<div class="form-group">
                            <label>Face ID</label><br>
                            <button type="button" class="btn btn-default" onclick=''>
                              Enable Face ID
                            </button>
                          </div>-->

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                                <a href="../settings/" class="btn btn-secondary">Cancel</a>
                              <button type="submit" name="editprofile_btn" class="btn btn-primary" >Update</button>
                              <!--<button type="button" class="btn btn-success toastrDefaultSuccess">
                                Launch Success Toast
                              </button>-->
                        </div>
                      </form>
                    <?php
                    }
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




</div>
<!-- /.content-wrapper -->


<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>

<script>
 

  $(function () {
  /*$.validator.setDefaults({
    submitHandler: function () {
      window.location.href = "profile.php";
    }
  });*/

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
      username: {
        required: true,
        minlength:5
      },
      contact: {
        required: true,
        minlength:10,
        digits: true
      },
      gender: {
        required: true,
      },
      dob: {
        required: true,
      },
      file:{
        required: true,
      },
    },
    messages: {
      email: {
        required: "Please enter a email",
        email: "Please enter a vaild email",
        regex: "Please enter a valid email"
      },
      username: {
        required: "Please provide a username",
        minlength: "Your username must be at least 5 characters long"
      },
      contact: {
        required: "Please provide a contact number",
        minlength: "Please enter valid phone number eg. 0123456789"
      },
      gender:{
        required: "Please select your gender",
      },
      dob: {
          required: "Please select user birth date",
      },
      file:{
        required: "Image cannot be empty",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
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

