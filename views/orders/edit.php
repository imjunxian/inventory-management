<?php
include('../../database/security.php');
$title = "Order";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!--Add Toggles-->
<div class="modal fade" id="addForm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Customer</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" id="addCustForm" method="post">
        <div class="modal-body">
          <div class="form-group">
            <label> Name </label>
            <input type="text" class="form-control" placeholder="Name" name="custName" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="custEmail">
          </div>

          <div class="form-group">
            <label for="contact">Contact</label>
            <input type="text" class="form-control" id="phone" placeholder="Phone Number" name="custContact">
          </div>

          <div class="form-group">
            <label for="exampleInputFile">Gender</label>
            <div class="form-group clearfix">
              <div class="icheck-primary d-inline">
                <input type="radio" id="radioPrimary1" name="gender" class="male" value="Male">
                <label for="radioPrimary1">
                  Male
                </label>
              </div>
              <div class="icheck-primary d-inline">
                <input type="radio" id="radioPrimary2" name="gender" class="female" value="Female">
                <label for="radioPrimary2">
                  Female
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
      </form>
      <!--Form end-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
  if(isset($_SESSION["editid"])){
    $oids = $_SESSION["editid"];

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
                <h1 class="m-0">Edit Invoice</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item"><a href="../orders/">Orders</a></li>
                <li class="breadcrumb-item active">Edit Invoice</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

       <!-- title row --> 
          <div class="row"> 
              <div class="col-md-12">
                  <!-- general form elements -->
                     <form action="code.php" id="addF" method="POST">
                      <div class="card card-default">
                    <div class="card-header">
                      <h3 class="card-title">Edit Purchasing Order</h3>
                    </div>
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
                    <div class="form-group">
                        <select class="custSelectadd"  name="orderCustName" onchange="contact(event)" id="orderCustName" style="width:100%;" required>
                          <option value="<?php echo $row["orderCustName"];?>" selected><?php echo $row["orderCustName"];?></option>
                          <?php
                           $records = mysqli_query($connection, "SELECT * From customers WHERE status='Active'");
                              while($data = mysqli_fetch_array($records)){
                                  echo "<option value='". $data["customerName"] ."_". $data["customerContact"]."_". $data["customerEmail"]."'>" .$data['customerName'] ."</option>";
                              }
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="orderCustContact" id="orderCustContact" placeholder="Customer Contact" autocomplete="off" value="<?php echo $row["orderCustContact"];?>" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="orderCustEmail" id="orderCustEmail" placeholder="Customer Email" autocomplete="off" value="<?php echo $row["orderCustEmail"];?>" required>
                    </div>
                </div>
                <?php
                  /*$value= $_POST['orderCust'];
                  $explode=explode("_",$value,2);
                  $custID =$explode[0];
                  $custPhNo =$explode[1];*/
                ?>
                <script type="text/javascript">
                  function contact(e){
                    var twoValues = document.getElementById("orderCustName").value;
                    var allValues = twoValues.split("_");
                    var cust_id = allValues[0];
                    var cust_phoNo = allValues[1];
                    var cust_email = allValues[2];
                    document.getElementById('orderCustContact').value = cust_phoNo;
                    document.getElementById('orderCustEmail').value = cust_email;
                  }
                </script>

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
                                <table class="table table-striped table-hover" id="product_info_table">
                                  <thead>
                                  <tr>
                                    <th width="50%">Products</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Amount</th>
                                    <!--<th width="5%"><button class="btn btn-success" id="add_row" type="button"><i class="fa fa-plus"></i></button></th>-->
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php
                                    if(mysqli_num_rows($query_tb_run) > 0){
                                      //$x = 1;
                                      while($row_tb = mysqli_fetch_assoc($query_tb_run)){
                                      ?>  
                                        <!-- <tr id="row_1">
                                            <td>
                                                 <select class="form-control multiselect product" data-row-id="row_1" id="product_1" name="product[]" style="width:100%;" onchange="getProductData(1)" required>
                                                    <option value="<?php $row_tb["productId"] ?>" selected><?php $sku=$row_tb["productSKU"]; $name=$row_tb["productName"]; echo  "$sku - $name";?></option>
                                                    <?php
                                                     $records = mysqli_query($connection, "SELECT * FROM products WHERE availability ='Available' AND productQuantity != '0' AND status='Active' ORDER BY productId DESC");
                                                        while($data = mysqli_fetch_array($records)){
                                                            echo "<option value='". $data["productId"] ."'>".$data['productSKU']." - " .$data['productName'] ."</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </td>
                                            <td><input type="number" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)" min=1 max=99 oninput="validity.valid||(value='');" value="<?php echo $row_tb["quantity"];?>" required></td>
                                            <td>
                                                <input type="text" name="rate[]" id="rate_1" class="form-control" value="<?php $pri = $row_tb['unitAmount']; echo "$pri";?>" disabled autocomplete="off">
                                                <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" value="<?php $pri = $row_tb['unitAmount']; echo "$pri";?>" autocomplete="off">
                                                <input type="hidden" class="form-control" name="ocost[]" id="ocost_1" placeholder="Cost" value="<?php $cos = $row_tb['productCost']; echo "$cos";?>" autocomplete="off">
                                                <input type="hidden" class="form-control" name="oprofit[]" id="oprofit_1" placeholder="Profit" value="<?php $pf = $pri - $cos; echo "$pf";?>" autocomplete="off">
                                            </td>
                                            <td>
                                                <input type="text" name="amount[]" id="amount_1" class="form-control" value="<?php $sum = $row_tb['sumAmount']; echo "$sum";?>" disabled autocomplete="off">
                                                <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" value="<?php $sum = $row_tb['sumAmount']; echo "$sum";?>" autocomplete="off">
                                                 <input type="hidden" class="form-control" name="cost[]" id="cost_1" placeholder="Cost" value="<?php $sumco = $cos * $row_tb["quantity"]; echo "$sumco"; ?>" autocomplete="off">
                                                  <input type="hidden" class="form-control" name="profit[]" id="profit_1" placeholder="Profit" value="<?php $sumpf = $sum - $sumco; echo "$sumpf";?>" autocomplete="off">
                                            </td>
                                            <td><button type="button" class="btn btn-danger" onclick="removeRow('1')"><i class="fa fa-times"></i></button></td>
                                        </tr>-->
                                        <tr>
                                          <td>
                                            <?php $sku=$row_tb["productSKU"]; $name=$row_tb["productName"]; echo  "$sku - $name";?>
                                              <input type="hidden" name="product[]" value="<?php echo $row_tb["productId"]; ?>" id="product_1" onchange="getProductData(1)" class="form-control">
                                            </td>
                                          <td>
                                            <?php echo $row_tb["quantity"];?>
                                            <input type="hidden" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)" min=1 max=99 oninput="validity.valid||(value='');" value="<?php echo $row_tb["quantity"];?>" required>
                                          </td>
                                          <td>
                                            <?php $pri = number_format($row_tb['unitAmount'],2); echo "RM $pri";?>

                                          </td>
                                          <td>
                                            <?php $sum = number_format($row_tb['sumAmount'],2); echo "RM $sum";?>

                                          </td>
                                        </tr>

                                      <?php
                                      //$x++;
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
                                <div class="col-lg-5 col-md-5 col-xs-12" style="margin-top:1%;">
                                  <p class=""><b>Notes:</b></p>
                                  <div class="form-group">
                                    <textarea class="form-control" placeholder="Noted Here" rows=6 name="orderNote"><?php echo $row["orderNote"]; ?></textarea>
                                  </div>
                                </div>

                                <div class="col-lg-1 col-md-1 col-xs-0" style="margin-top:1%;">
                                  
                                </div>

                                <!--<div class="col-md-6 col-xs-12 pull pull-right">-->
                                <div class="col-lg-6 col-md-6 col-xs-12 pull pull-right">
                                  <table class="table">
                                    <th >Subtotal (RM) :</th>
                                          <td>
                                              <div class="form-group">
                                                  <input type="text" class="form-control" name="subtotal" id="subtotal" placeholder="SubTotal" autocomplete="off" value="<?php echo $row["subtotal"]; ?>" disabled>
                                                  <input type="hidden" class="form-control" name="subtotal_value" id="subtotal_value" placeholder="SubTotal" value="<?php echo $row["subtotal"]; ?>" autocomplete="off">
                                                  <input type="hidden" class="form-control" name="subcost_value" id="subcost_value" placeholder="SubCost" value="<?php echo $row["subcost"]; ?>" autocomplete="off">
                                              </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <th>Discount (RM) :</th>
                                          <td>
                                              <div class="form-group">
                                                  <input type="number" class="form-control" name="discount" id="discount" placeholder="Discount" autocomplete="off" min=0 oninput="validity.valid||(value='');" onkeyup="subAmount()" value="<?php echo number_format($row["discount"],2); ?>" disabled>
                                              </div>
                                          </td>
                                        </tr>
                                         <tr>
                                          <th>Payment Method :</th>
                                          <td>
                                              <div class="form-group">
                                                  <select type="option" class="form-control" name="paymentmethod" id="method" placeholder="Status" autocomplete="off">
                                                  <option value="<?php echo $row["method"];?>"><?php echo $row["method"];?></option>  
                                                  <option value="Cash">Cash</option>
                                                  <option value="Card">Card</option>
                                                  <option value="Cheque">Cheque</option>
                                                  <option value="Transfer">Transfer</option>
                                              </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <th>Status :</th>
                                          <td>
                                              <div class="form-group">
                                                  <select type="option" class="form-control" name="orderstatus" id="paidStatus" placeholder="Status" autocomplete="off">
                                                  <option value="<?php echo $row["orderStatus"];?>"><?php echo $row["orderStatus"];?></option>
                                                  <option value="Pending">Pending</option>
                                                  <option value="Completed">Completed</option>
                                                  <option value="Cancelled">Cancelled</option>
                                              </div>
                                              <input type="hidden" name="currentsta" class="form-control" id="currentsta" value="<?php echo $row["orderStatus"];?>">
                                          </td>
                                        </tr>
                                        <tr>
                                          <th>Total (RM) : </th>
                                          <td>
                                               <div class="form-group">
                                                  <input type="text" class="form-control" name="total" id="total" placeholder="Total" autocomplete="off" value="<?php echo $row["sales"]; ?>" disabled="">
                                                   <input type="hidden" class="form-control" name="total_value" id="total_value" placeholder="Total" value="<?php echo $row["sales"]; ?>" autocomplete="off" >
                                                   <input type="hidden" class="form-control" name="profit_value" id="profit_value" placeholder="Profit" value="<?php echo $row["profit"]; ?>" autocomplete="off">
                                              </div>
                                          </td>
                                        </tr>
                                  </table>
                                </div>
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->

                              <div class="card-footer">
                            
                               <a href="javascript:history.go(-1)" class="btn btn-secondary">Cancel</a>
                              <!--<button type="submit" class="btn btn-secondary">Cancel</button>-->
                              <button type="submit" name="editPO_btn" class="btn btn-primary" >Update</button>
                              <!--<button rel="noopener" target="_blank" class="btn btn-dark float-right" onclick="window.print();"><i class="fas fa-print"></i> Print</a>   -->
                        
                          </div>

                        </div>
                        <!-- /.invoice -->

                      </div>
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
    } /* end if */ 
  } elseif(!isset($_SESSION['editid'])){
        ?>          
        <script> location.replace("../orders/index.php?idnotfound"); </script>
        <?php
    } // end else
