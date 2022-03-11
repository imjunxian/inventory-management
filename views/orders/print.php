<?php
include('../../database/security.php');
$title = "Order";
include('../../includes/header.php');

?>

<?php
  if(isset($_GET["id"])){
    $oids = $_GET["id"];

    $query_oid = "SELECT * FROM orders WHERE orderId=$oids";
    $query_oid_run = mysqli_query($connection, $query_oid);

    if(mysqli_num_rows($query_oid_run) > 0){
      while($row = mysqli_fetch_assoc($query_oid_run)){
      ?>


<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">

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

                          <div class="media row">
                              <div class="col-12 col-sm-12 col-xl-12">
                                <img src="../../dist/img/tabLogo.ico" alt="INV" class="brand-image img-circle mb-1 mb-sm-0" style="opacity: .8;" height="50" width="50"/>&emsp;
                                <span class="brand-text font-weight-bold" style="font-size:28px;margin-top: 1%;">Inventory</span>
                              </div>
                            </div>
                                <hr>
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
                              <div class="col-6">
                                
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
                                        <?php echo $row["orderStatus"]?>
                                      </td>
                                    </tr>
                                    <tr class="h5">
                                      <th>Total :</th>
                                      <td><b>RM <?php echo number_format($row["sales"],2); ?></b></td>
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

</section>
</div>

</div>

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

?>
<!-- /.content-wrapper -->
<script type="text/javascript">
  window.addEventListener("load", window.print());
</script>

