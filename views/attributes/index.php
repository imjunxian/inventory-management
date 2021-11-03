<?php
include '../../database/security.php';
$title = "Attributes";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

    <!--Add Toggles-->
    <div class="modal fade" id="addForm">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Attribute</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="code.php" id="addF" method="post" >
              <div class="modal-body">
                <div class="form-group">
                  <label> Attribute Name </label>
                  <input type="text" class="form-control" placeholder="Enter Attribute Name" name="attName" required>
                </div>

                 <div class="form-group">
                  <label for="exampleInputFile">Status</label>
                    <div class="form-group clearfix">
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary1" name="status" class="active" value="Active">
                          <label for="radioPrimary1">
                          Active
                          </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary2" name="status" class="Deactive" value="Inactive">
                          <label for="radioPrimary2">
                            Inactive
                          </label>
                      </div>
                    </div>
                </div>

              </div>
              <!--Submit button-->
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="addBtn">Add</button>
              </div>
            </form><!--Form end-->
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


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
                <h1 class="m-0">Attributes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item active">Attributes</li>
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
                  <h2 class="card-title">Attribute Records</h2>
                  <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addForm">
                    <i class="fa fa-plus"></i> Add
                  </button>
                </div>
                <!-- /.card-header -->
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
                  <div class="table-responsive">
                  <?php
                    $sta = "Active";
                    $query = $connection -> prepare("SELECT * FROM attributes WHERE status=?");
                    $query -> bind_param("s", $sta);
                    $query->execute(); 
                    $result = $query->get_result(); 
                    //$query = 'SELECT * FROM attributes';
                    //$query_run = mysqli_query($connection, $query);
                  ?>
                    <table id="dataTable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Attribute Name</th>
                          <th>Attribute Value</th>
                          <th>Status</th>
                          <th style="text-align:center;" width="250px;"><i class="fa fa-cog"></i> Actions</th>
                        </tr>
                      </thead>

                      <tfoot>
                              <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                          </tfoot>
                      
                      <tbody>
                      <?php
                        if($result > '0'){
                          while($row = $result->fetch_assoc()){
                          ?>
                            <tr>
                                <form></form>
                                <td><?php  echo $row['attributeName']; ?></td>
                                <td>
                                  <?php
                                  $query_attvnum = "SELECT attvalueId FROM attributes_value WHERE parentId='".$row["attributeId"]."'";
                                  $query_attvnum .= "ORDER BY attvalueId";
                                  $query_attvnum_run = mysqli_query($connection, $query_attvnum);
                                  $row_attvnum = mysqli_num_rows($query_attvnum_run);
                                  echo "$row_attvnum";
                                  ?>
                                </td>
                                <td width="30%">
                                <?php
                                    if($row['status'] == 'Active'){
                                    ?>
                                    <span class="badge badge-success">Active</span>    
                                    <?php
                                    }else if($row['status'] == 'Inactive'){
                                    ?>
                                    <span class="badge badge-warning">Inactive</span>
                                    <?php
                                    }
                                ?>
                                </td>
                                <td style="text-align:center;">
                                  <form action="code.php" method="post">
                                    <div class="btn">
                                        <input type="hidden" name="addvalue_id" value="<?php  echo $row['attributeId']; ?>">
                                        <button type="submit" name="addValueBtn" class="btn btn-info" data-toggle="tooltip" title="Add Value For <?php echo $row["attributeName"]; ?>"><i class="fa fa-plus"></i> Add Value</button>
                                        <input type="hidden" name="edit_id" value="<?php  echo $row['attributeId']; ?>">
                                        <button type="submit" name="editBtn" class="btn btn-primary" data-toggle="tooltip" title="Edit <?php echo $row["attributeName"]; ?>"><i class="fa fa-pencil-alt" style="font-size:14px;"></i></button>
                                        <input type="hidden" name="delete_id" value="<?php  echo $row['attributeId']; ?>">
                                        <a href="#deleteModal" class="btn btn-danger deleteBtn" data-id="<?php  echo $row['attributeId']; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" data-toggle="tooltip" title="Remove <?php echo $row["attributeName"]; ?>"></i></a>
                                    </div>

                                  </form>
                                </td>
                            </tr>
                          <?php
                          }
                        }else{
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
                        <a class="btn btn-secondary" href="../recycle/attributes.php"><i class="fa fa-recycle"></i> Recycle Bin</a>
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
    <?php
  }
?>    
        
</div>
<!-- /.content-wrapper -->

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Move to Recycle Bin?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Select "Confirm" below if you want to move it to recycle bin.</p>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="code.php" method="POST">
            <input type="hidden" name="deleteid" value="" />
            <button type="submit" name="recycleBtn" class="btn btn-primary">Confirm</button>
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
  $(function () {
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
  $(function () {

    $.validator.addMethod("valueNotEquals", function(value, element, arg){
        return arg !== value;
    }, "Value must not equal arg.");

  $('#addF').validate({
    rules: {
      attName: {
        required: true,
      },
      status: {
        required: true,
      },
    },
    messages: {
      attName: {
        required: "Attribute Name cannot be empty",
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
    },
  });
});
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>