?>

<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>


<!--Purchasing Orders-->
<script type="text/javascript">
   var base_url = "<?php echo $base; ?>";

    $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#addOrderNav").addClass('active');

    // Add new row in the table
    $("#add_row").unbind('click').bind('click', function() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

      $.ajax({
          url: "ajax.php",
          type: "POST",
          data: {row_id:row_id},
          dataType: "json",
          success:function(response) {

               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+
                    '<select class="form-control multiselect product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value="" disabled selected>-- Select Product --</option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.productId+'">'+value.productSKU+' - '+value.productName+'</option>';
                        });

                      html += '</select>'+
                    '</td>'+
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')" min=1 max=99></td>'+

                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" class="form-control" disabled><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"><input type="hidden" class="form-control" name="ocost[]" id="ocost_'+row_id+'" placeholder="Cost" autocomplete="off"><input type="hidden" class="form-control" name="oprofit[]" id="oprofit_'+row_id+'" placeholder="Profit" autocomplete="off"></td>'+

                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"><input type="hidden" class="form-control" name="cost[]" id="cost_'+row_id+'" placeholder="Cost" autocomplete="off"><input type="hidden" class="form-control" name="profit[]" id="profit_'+row_id+'" placeholder="Profit" autocomplete="off"></td>'+
                    '<td><button type="button" class="btn btn-danger" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-times"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);
                 $('.multiselect').select2({theme: 'bootstrap4',});
                }
                else {
                  $("#product_info_table tbody").html(html);
                  $('.multiselect').select2({theme: 'bootstrap4',});
                }
          }
        });
      return false;
    });

  }); // /document


  function getTotal(row = null) {
    if(row) {
      var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      total = total.toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);

      var cost = Number($("#ocost_"+row).val()) * Number($("#qty_"+row).val());
      var profit = Number($("#oprofit_"+row).val()) * Number($("#qty_"+row).val());
      cost = cost.toFixed(2);
      profit = profit.toFixed(2);
      $("#cost_"+row).val(cost);
      $("#profit_"+row).val(profit);

      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }


