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
                <h1 class="m-0">Cancelled Orders</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Cancelled Orders</li>
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
                  <form action="">
                    <div class="card-header">
                      <h2 class="card-title">Cancelled Order Records</h2>
                    
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="table-responsive">
                        <?php
                          $sta = "Cancelled";
                          $query = "SELECT orders.*, users.userName FROM orders INNER JOIN users ON users.userId = orders.salesperson WHERE orderStatus='$sta' ORDER BY orderId DESC";
                          $query_run = mysqli_query($connection, $query);
                        ?>

                        <table id="dataTable" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th width="10px;">No</th>
                              <th>#Invoice No</th>
                              <th>Name</th>
                              <th>SalesPerson</th>
                              <th>Total Products</th>
                              <th>Total Amount(RM)</th>
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
                                      <td><?php echo number_format($row['sales'],2); ?></td>
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
                                            <input type="hidden" name="recover_id" value="<?php echo $row['orderId']; ?>">
                                            <button type="submit" name="recoverBtn" class="btn btn-primary" data-toggle="tooltip" title="Recover <?php echo "#$in"; ?>"><i class="fa fa-undo" style="font-size:14px;"></i></button>
                                            <a href="../orders/detail.php?id=<?php echo $row["orderId"];?>" name="viewBtn" class="btn btn-info" data-toggle="tooltip" title="View <?php echo "#$in"; ?>"><i class="fa fa-eye" style="font-size:14px;"></i></a> 
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
                    <a class="btn btn-secondary" href="../orders/"><i class="fa fa-check-circle"></i> Orders</a>
                  </div>
                   
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

 $(function() {

    $('#statusForm').validate({
      rules: {
        status: {
          required: true,
        },

      },
      messages: {
        status: {
          required: "Order Status is required.",
        },
       
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.input-group').append(error);
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