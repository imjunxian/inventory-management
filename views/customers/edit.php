<?php
include '../../database/security.php';
$title = "Customers";
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
          <h1 class="m-0">Edit Customer</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="../users">Customers</a></li>
            <li class="breadcrumb-item active">Edit Customer</li>
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
              <h3 class="card-title">Edit Customer</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php

            if (isset($_SESSION['editid'])) {
              $id = $_SESSION['editid'];
              //$query = $connection -> prepare("SELECT * FROM customers WHERE customerId=?");
              //$query -> bind_param('i', $id);
              //$query->execute();
              //$result = $stmt->get_result();
              //$row = $result->fetch_assoc();
              $query = "SELECT customers.*, users.userName FROM customers INNER JOIN users ON customers.AddedBy = users.userId WHERE customerId='$id'";
              //$query = "SELECT * FROM customers WHERE customerId='$id'";
              $query_run = mysqli_query($connection, $query);

              foreach ($query_run as $row) {

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
                      <input type="hidden" class="form-control" id="userid" value="<?php echo $row['customerId'] ?>" placeholder="Username" name="custid">

                      <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="name" value="<?php echo $row['customerName'] ?>" placeholder="Username" name="username">
                      </div>

                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo $row['customerEmail'] ?>" placeholder="Email" name="email">
                      </div>

                      <div class="form-group">
                        <label for="contact">Contact</label>
                        <input type="text" class="form-control" id="phone" value="<?php echo $row['customerContact'] ?>" placeholder="Phone Number" name="contact">
                      </div>


                      <div class="form-group">
                        <label for="exampleInputFile">Gender</label>
                        <div class="form-group clearfix">
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary1" name="gender" class="male" value="Male" <?php if ($row['customerGender'] == "Male") { echo "checked";} ?> >
                            <label for="radioPrimary1">
                              Male
                            </label>
                          </div>
                          <div class="icheck-primary d-inline">
                            <input type="radio" id="radioPrimary2" name="gender" class="female" value="Female" <?php if ($row['customerGender'] == "Female") { echo "checked";} ?> >
                            <label for="radioPrimary2">
                              Female
                            </label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label for="username">Added By</label>
                        <input type="text" class="form-control" id="name" value="<?php echo $row['userName'] ?>" placeholder="Username" name="username" disabled>
                      </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <a href="../customers" class="btn btn-secondary">Cancel</a>
                      <!--<button type="submit" class="btn btn-secondary">Cancel</button>-->
                      <button type="submit" name="edit_btn" class="btn btn-primary">Update</button>
                    </div>
                  </form>
              <?php
              }

              }elseif(!isset($_SESSION['editid'])){
                ?>
                <!--<br>
                  <p class="text-justify text-center">
                    Customer Not Found! <br>
                    You may <a href="../customers/">CLICK HERE</a> to return.
                  </p>
                <br>-->
                <script> location.replace("../customers/index.php?idnotfound"); </script>
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
          email: "Please enter a vaild email",
          regex: "Please enter a valid email"
        },
        username: {
          required: "Please enter a customer name.",
          minlength: "Customer name must be at least 5 characters long"
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