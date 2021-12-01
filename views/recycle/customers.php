<?php
include '../../database/security.php';
$title = "Recycle Bin";
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
          <h1 class="m-0">Recycle Bin - Customers</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
            <li class="breadcrumb-item active">Recycle Bin</li>
            <li class="breadcrumb-item active">Customers</li>
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
        <div class="col-12">

          <div class="card">
            <form action="">
              <div class="card-header">
                <h2 class="card-title">Customer Records</h2>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <?php
                  $sta = "Inactive";
                  $query = $connection -> prepare("SELECT customers.*, users.userName FROM customers INNER JOIN users ON customers.AddedBy = users.userId WHERE customers.status=?");
                  $query -> bind_param("s", $sta);
                  $query->execute(); 
                  $result = $query->get_result(); 
                  //$query = 'SELECT * FROM customers';
                  //$query_run = mysqli_query($connection, $query);
                  ?>
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="20">No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Gender</th>
                        <th>Added By</th>
                        <th style="text-align:center;" width="150px;"><i class="fa fa-cog"></i> Actions</th>
                      </tr>
                    </thead>

                    <tfoot>
                              <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                          </tfoot>

                    <tbody>
                      <?php
                      if ($result > '0') {
                        $n=0;
                        while ($row = $result->fetch_assoc()) {
                          $n++;
                      ?>
                          <tr>
                            <form></form>
                            <td><?php echo $n; ?></td>
                            <td><?php echo $row['customerName']; ?></td>
                            <td><?php echo $row['customerEmail']; ?></td>
                            <td><?php echo $row['customerContact']; ?></td>
                            <td><?php echo $row['customerGender']; ?></td>
                            <td><?php echo $row['userName']; ?></td>
                            <td style="text-align:center;">
                              <form action="../customers/code.php" method="post">
                                <div class="btn">
                                  <input type="hidden" name="recover_id" value="<?php echo $row['customerId']; ?>">
                                  <button type="submit" name="recoverBtn" class="btn btn-primary" data-toggle="tooltip" title="Recover <?php echo $row["customerName"]; ?>"><i class="fa fa-undo" style="font-size:14px;"></i></button>
                                  <!--<input type="hidden" name="delete_id" value="<?php echo $row['customerId']; ?>">
                                  <a href="#deleteModal" class="btn btn-danger deleteBtn" data-id="<?php echo $row['customerId']; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" data-toggle="tooltip" title="Delete <?php echo $row["customerName"]; ?>"></i></a>-->
                                </div>

                              </form>
                            </td>
                          </tr>
                      <?php
                        }
                      } else {
                        echo "";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!--Table responsive-->
              </div>
              <!-- /.card-body -->
            </form>
            <div class="card-footer">
                  <a class="btn btn-secondary" href="../customers/">View</a>
                </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Select "Delete" below if you want to delete user.</p>
          <p class="text-danger">*Caution: Changes cannot be made after delete successful.</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form action="../customers/code.php" method="POST">
          <input type="hidden" name="deleteid" value="" />
          <button type="submit" name="delete_btn" class="btn btn-primary">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>

<script>
  $(function() {
    $('#dataTable').on('click', 'a.deleteBtn', function(e) {
      e.preventDefault();
      var link = this;
      var deleteModal = $("#deleteModal");
      // store the ID inside the modal's form
      deleteModal.find('input[name=deleteid]').val(link.dataset.id);
      // open modal
      deleteModal.modal();
    });
  });
</script>

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

    $('#addF').validate({
      rules: {
        custEmail: {
          required: true,
          email: true,
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        },
        custName: {
          required: true,
          minlength: 5
        },
        custContact: {
          required: true,
          minlength: 10,
          digits: true
        },
        gender: {
          required: true,
        },
      },
      messages: {
        custEmail: {
          required: "Please enter customer email",
          email: "Please enter a vaild email",
          regex: "Please enter a valid email"
        },
        custName: {
          required: "Please enter customer name",
          minlength: "Customer name must at least 5 characters."
        },
        custContact: {
          required: "Please enter customer phone number",
          minlength: "Please enter valid phone number eg. 0123456789"
        },
        gender: {
          required: "Please select customer gender",
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
      },
    });
  });
</script>

<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

</script>