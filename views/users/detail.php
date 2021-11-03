<?php
include '../../database/security.php';
$title = "User";
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
          <h1 class="m-0">View User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="../users">Users</a></li>
            <li class="breadcrumb-item active">View User</li>
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
              <h3 class="card-title">User Details</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php
           

            if (isset($_SESSION['viewid'])) {
              $id = $_SESSION['viewid'];
              $query = "SELECT * FROM users where userId='$id'";
              $query_run = mysqli_query($connection, $query);

              foreach ($query_run as $row) {

            ?>
                <form action="code.php" id="editForm" method="post">                     
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table  table-hover">

                                        <tbody>
                                            <tr>
                                                <th><i class="fa fa-image"></i> Profile Image</th>
                                                <td>
                                                  <!--<a href="../../dist/img/profile/<?php echo $row['profileImg']; ?>" data-toggle="lightbox" data-gallery="gallery"></a>-->                   
                                                  <?php
                                                    if($row["profileImg"] == ""){
                                                      ?>
                                                      <img class="img-profile rounded-circle" src="../../dist/img/avatar9.png" height="112px;" width="112px;" style="margin-top: -2px;">
                                                      <?php
                                                    }else{
                                                      echo '<img src="../../dist/img/profile/'.$row['profileImg'].'" width="112" height="112" class="img-circle" alt="image" />';
                                                    }
                                                  ?>
                                                  
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-user"></i> Username</th>
                                                <td><?php echo $row['userName']; ?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-envelope"></i> Email</th>
                                                <td><?php echo $row['userEmail']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone-alt"></i> Contact</th>
                                                <td><?php echo $row['userContact']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-venus-mars"></i> Gender</th>
                                                <td><?php echo $row['userGender']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-calendar"></i> Birth Date</th>
                                                <td><?php echo $row['userBirthDate']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-tag"></i> Roles</th>
                                                <td><?php echo $row['userRoles']?></td>
                                            </tr>
                                             <tr>
                                                <th><i class="fa fa-clock"></i> Status</th>
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
                                                      }
                                                  ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-clock"></i> Login Status</th>
                                                <td>
                                                  <?php
                                                      if($row['currentStatus'] == 'Online'){
                                                        ?>
                                                          <span class="online" style="color:#28a745;">● Online</span>
                                                        <?php
                                                      }else if($row['currentStatus'] == 'Offline'){
                                                        ?>
                                                          <span class="offline" style="color:#6c757d;">● Offline</span>
                                                        <?php
                                                      }
                                                  ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-history"></i> Last Logged In</th>
                                                <td><?php echo $row['lastLogin']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--table responsive-->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                              <a href="../users/" class="btn btn-secondary">Back</a>
                              <input type="hidden" name="edit_id" value="<?php echo $row['userId']; ?>">
                              <button type="submit" name="editBtn" class="btn btn-primary">Edit <i class="fa fa-pencil-alt" style="font-size:14px;"></i></button>
                            </div>
                    </form>
            <?php
              }
              unset($_SESSION['viewid']);
            }elseif(!isset($_SESSION['viewid'])){
              ?>
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

