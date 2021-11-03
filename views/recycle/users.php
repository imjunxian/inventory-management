<?php
include '../../database/security.php';
$title = "Recycle Bin";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

 <?php
 if($_SESSION['user_role'] != "SuperUser"){
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
                <h1 class="m-0">Users</h1>
              </div><!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
                  <li class="breadcrumb-item active">Recycle Bins</li>
                  <li class="breadcrumb-item active">Users</li>
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
                      <h2 class="card-title">User Records</h2>
                      <button type="button" class="btn btn-primary float-right" onclick='window.location.href="add.php"'>
                        Add <i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="table-responsive">
                        <?php
                      
                        $query = 'SELECT * FROM users WHERE userRoles != "SuperUser" AND status = "Closed"';
                        $query_run = mysqli_query($connection, $query);
                     
                        ?>

                        <table id="dataTable" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th width="60px">Image</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Contact</th>
                              <th>Roles</th>
                              <th>Status</th>
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
                              if (mysqli_num_rows($query_run)) {
                                //loop 2 queries in one while loop
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                ?>
                                    <tr>
                                      <form></form>
                                      <td>
                                        <?php  
                                            if($row["profileImg"] == ""){
                                            ?>
                                            <img class="img-profile rounded-circle" src="../../dist/img/avatar9.png" height="60px;" width="60px;">
                                            <?php
                                            }else{
                                              echo '<img src="../../dist/img/profile/'.$row['profileImg'].'" width="60px" height="60px" class="img-circle" alt="image" />';
                                            }
                                              
                                        ?>
                                      </td>
                                      <td>
                                        <?php 
                                        echo $row['userName']; 
                                        if($row["currentStatus"] == "Online"){
                                          ?>
                                          <span class="online" style="color:#28a745;">●</span>
                                          <?php
                                        }else{
                                          ?>
                                          <span class="online" style="color:#6c757d;">●</span>
                                          <?php 
                                        }       
                                        ?>
                                          
                                        </td>
                                      <td><?php echo $row['userEmail']; ?></td>
                                      <td><?php echo $row['userContact']; ?></td>
                                      <td><?php echo $row['userRoles']; ?></td>
                                      <td>
                                        <?php
                                            if($row['status'] == 'Active'){
                                              ?>
                                                  <span class="badge badge-success">Active</span>
                                              <?php
                                            }else if($row['status'] == 'Banned'){
                                              ?>
                                                  <span class="badge badge-warning">Banned</span>
                                              <?php
                                            }else if($row['status'] == 'Closed'){
                                              ?>
                                                  <span class="badge badge-danger">Closed</span>
                                              <?php
                                            }
                                        ?>
                                      </td>
                                      <td style="text-align:center;">
                                        <form action="../users/code.php" method="post">
                                          <div class="btn">
                                            <input type="hidden" name="recover_id" value="<?php echo $row['userId']; ?>">
                                            <button type="submit" name="recoverBtn" class="btn btn-primary" data-toggle="tooltip" title="Recover <?php echo $row["userName"]; ?>"><i class="fa fa-undo" style="font-size:14px;"></i></button>
                                            <input type="hidden" name="delete_id" value="<?php echo $row['userId']; ?>">
                                            <!--<a href="#deleteModal" class="btn btn-danger deleteBtn" data-id="<?php echo $row['userId']; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" data-toggle="tooltip" title="Delete <?php echo $row["userName"]; ?>"></i></a>-->
                                          </div>

                                        </form>
                                      </td>
                                    </tr>
                                <?php
                                }
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
                        <a class="btn btn-secondary" href="../users/">View</a>
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
          <p>Select "Delete" below if you want to delete user.</p>
          <p class="text-danger">*Caution: Changes cannot be made after delete successful.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="../users/code.php" method="POST">
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
      // store the deleteID inside the modal's form
      deleteModal.find('input[name=deleteid]').val(link.dataset.id);
      // open modal
      deleteModal.modal();
    });
  });

</script>
