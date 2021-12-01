<?php
include('../../database/security.php');
$title = "Company";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php
  if(($_SESSION['user_role'] != "SuperUser")){
  ?>  
    <div class="content-header"></div>
      <!--If user not superuser-->
      <br><br><br>
      <section class="content">     
        <h1 class="text-justify text-center"><i class="fa fa-exclamation-circle" style="color:red;"></i> Access Denied </h1><br>
        <h2 class="text-justify text-center">You have no permission to view this page.</h2><br>
        <h2 class="text-justify text-center">You may <a href="../dashboard/">CLICK HERE</a> to return. </h2>    
      </section>
  <?php
  }else{
    ?>
      <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Company</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active"><a href="../company">Company</a></li>
                <li class="breadcrumb-item active">Edit Company</li>
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
            <!-- general form elements -->
            <div class="card card-default">
              <div class="card-header">
                <h3 class="card-title">Edit Company</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php

                if(isset($_SESSION['editid'])){
                    $id = $_SESSION['editid'];
                    $query = "SELECT * FROM company WHERE companyId='$id'";
                    $query_run = mysqli_query($connection, $query);

                    foreach ($query_run as $row){

                    ?>
                      <form action="code.php" id="editForm" method="post">
                        <div class="card-body">

                          <input type="hidden" class="form-control" id="id" value="<?php echo $row['companyId']?>" placeholder="id" name="companyid">

                          <div class="form-group">
                            <label for="username">Company Name</label>
                            <input type="text" class="form-control" id="name" value="<?php echo $row['companyName']?>" placeholder="Name" name="name">
                          </div>

                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" value="<?php echo $row['email']?>" placeholder="Email" name="email">
                          </div>

                          <div class="form-group">
                            <label for="contact">PhoneNo</label>
                            <input type="text" class="form-control" id="contact" value="<?php echo $row['contact']?>" placeholder="Phone Number" name="contact">
                          </div>

                           <div class="form-group">
                            <label for="contact">Address 1</label>
                            <input type="text" class="form-control" id="add1" value="<?php echo $row['address1']?>" placeholder="Address 1" name="add1">
                          </div>

                           <div class="form-group">
                            <label for="contact">Address 2</label>
                            <input type="text" class="form-control" id="add2" value="<?php echo $row['address2']?>" placeholder="Address 2" name="add2">
                          </div>

                           <div class="form-group">
                            <label for="contact">Postcode</label>
                            <input type="text" class="form-control" id="postcode" value="<?php echo $row['postcode']?>" placeholder="Postcode" name="postcode">
                          </div>

                          <div class="form-group">
                            <label for="contact">City</label>
                            <input type="text" class="form-control" id="city" value="<?php echo $row['city']?>" placeholder="City" name="city">
                          </div>

                          <div class="form-group">
                            <label for="contact">State</label>
                            <!--<input type="text" class="form-control" id="state" value="<?php echo $row['state']?>" placeholder="State" name="state">-->
                            <select class="form-control multiselect" id="state" placeholder="State" name="state">>
                            <option value="<?php echo $row['state']?>"><?php echo $row['state']?></option>
                            <option value="Johor">Johor</option>
                            <option value="Kedah">Kedah</option>
                            <option value="Kelantan">Kelantan</option>
                            <option value="Malacca">Malacca</option>
                            <option value="Negeri Sembilan">Negeri Sembilan</option>
                            <option value="Pahang">Pahang</option>
                            <option value="Penang">Penang</option>
                            <option value="Perak">Perak</option>
                            <option value="Perlis">Perlis</option>
                            <option value="Sabah">Sabah</option>
                            <option value="Sarawak">Sarawak</option>
                            <option value="Selangor">Selangor</option>
                            <option value="Terengganu">Terengganu</option>
                            <option value="Kuala Lumpur">Kuala Lumpur</option>
                            <option value="Labuan">Labuan</option>
                            <option value="Putrajaya">Putrajaya</option>
                           </select>
                          </div>

                           <div class="form-group">
                            <label for="contact">Country</label>
                            <input type="text" class="form-control" id="scountry" value="<?php echo $row['country']?>" placeholder="Country" name="scountry" disabled>
                             <input type="hidden" class="form-control" id="country" value="<?php echo $row['country']?>" placeholder="Country" name="country">
                          </div>



                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                                <a href="../company" class="btn btn-secondary">Cancel</a>
                                <!--<button type="submit" class="btn btn-secondary">Cancel</button>-->
                              <button type="submit" name="edit_btn" class="btn btn-primary" >Update</button>
         
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
  $(document).ready(function() {
    $('.multiselect').select2({
      theme: 'bootstrap4',
      closeOnSelect: true,
    });
  });   

</script>

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
      add1: {
        required: true
      },
      add2: {
        required: true
      },
      name: {
        required: true
      },
      contact: {
        required: true,
        minlength:10,
        digits: true
      },
      city: {
        required: true
      },
      state: {
        required: true
      },
      postcode: {
        required: true
      },
      country:{
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email",
        email: "Please enter a vaild email",
        regex: "Please enter a valid email"
      },
      add1: {
        required: "Please provide address 1"
      },
      add2: {
        required: "Please provide address 2"
      },
      name: {
        required: "Please provide name"
      },
      contact: {
        required: "Please provide a contact number",
        minlength: "Please enter valid phone number eg. 0123456789"
      },
      city:{
        required: "Please provide city"
      },
      state: {
        required: "Please provide state"
      },
      postcode: {
        required: "Please provide postcode"
      },
      country:{
        required: "Please provide country"
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
