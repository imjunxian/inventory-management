<?php
include '../../database/security.php';
$title = "Brands";
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
                <h1 class="m-0">Edit Brand</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item"><a href="../brands">Brands</a></li>
                <li class="breadcrumb-item active">Edit Brand</li>
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
                <h3 class="card-title">Edit Brand</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php

                if(isset($_SESSION['editid'])){
                    $id = $_SESSION['editid'];
                    $query = "SELECT * FROM brands where brandId='$id'";
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
                                       <i class="fa fa-exclamation-circle"></i> ' . $_SESSION['statusEmail'] . '
                                    </div>
                                    </div>
                                    ';
                              unset($_SESSION['statusEmail']);
                            }
                          ?>

                        <input type="hidden" class="form-control" id="userid" value="<?php echo $row['brandId']?>" placeholder="Username" name="brandid">

                        <div class="form-group">
                            <label> Brand Name </label>
                            <input type="text" class="form-control" placeholder="Enter Brand Name" name="brandName" value="<?php echo $row['brandName'];?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputFile">Status</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="status" class="active" value="Active" <?php if($row['status']=="Active") {echo "checked";}?>>
                                    <label for="radioPrimary1">
                                        Active
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="status" class="Deactive" value="Inactive" <?php if($row['status']=="Inactive") {echo "checked";}?>>
                                    <label for="radioPrimary2">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                        </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                                <a href="../brands" class="btn btn-secondary">Cancel</a>
                                <!--<button type="submit" class="btn btn-secondary">Cancel</button>-->
                              <button type="submit" name="edit_btn" class="btn btn-primary" >Update</button>
                        </div>
                      </form>
                    <?php
                    }
                    
                }elseif(!isset($_SESSION['editid'])){
              ?>
              <!--<br>
                <p class="text-justify text-center">
                  Brand Not Found! <br>
                  You may <a href="../brands/">CLICK HERE</a> to return.
                </p>
              <br>-->
              <script> location.replace("../brands/index.php?idnotfound"); </script>
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

  $('#editForm').validate({
    rules: {
        brandName: {
        required: true
      },
      status: {
        required: true
      },
    },
    messages: {

        brandName: {
        required: "Supplier Name cannot be empty"
      },
      status: {
        required: "Status cannot be empty"
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

