<?php
include '../../database/security.php';
$title = "Suppliers";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
   <?php
  if(($_SESSION['user_role'] != "SuperUser") && ($_SESSION['user_role'] != "Admin")){
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
                <h1 class="m-0">Edit Supplier</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="../suppliers">Suppliers</a></li>
                <li class="breadcrumb-item active">Edit Supplier</li>
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
                <h3 class="card-title">Edit Supplier</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php

                if(isset($_SESSION['editid'])){
                    $id = $_SESSION['editid'];
                    $query = "SELECT * FROM suppliers where supplierId='$id'";
                    $query_run = mysqli_query($connection, $query);

                    foreach ($query_run as $row){
                    ?>
                        <form action="code.php" id="editForm" method="post">
                        <div class="card-body">

                          <?php
                            if (isset($_SESSION['statusEmail']) && $_SESSION['statusEmail'] != '') {
                              echo '
                                    <div class="form-group">
                                    <div class="alert alert-danger alert-dismissible" >
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                      <i class="fa fa-exclamation-circle"></i>  ' . $_SESSION['statusEmail'] . '
                                    </div>
                                    </div>
                                    ';
                              unset($_SESSION['statusEmail']);
                            }
                          ?>

                        <input type="hidden" class="form-control" id="userid" value="<?php echo $row['supplierId']?>" placeholder="Username" name="supplierid">

                        <div class="form-group">
                            <label> Supplier Name </label>
                            <input type="text" class="form-control" placeholder="Enter Supplier Name" name="supplierName" value="<?php echo $row['supplierName'];?>">
                        </div>

                         <div class="form-group">
                          <label> Supplier Email </label>
                          <input type="text" class="form-control" placeholder="Enter Supplier Email" name="supplierEmail" value="<?php echo $row['supplierEmail'];?>">
                        </div>

                         <div class="form-group">
                          <label> Supplier Contact </label>
                          <input type="text" class="form-control" placeholder="Enter Supplier Contact" name="supplierContact" value="<?php echo $row['supplierContact'];?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Status</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="status" class="active" value="Active" <?php if($row['supplierStatus']=="Active") {echo "checked";}?>>
                                    <label for="radioPrimary1">
                                        Active
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="status" class="Deactive" value="Inactive" <?php if($row['supplierStatus']=="Inactive") {echo "checked";}?>>
                                    <label for="radioPrimary2">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                                <a href="../suppliers" class="btn btn-secondary">Cancel</a>
                                <!--<button type="submit" class="btn btn-secondary">Cancel</button>-->
                              <button type="submit" name="edit_btn" class="btn btn-primary" >Update</button>
                        </div>
                      </form>
                    <?php
                    }

                }elseif(!isset($_SESSION['editid'])){
                  ?>
                 <!-- <br>
                    <p class="text-justify text-center">
                      Supplier Not Found! <br>
                      You may <a href="../suppliers/">CLICK HERE</a> to return.
                    </p>
                  <br>-->
                  <script> location.replace("../suppliers/index.php?idnotfound"); </script>
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
  $(function () {
    $.validator.addMethod("valueNotEquals", function(value, element, arg){
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
      supplierName: {
        required: true
      },
      supplierEmail: {
          required: true,
          email: true,
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
      },
      supplierContact: {
          required: true,
          minlength: 10,
          digits: true,
      },
      status: {
        required: true,
      },
    },
    messages: {

      supplierName: {
        required: "Supplier Name cannot be empty"
      },
       supplierEmail: {
          required: "Supplier Email cannot be empty",
          email: "Please enter a vaild email",
          regex: "Please enter a valid email",
        },
        supplierContact: {
          required: "Supplier Contact cannot be empty",
          minlength: "Please enter valid phone number eg. 0123456789",
        },
      status: {
        required: "Status cannot be empty",
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

