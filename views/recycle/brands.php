<?php
include '../../database/security.php';
$title = "Recycle Bin";
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
                <h1 class="m-0">Recycle Bin - Brands</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                <li class="breadcrumb-item active">Recycle Bin</li>
                <li class="breadcrumb-item active">Brands</li>
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
                  <h2 class="card-title">Brand Records</h2>
                 
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="table-responsive">
                  <?php
                    $sta = "Inactive";
                    $query = $connection -> prepare("SELECT * FROM brands WHERE status=?");
                    $query -> bind_param("s", $sta);
                    $query->execute(); 
                    $result = $query->get_result(); 
                    //$query = 'SELECT * FROM brands';
                    //$query_run = mysqli_query($connection, $query);
                  ?>
                    <table id="dataTable" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>Brands Name</th>
                          <th>Total Products</th>
                          <th>Status</th>
                          <th style="text-align:center;" width="150px"><i class="fa fa-cog"></i> Actions</th>
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
                          while($row = $result -> fetch_assoc()){
                          ?>
                            <tr>
                                <form></form>
                                <td><?php  echo $row['brandName']; ?></td>
                                <td>
                                  <?php
                                  $query_num = "SELECT productId FROM products WHERE brandId='".$row["brandId"]."'";
                                  $query_num .= "ORDER BY productId";
                                  $query_num_run = mysqli_query($connection, $query_num);
                                  $row_num = mysqli_num_rows($query_num_run);
                                  echo "$row_num";
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
                                  <form action="../brands/code.php" method="post">
                                    <div class="btn">
                                    <input type="hidden" name="recover_id" value="<?php  echo $row['brandId']; ?>">
                                      <button type="submit" name="recoverBtn" class="btn btn-primary" data-toggle="tooltip" title="Recover <?php echo $row["brandName"]; ?>"><i class="fa fa-undo" style="font-size:14px;"></i></button>
                                      <input type="hidden" name="delete_id" value="<?php  echo $row['brandId']; ?>">
                                      <!--<a href="#deleteModal" class="btn btn-danger deleteBtn"
                                      data-id="<?php  echo $row['brandId']; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" data-toggle="tooltip" title="Delete <?php echo $row["brandName"]; ?>"></i></a>-->
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
                 <div class="card-footer">
                        <a class="btn btn-secondary" href="../brands/">View</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        Select "Delete" below if you want to delete.
      </div>
      <div class="modal-footer justify-content-between">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <form action="../brands/code.php" method="POST" >
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
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }

</script>