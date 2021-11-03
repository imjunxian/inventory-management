<?php
include '../../database/security.php';
$title = "Product";
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
          <h1 class="m-0">View Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="../products/">Products</a></li>
            <li class="breadcrumb-item active">View Product</li>
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
              <h3 class="card-title">View Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php
        

            if (isset($_SESSION['viewid'])) {
              $id = $_SESSION['viewid'];
              $query = "SELECT products.*, brands.brandName FROM products INNER JOIN brands ON brands.brandId = products.brandId WHERE products.productId=$id";
              $query_run = mysqli_query($connection, $query);

              foreach ($query_run as $row) {

            ?>
                <form action="code.php" id="editForm" method="post" enctype="multipart/form-data">
                  <div class="card-body">

                    <input type="hidden" class="form-control" id="prodid" value="<?php echo $row['productId'] ?>" placeholder="id" name="prodid">

                     <div class="form-group">
                              <label>Image Preview: </label>
                              <?php  
                                  if($row["productImage"] == ""){
                                    ?>
                                      <img class="rounded-circle" src="../../dist/img/prodDefault.png" height="130px;" width="130px;" alt="image">
                                    <?php
                                  }else{
                                    echo '<img src="../../dist/img/productImage/'.$row['productImage'].'" width="130" height="130" class="img-circle" alt="image" />';
                                  }
                                              
                              ?>
                      </div>

                      <hr>
                      <p class="h6">Product Details :</p><br>

                      <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <tr>
                              <th width="40%"><i class="fa fa-"></i> Product SKU :</th>
                              <td><?php echo $row['productSKU'] ?></td>
                            </tr>
                            <tr>
                              <th width="40%"><i class="fa fa-"></i> Product Name : </th>
                              <td><?php echo $row['productName'] ?></td>
                            </tr>
                            <tr>
                              <th width="40%"><i class="fa fa-"></i> Product Quantity : </th>
                              <td>
                                <?php echo $row['productQuantity']?>&nbsp;&nbsp;
                                <?php
                                  if($row['productQuantity'] == '1' && $row['productQuantity'] > '0'){
                                    ?>
                                    <span class="badge badge-warning">LowStock</span>
                                    <?php
                                  }else if($row['productQuantity'] == '0'){
                                    ?>
                                    <span class="badge badge-danger">StockOut</span>
                                    <?php
                                  }
                                ?>
                              </td>
                            </tr>
                            <tr>
                              <th width="40%"><i class="fa fa-"></i> Product Price : </th>
                              <td>RM <?php echo number_format($row['productPrice'],2); ?></td>
                            </tr>
                            <tr>
                              <th width="40%"><i class="fa fa-"></i> Product Cost : </th>
                              <td>RM <?php echo number_format($row['productCost'],2); ?></td>
                            </tr>
                            <tr>
                              <th width="40%"><i class="fa fa-"></i> Product Description : </th>
                              <td><p class="text-justify"><?php echo ($row['productDescription'] != "") ? $row['productDescription'] : "No Description"; ?></p></td>
                            </tr>
                        </table>
                      </div>

                <!--<div class="form-group">
                  <label for="name">Product SKU :</label>
                  <br><span class="h5 text-dark"><b><?php echo $row['productSKU']?></b></span>
                </div>

                <div class="form-group">
                  <label for="name">Product Name : </label>
                  <br><span class="h5 text-dark"><b><?php echo $row['productName']?></b></span>
                </div>

                <div class="form-group">
                  <label for="contact">Product Quantity : </label>
                  <br><span class="h5 text-dark"><b>
                    <?php echo $row['productQuantity']?>&nbsp;&nbsp;
                      <?php
                        if($row['productQuantity'] == '1' && $row['productQuantity'] > '0'){
                          ?>
                          <span class="badge badge-warning">LowStock</span>
                          <?php
                        }else if($row['productQuantity'] == '0'){
                          ?>
                          <span class="badge badge-danger">StockOut</span>
                          <?php
                        }
                      ?>
                    </b></span>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Cost : </label>
                      <br><span class="h5 text-dark"><b>RM <?php echo number_format($row['productCost'],2); ?></b></span>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Price :</label>
                      <br><span class="h5 text-dark"><b>RM <?php echo number_format($row['productPrice'],2); ?></b></span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="description">Product Description : </label>
                   <br><span class="h6 text-dark text-justify"><b>
                    <?php 
                    if($row['productDescription'] == ''){
                      echo 'No Description...  :( ';
                    }else{
                      echo $row['productDescription'];        
                    }
                    ?>
                      
                    </b></span>
                </div>-->
                 <hr>
                      <p class="h6">Product Specifications :</p><br>
                
                 <div class="row">
                  <div class="col-sm-6">
                       <div class="form-group">
                        <label>Brand</label>
                        <select class="form-control multiselect " name="brand" disabled>
                          <option value="<?php echo $row['brandName']?>"><?php echo $row['brandName']?></option>
                          <?php
                           $records = mysqli_query($connection, "SELECT * From brands WHERE status ='Active'");
                              while($data = mysqli_fetch_array($records)){
                                  echo "<option value='". $data["brandId"] ."'>" .$data['brandName'] ."</option>";
                              }
                          ?>
                        </select>
                      </div>
                  </div>

                  <div class="col-sm-6">
                      <div class="form-group">
                        <label>Category</label>
                        <?php 
                        $category_data = json_decode($row['categoryId']); 
                        ?>
                        <select class="form-control multiselect" multiple="multiple" name="category[]" value="" disabled>                  
                            <?php 
                            $records = mysqli_query($connection, "SELECT * From category WHERE categoryStatus ='Active'");
                            foreach ($records as $k => $v): 
                              ?>
                              <option value="<?php echo $v['categoryId'] ?>" <?php if(in_array($v['categoryId'], $category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['categoryName'] ?></option>
                            <?php endforeach ?>
                        </select>
                      </div>      
                </div>
              </div>

                <?php
                $record_att = mysqli_query($connection, "SELECT * From attributes WHERE status ='Active'");
                foreach($record_att as $attdata => $data_att){
                    ?>
                     <div class="form-group">
                      <label><?php echo $data_att['attributeName']?></label>
                       <?php 
                        $attdata = json_decode($row['attvalueId']); 
                        ?>
                      <select class="form-control multiselect" multiple="multiple" name="attvalue[]" disabled>
                        <?php
                         $record_attv = mysqli_query($connection, "SELECT * From attributes_value WHERE status ='Active' AND parentId='".$data_att['attributeId']."'");
                            foreach($record_attv as $k => $v){
                              ?>
                               <option value="<?php echo $v['attvalueId'] ?>" <?php if(in_array($v['attvalueId'], $attdata)) { echo 'selected="selected"'; } ?>><?php echo $v['attvalueName'] ?></option>
                              <?php  
                            }
                        ?>
                      </select>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                  <label>Supplier</label>
                  <?php 
                    $spdata = json_decode($row['supplierId']); 
                  ?>
                  <select class="form-control multiselect" multiple="multiple" name="supplier[]" disabled>
                    <?php
                     $records = mysqli_query($connection, "SELECT * From suppliers WHERE supplierStatus ='Active'");
                        foreach ($records as $k => $v): 
                            ?>
                            <option value="<?php echo $v['supplierId'] ?>" <?php if(in_array($v['supplierId'], $spdata)) { echo 'selected="selected"'; } ?>><?php echo $v['supplierName'] ?></option>
                      <?php endforeach ?>
                    ?>
                  </select>
                </div>

                <hr>
                      <p class="h6">Product Availability :</p><br>

                 <!--<div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Availability :</label>
                      <br><span class="h5 text-dark"><b><?php echo $row['availability']?></b></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Status : </label>
                      <br><span class="h5 text-dark"><b><?php echo $row['status']?></b></span>
                    </div>
                  </div>
                </div>-->

                <div class="table-responsive">
                        <table id="table" class="table table-hover">
                            <tr>
                              <th width="40%"><i class="fa fa-"></i> Availability:</th>
                              <td><?php echo $row['availability'] ?></td>
                            </tr>
                            <tr>
                              <th width="40%"><i class="fa fa-"></i> Status :</th>
                              <td><?php echo $row['status'] ?></td>
                            </tr>
                        </table>
                      </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="javascript:history.go(-1)" class="btn btn-secondary">Back</a>
                <!--<button type="submit" class="btn btn-secondary">Cancel</button>-->
                <?php
                  if($_SESSION["user_role"] == "SuperUser" || $_SESSION["user_role"] == "Admin"){
                    ?>
                      <input type="hidden" name="edit_id" value="<?php echo $row['productId']; ?>">
                    <button type="submit" name="editBtn" class="btn btn-primary">Edit <i class="fa fa-pencil-alt" style="font-size:14px;"></i></button>
                    <?php
                  }elseif($_SESSION["user_role"] == "Staff"){
                    ?>
                     
                    <?php
                  }
                ?>
              </div>
            </form>

                    
            <?php
              }   
              unset($_SESSION['viewid']);
            }elseif(!isset($_SESSION['viewid'])){
              ?>
              <!--<br>
                <p class="text-justify text-center">
                  User Not Found! <br>
                  You may <a href="../users/">CLICK HERE</a> to return.
                </p>
              <br>-->
              <script> location.replace("../products/index.php?idnotfound"); </script>
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
 
 
</div>
<!-- /.content-wrapper -->


<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>



<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

</script>

<script>
  $(document).ready(function() {
    $('.multiselect').select2({
      theme: 'bootstrap4'
    });
});   
</script>


