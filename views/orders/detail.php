<?php
include('../../database/security.php');
$title = "Order";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<?php
  if(isset($_GET["id"])){
    $oids = $_GET["id"];

    $query_oid = "SELECT * FROM orders WHERE orderId=$oids";
    $query_oid_run = mysqli_query($connection, $query_oid);

    if(mysqli_num_rows($query_oid_run) > 0){
      while($row = mysqli_fetch_assoc($query_oid_run)){
      ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Invoice</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item"><a href="../orders/">Orders</a></li>
                <li class="breadcrumb-item active">Invoice</li>
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
                    <div class="card-body">
                      <a href="javascript:history.go(-1)" class="btn btn-secondary">Back</a>
                      <a href="../orders/print.php?id=<?php echo $row["orderId"];?>" class="btn btn-dark"><i class="fa fa-print"></i> Print</a>
                      <a href="../orders/code.php?id=<?php echo $row['orderId']; ?>" name="ed" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> Edit</a>
                    </div>
                  </div>
              </div>   
           </div>
       <!-- title row --> 
          <div class="row"> 
              <div class="col-md-12">
                  <!-- general form elements -->
                     <form action="code.php" id="addF" method="POST">
                        <div class="invoice p-3 mb-3">
                        <!-- title row -->
                         <?php
                              $query = "SELECT * FROM company";
                              $query_run = mysqli_query($connection, $query);

                              foreach ($query_run as $row_c){
                          ?>
                                <div class="row">
                                  <div class="col-lg-9 col-md-9 col-sm-9">

                                    <h4>
                                      Purchasing Invoice <br>
                                      <small style="font-size:18px;">DateTime: <?php echo $row["orderDateTime"];?></small>
                                    </h4><br>
                                  </div>
                                  <!-- /.col -->

                                  <div class="col-lg-3 col-md-3 col-sm-12">
                                     <?php
                                      $billId = $row["invoiceNo"];
                                      //echo "Bill No : <b style=\"font-size:18px;\">#$billId</b>";
                                        ?>
                                        <h5>Invoice No : </h5>
                                        <small style="font-size:16px;"><b style="font-size:16px;"><?php echo "#$billId"; ?></b></small>
                                        <?php
                                      ?>
                                      <input type="hidden" class="form-control" name="invid" id="invid" placeholder="Invoice ID" autocomplete="off" value="<?php echo $billId; ?>" required>
                                        </div>
                                </div>
                                <!-- info row -->


                                <div class="row invoice-info">
                                  <div class="col-sm-9 invoice-col">
                                    <br>

                                    <address >
                                      <h5><?php echo $row_c['companyName']?></h5>
                                      <font class="font-italic"><?php echo $row_c['address1']?>,<br>
                                      <?php echo $row_c['address2']?>,<br>
                                      <?php echo $row_c['postcode']?> <?php echo $row_c['city']?>,<br>
                                      <?php echo $row_c['state']?>, <?php echo $row_c['country']?><br></font>
                                      <b>Tel</b>: <?php echo $row_c['contact']?><br>
                                      <b>Email</b>: <?php echo $row_c['email']?><br>
                                      <?php
                                        $salespersonId = $row['salesperson'];
                                        $query_sales = "SELECT * FROM users WHERE userId = $salespersonId";
                                        $query_sales_run = mysqli_query($connection, $query_sales);
                                        foreach ($query_sales_run as $row_sales){
                                        ?>
                                          <b>SalesPerson</b>: <?php echo $row_sales['userName']?>
                                        <?php
                                        }
                                      ?>
                                    </address>
                                  </div>
                                  <!-- /.col -->
                           <?php
                              }
                          ?>

                          <div class="col-sm-3 invoice-col pull-right">
                            <br>
                            <h5>Customer Details:</h5>
                              <span class="h6"><b>Name: </b></span><br>
                              <font class="font-italic"><?php echo $row['orderCustName']?></font><br>
                              <span class="h6"><b>Contact: </b></span><br>
                              <font class="font-italic"><?php echo $row['orderCustContact']?></font><br>
                              <span class="h6"><b>Email: </b></span><br>
                              <font class="font-italic"><?php echo $row['orderCustEmail']?></font><br>
                          </div>

                        </div>
                        <!-- /.row -->
                 

                        <br>
                            <!-- Table row -->
                            <div class="row">
                            <?php
                            $query_tb = "SELECT orderitem.*, products.* FROM orderitem INNER JOIN products ON products.productId = orderitem.productId WHERE orderitem.orderId=$oids";
                            $query_tb_run = mysqli_query($connection, $query_tb);
                            ?>
                              <div class="col-12 table-responsive">
                                <table class="table table-striped table-hover">
                                  <thead>
                                  <tr>
                                    <th width="50%">Products</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                    if(mysqli_num_rows($query_tb_run) > 0){
                                      while($row_tb = mysqli_fetch_assoc($query_tb_run)){
                                      ?>  
                                        <tr>
                                          <td><?php $sku=$row_tb["productSKU"]; $name=$row_tb["productName"]; echo  "$sku - $name";?></td>
                                          <td><?php echo $row_tb["quantity"];?></td>
                                          <td><?php $pri = number_format($row_tb['unitAmount'],2); echo "RM $pri";?></td>
                                          <td><?php $sum = number_format($row_tb['sumAmount'],2); echo "RM $sum";?></td>
                                        </tr>
                                      <?php
                                      }
                                    }
                                  ?>
                                  </tbody>
                                </table>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                            <br>
                            <div class="row">
                              <!-- accepted payments column -->
                              <div class="col-lg-5 col-md-5 col-xs-12" style="margin-top:1%;">
                                  <p class=""><b>Notes:</b></p>
                                  <div class="form-group">
                                    <textarea class="form-control" placeholder="Noted Here" rows=6 name="orderNote" disabled=""><?php echo $row["orderNote"]; ?></textarea>
                                  </div>
                                </div>

                                <div class="col-lg-1 col-md-1 col-xs-0" style="margin-top:1%;">
                                  
                                </div>
                              <!-- /.col -->
                              <div class="col-6">
                                <p class="lead"></p>

                                <div class="table-responsive">
                                  <table class="table">
                                    <tr>
                                      <th style="width:50%">Subtotal :</th>
                                      <td>RM <?php echo number_format($row["subtotal"],2); ?></td>
                                    </tr>
                                    <tr>
                                      <th>Discount :</th>
                                      <td>RM <?php echo number_format($row["discount"],2); ?></td>
                                    </tr>
                                    <tr>
                                      <th>Payment Method :</th>
                                      <td><?php echo $row["method"]?></td>
                                    </tr>
                                    <tr>
                                      <th>Status :</th>
                                      <td>
                                        <?php
                                            if($row['orderStatus'] == 'Completed'){
                                              ?>
                                                  <span class="badge badge-success" style="font-size:14px;">Completed</span>
                                              <?php
                                            }else if($row['orderStatus'] == 'Pending'){
                                              ?>
                                                  <span class="badge badge-warning" style="font-size:14px;">Pending</span>
                                              <?php
                                            }else if($row['orderStatus'] == 'Cancelled'){
                                              ?>
                                                  <span class="badge badge-danger" style="font-size:14px;">Cancelled</span>
                                              <?php
                                            }
                                        ?>
                                      </td>
                                    </tr>
                                    <tr class="h5">
                                      <th>Total :</th>
                                      <td><b>RM <?php echo number_format($row["sales"],2); ?><b></td>
                                    </tr>
                                  </table>
                                </div>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->

                        </div>
                        <!-- /.invoice -->

                    </form>

           
              </div>
          </div>    

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

</div>
<!-- /.content-wrapper -->


      <?php
      } // end while
    } /* end if */ else{
        ?>          
        <script> location.replace("../orders/index.php?idnotfound"); </script>
        <?php
    } // end else
  } //end if GET
?>

<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>