////////
  // get the product information from the server
  function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();
    if(product_id == "") {
      $("#rate_"+row_id).val("");
      $("#rate_value_"+row_id).val("");

      $("#qty_"+row_id).val("");

      $("#amount_"+row_id).val("");
      $("#amount_value_"+row_id).val("");
      
    } else {
      $.ajax({
        url: 'ajax.php',
        type: 'POST',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field

          var price = response.productPrice;
          var cost  = response.productCost; 
          $("#rate_"+row_id).val(price);
          $("#rate_value_"+row_id).val(price);

          //quantity
          $("#qty_"+row_id).val(1);
          $("#qty_value_"+row_id).val(1);

          //amount
          var total = Number(price) * 1;
          total = total.toFixed(2);
          $("#amount_"+row_id).val(total);
          $("#amount_value_"+row_id).val(total);

          //cost
          var co = Number(cost) * 1;
          co = co.toFixed(2);
          $("#ocost_"+row_id).val(co);
          $("#cost_"+row_id).val(co);

          //profit 
          var pro = total - co;
          pro = pro.toFixed(2);
          $("#oprofit_"+row_id).val(pro);
          $("#profit_"+row_id).val(pro);

          subAmount();
        } // /success
      }); // /ajax function to fetch the product data
    }
  }
//////


  function subAmount() {
  
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var totalSubCo = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
      totalSubCo = Number(totalSubCo) + Number($("#cost_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);
    totalSubCo = totalSubCo.toFixed(2);

    // sub total
    $("#subtotal").val(totalSubAmount);
    $("#subtotal_value").val(totalSubAmount);

    //sub cost (sum of all product cost)
    $("#subcost_value").val(totalSubCo);

    // total amount
    var totalAmount = Number(totalSubAmount);
    totalAmount = totalAmount.toFixed(2);

    //discount
    var discount = $("#discount").val();
    if(discount != "" || discount != 0) {
      var grandTotal = Number(totalAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#total").val(grandTotal);
      $("#total_value").val(grandTotal);

      //total profit with discount (insert to database)
      var profit = grandTotal - totalSubCo;
      profit = profit.toFixed(2);
      $("#profit_value").val(profit);

    } else {
      $("#total").val(totalAmount);
      $("#total_value").val(totalAmount);

      //total profit without discount (insert to database)
      var profit = totalAmount - totalSubCo;
      profit = profit.toFixed(2);
      $("#profit_value").val(profit);

    } // /else discount


  } // /sub total amount

  //remove row 
  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove(); 
    subAmount();
  }

</script>

<!--Validations-->
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

    $.validator.addMethod("lesserThan",
    function (value, element, param) {
          var $otherElement = $(param);
          return parseInt(value, 10) <= parseInt($otherElement.val(), 10) || parseFloat(value, 10) <= parseFloat($otherElement.val(), 10);
    });

    //Add Order Form
    $('#addF').validate({
      rules: {
        orderCustName: {
          required: true,
        },
        orderCustContact: {
          required: true,
          minlength: 10,
          digits: true
        },
        orderCustEmail: {
          required: true,
          email: true,
          regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
        },
        discount: {
          required: false,
          lesserThan: "#subtotal_value",
        },
      },
      messages: {
        orderCustName: {
          required: "Please select customer name",
        },
        orderCustContact: {
          required: "Please select customer phone number",
          minlength: "Please select valid phone number eg. 0123456789"
        },
        orderCustEmail: {
          required: "Please select customer email",
          email: "Please select a vaild email",
          regex: "Please select a valid email"
        },
        discount: {
          lesserThan: "Discount must less than or equal Subtotal",
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

    //Add Customer Form
    $('#addCustForm').validate({
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

  $(document).ready(function() {
    /*$('.multiselectadd').select2({theme: 'bootstrap4'}).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="../products/add.php" style="padding: 6px;height: 20px;display: inline-table;">Add Product</a>');
    });*/
    $('.custSelectadd').select2({theme: 'bootstrap4'}).on('select2:open', () => {
        $(".select2-results:not(:has(a))").append('<a href="#" data-toggle="modal" data-target="#addForm" style="padding: 10px;height: 20px;display: inline-table;"> <i class="fa fa-plus"></i> Add New Customer</a>');
    });
});

</script>
<script>
  $(document).ready(function() {
    $('.multiselect').select2({
      theme: 'bootstrap4',
      
    });

  });

</script>

