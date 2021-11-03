<?php
include('../../database/security.php');
$title = "Order";
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
                <h1 class="m-0">Orders</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Orders</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

         <section class="content">
             <div class="container-fluid">

              <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                <form action="code.php" method="POST">
                                <div class="input-group" style="">
                                <!--<input type="text" class="form-control" name="datepicker" id="datepicker"  placeholder="Select Year" />-->
                                <select class="form-control multiselect" id="status" name="status">
                                  <option value="" selected disabled>--- Select Order Status ---</option>
                                  <option value="All">All</option>
                                  <option value="Completed">Completed</option>
                                  <option value="Pending">Pending</option>
                                  <option value="Cancelled">Cancelled</option>
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="submit_Btn" style="display: inline-block;">Filter</button>
                                </span>
                              </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>


            <div class="row">
              <div class="col-12">

                <div class="card">
                  <form action="">
                    <div class="card-header">
                      <h2 class="card-title">Order Records</h2>
                      <button type="button" class="btn btn-primary float-right" onclick='window.location.href="add.php"'>
                         <i class="fa fa-plus"></i> Add
                      </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="table-responsive">
                        <?php
                        if(isset($_GET["status"])){
                          $sta = $_GET["status"];
                          $query = "SELECT orders.*, users.userName FROM orders INNER JOIN users ON users.userId = orders.salesperson WHERE orderStatus='$sta' ORDER BY orderId DESC";
                          $query_run = mysqli_query($connection, $query);
                        }else{
                          $query = "SELECT orders.*, users.userName FROM orders INNER JOIN users ON users.userId = orders.salesperson ORDER BY orderId DESC";
                          $query_run = mysqli_query($connection, $query);
                        }

                        ?>

                        <table id="dataTable" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th width="10px;">No</th>
                              <th>#Invoice No</th>
                              <th>Name</th>
                              <th>SalesPerson</th>
                              <th>Total Products</th>
                              <th>Total Amount</th>
                              <th>DateTime</th>
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
                                <th></th>
                                <th></th>
                            </tr>
                          </tfoot>
                         
                          <tbody>
                            <?php
                              if (mysqli_num_rows($query_run) > 0) {
                                $n=0;
                                while ($row = mysqli_fetch_assoc($query_run)) {
                                  $n++;
                                ?>
                                    <tr>
                                      <form></form>
                                      <td><?php echo $n; ?></td>
                                      <td><?php $in = $row['invoiceNo']; echo "#$in"; ?></td>
                                      <td><?php echo $row['orderCustName']; ?></td>
                                      <td><?php echo $row['userName']; ?></td>
                                      <td>
                                        <?php
                                          $id = $row["orderId"];
                                          $query_tt = "SELECT sum(quantity) FROM orderitem WHERE orderId=$id";
                                          $query_tt_run = mysqli_query($connection, $query_tt);
                                          while ($row_tt = mysqli_fetch_assoc($query_tt_run)){
                                            echo $row_tt["sum(quantity)"];
                                          }
                                        ?>
                                      </td>
                                      <td>RM <?php echo number_format($row['sales'],2); ?></td>
                                      <td><?php echo $row['orderDateTime']; ?></td>
                                      <td>
                                        <?php
                                            if($row['orderStatus'] == 'Completed'){
                                              ?>
                                                  <span class="badge badge-success">Completed</span>
                                              <?php
                                            }else if($row['orderStatus'] == 'Pending'){
                                              ?>
                                                  <span class="badge badge-warning">Pending</span>
                                              <?php
                                            }else if($row['orderStatus'] == 'Cancelled'){
                                              ?>
                                                  <span class="badge badge-danger">Cancelled</span>
                                              <?php
                                            }
                                        ?>
                                      </td>
                                      <td style="text-align:center;">
                                        <form action="code.php" method="post">
                                          <div class="btn">
                                            <a href="../orders/print.php?id=<?php echo $row["orderId"];?>" name="printBtn" class="btn btn-secondary" data-toggle="tooltip" title="Print <?php echo "#$in"; ?>"><i class="fa fa-print" style="font-size:14px;"></i></a>
                                            <input type="hidden" name="edit_id" value="<?php echo $row['orderId']; ?>">
                                            <button type="submit" name="editBtn" class="btn btn-primary" data-toggle="tooltip" title="Edit <?php echo "#$in"; ?>"><i class="fa fa-pencil-alt" style="font-size:14px;"></i></button>
                                            <a href="../orders/detail.php?id=<?php echo $row["orderId"];?>" name="viewBtn" class="btn btn-info" data-toggle="tooltip" title="View <?php echo "#$in"; ?>"><i class="fa fa-eye" style="font-size:14px;"></i></a>                    
                                            <!--<input type="hidden" name="delete_id" value="<?php echo $row['orderId']; ?>">
                                            <a href="#deleteModal" class="btn btn-danger deleteBtn" data-id="<?php echo $row['orderId']; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" data-toggle="tooltip" title="Delete <?php echo "#$in"; ?>"></i></a>-->                          
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
                   <!--<div class="card-footer">
                  <a class="btn btn-secondary" href="../recycle/orders.php"><i class="fa fa-recycle"></i> Cancelled Orders</a>
                </div>-->
                   
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
             </div>
         </section>



</div>
<!-- /.content-wrapper -->


<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>

<script type="text/javascript">
    if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
     $(document).ready(function() {
    $('.multiselect').select2({
      theme: 'bootstrap4'
    });
});   
</script>