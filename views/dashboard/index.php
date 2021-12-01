<?php
include '../../database/security.php';
$title = "Dashboard";
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
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->


<!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
        <?php
          if (isset($_SESSION['welcome']) && $_SESSION['welcome'] != '') {
            echo '
                <div class="alert alert-success alert-dismissible welcome" id="success-alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <p class="h5"><i class="fa fa-check-circle"></i> ' . $_SESSION['welcome'] . '</p>
                </div>
                ';
            unset($_SESSION['welcome']);
          }
        ?>
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <?php
              $query = "SELECT customerId FROM customers WHERE status='Active' ORDER BY customerId";
              $query_run = mysqli_query($connection, $query);

              $row = mysqli_num_rows($query_run);
              echo "<h3>$row</h3>";
              ?>
              <p>Total Customers</p>
            </div>
            <div class="icon">
              <i class="fas fa-users"></i>
            </div>
            <a href="../customers/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <?php
              $query = "SELECT productId FROM products WHERE status='Active' ORDER BY productId";
              $query_run = mysqli_query($connection, $query);

              $row = mysqli_num_rows($query_run);
              echo "<h3>$row</h3>";
              ?>
              <p>Total Products</p>
            </div>
            <div class="icon">
              <i class="fa fa-box"></i>
            </div>
            <a href="../products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <?php
              $query = "SELECT orderId FROM orders WHERE orderStatus='Completed' ORDER BY orderId";
              $query_run = mysqli_query($connection, $query);

              $row = mysqli_num_rows($query_run);
              echo "<h3>$row</h3>";
              ?>
              <p>Completed Orders</p>
            </div>
            <div class="icon">
              <i class="fa fa-shopping-bag"></i>
            </div>
            <a href="../orders/index.php?status=Completed" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <?php
              $query = "SELECT orderId FROM orders WHERE orderStatus='Pending' ORDER BY orderId";
              $query_run = mysqli_query($connection, $query);

              $row = mysqli_num_rows($query_run);
              echo "<h3>$row</h3>";
              ?>
              <p>Pending Orders</p>
            </div>
            <div class="icon">
              <i class="far fa-clock"></i>
            </div>
            <a href="../orders/index.php?status=Pending" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

       <div class="row">

        <div class="col-md-3">
          <!-- Info Boxes Style 2 -->
          <div class="info-box mb-3 bg-info">
            <span class="info-box-icon"><i class="fas fa-sync-alt"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Backup on :</span>
              <?php

              $query = "SELECT * FROM backup ORDER BY dateTime DESC LIMIT 1";
              $query_run = mysqli_query($connection, $query);

              if(mysqli_num_rows($query_run)> 0){
                while($row = mysqli_fetch_assoc($query_run)){
                  echo "<span class=\"info-box-number\" style=\"font-size:14px\">".$row['dateTime']."</span>";
                }
              }else{
                echo "<span class=\"info-box-number\" style=\"font-size:14px\">No Backup</span>";
              }
              ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>


        <div class="col-md-3">
          <div class="info-box mb-3 bg-success">
            <span class="info-box-icon"><i class="ion ion-bag"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Completed Orders</span>
              <?php
              $odate = date('d M Y');
              $query = "SELECT orderId FROM orders WHERE orderStatus='Completed' AND orderDate = '$odate' ORDER BY orderId";
              $query_run = mysqli_query($connection, $query);
          
              $row = mysqli_num_rows($query_run);
              echo "<span class=\"info-box-number\"> $row </span>";
              ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3">
          <div class="info-box mb-3 bg-warning">
            <span class="info-box-icon"><i class="fa fa-spinner"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Today Pending Orders</span>
              <?php

              $odate = date('d M Y');
              $query = "SELECT orderId FROM orders WHERE orderStatus='Pending' AND orderDate = '$odate' ORDER BY orderId";
              $query_run = mysqli_query($connection, $query);

              $row = mysqli_num_rows($query_run);
              echo "<span class=\"info-box-number\"> $row </span>";
              ?>

            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

        <div class="col-md-3">
          <div class="info-box mb-3 bg-danger">
            <span class="info-box-icon"><i class="fa fa-ban"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cancelled Orders</span>
              <?php

              $query = "SELECT orderId FROM orders WHERE orderStatus='Cancelled' ORDER BY orderId";
              $query_run = mysqli_query($connection, $query);

              $row = mysqli_num_rows($query_run);
              echo "<span class=\"info-box-number\"> $row </span>";
              ?>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>

    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <!--<p class="h4">Welcome Back, <?php echo $_SESSION['user_name']?></p>-->
            <br>
          </div>
        </div>
      </div>
    </div>

      <!--Table-->
      <div class="row">
        <div class="col-md-8">
          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                 <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="<?php echo $base."orders/"; ?>" class="dropdown-item">View Orders</a>
                    </div>
                  </div>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <?php
                  $query_or = "SELECT * FROM orders ORDER BY orderId DESC LIMIT 5";
                  $query_or_run = mysqli_query($connection,$query_or);

                ?>
                      <table class="table m-0 table-striped">
                        <thead>
                          <tr>
                            <th>#Invoice No.</th>
                            <th>OrderDateTime</th>
                            <th>Customer</th>
                            <th>Status</th>
                            <th><i class="fa fa-cog"></i> Actions</th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php
                          if (mysqli_num_rows($query_or_run) > 0) {
                            while ($row = mysqli_fetch_assoc($query_or_run)) {
                            ?>
                            <tr>
                              <?php $in = $row['invoiceNo']; ?>
                              <td><?php echo "#$in"; ?> </td>
                              <td><?php echo $row['orderDateTime']; ?> </td>
                              <td><?php echo $row['orderCustName']; ?></td>
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
                                  }
                                ?>
                              </td>
                              <td>
                                <a href="../orders/detail.php?id=<?php echo $row['orderId']; ?>" name="vi" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                <a href="../orders/code.php?id=<?php echo $row['orderId']; ?>" name="ed" class="btn btn-primary"><i class="fa fa-pencil-alt"></i></a>
                              </td>
                            </tr>

                            <?php
                            }
                          }else{
                            ?>
                            <tr>
                              <td align="center" colspan="5">
                                <br>
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 93 87" style="width: 120px;"><defs><rect id="defaultpage_nodata-a" width="45" height="33" x="44" y="32" rx="2"></rect><mask id="defaultpage_nodata-b" width="45" height="33" x="0" y="0" fill="#fff" maskContentUnits="userSpaceOnUse" maskUnits="objectBoundingBox"><use xlink:href="#defaultpage_nodata-a"></use></mask></defs><g fill="none" fill-rule="evenodd" transform="translate(-3 -4)"><rect width="96" height="96"></rect><ellipse cx="48" cy="85" fill="#F2F2F2" rx="45" ry="6"></ellipse><path fill="#FFF" stroke="#D8D8D8" d="M79.5,17.4859192 L66.6370555,5.5 L17,5.5 C16.1715729,5.5 15.5,6.17157288 15.5,7 L15.5,83 C15.5,83.8284271 16.1715729,84.5 17,84.5 L78,84.5 C78.8284271,84.5 79.5,83.8284271 79.5,83 L79.5,17.4859192 Z"></path><path fill="#DBDBDB" fill-rule="nonzero" d="M66,6 L67.1293476,6 L67.1293476,16.4294956 C67.1293476,17.1939227 67.7192448,17.8136134 68.4469198,17.8136134 L79,17.8136134 L79,19 L68.4469198,19 C67.0955233,19 66,17.849146 66,16.4294956 L66,6 Z"></path><g fill="#D8D8D8" transform="translate(83 4)"><circle cx="7.8" cy="10.28" r="3" opacity=".5"></circle><circle cx="2" cy="3" r="2" opacity=".3"></circle><path fill-rule="nonzero" d="M10.5,1 C9.67157288,1 9,1.67157288 9,2.5 C9,3.32842712 9.67157288,4 10.5,4 C11.3284271,4 12,3.32842712 12,2.5 C12,1.67157288 11.3284271,1 10.5,1 Z M10.5,7.10542736e-15 C11.8807119,7.10542736e-15 13,1.11928813 13,2.5 C13,3.88071187 11.8807119,5 10.5,5 C9.11928813,5 8,3.88071187 8,2.5 C8,1.11928813 9.11928813,7.10542736e-15 10.5,7.10542736e-15 Z" opacity=".3"></path></g><path fill="#FAFAFA" d="M67.1963269,6.66851903 L67.1963269,16.32 C67.2587277,17.3157422 67.675592,17.8136134 68.4469198,17.8136134 C69.2182476,17.8136134 72.735941,17.8136134 79,17.8136134 L67.1963269,6.66851903 Z"></path><use fill="#FFF" stroke="#D8D8D8" stroke-dasharray="3" stroke-width="2" mask="url(#defaultpage_nodata-b)" xlink:href="#defaultpage_nodata-a"></use><rect width="1" height="12" x="54" y="46" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="17" x="62" y="40" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="10" x="70" y="48" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="14" x="78" y="43" fill="#D8D8D8" rx=".5"></rect></g></svg>
                                <p class=" text-center text-secondary">No Data</p>
                              </td>
                            </tr>
                            <?php
                          }
                        ?>

                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="../orders/add.php" class="btn btn-info float-left"><i class="fa fa-plus"></i> New Order </a>
              <a href="../orders/" class="btn btn-info float-right">All Orders</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Latest Added Products</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->

                <div class="card-body p-0">
                  <div class="table-responsive">
                  <ul class="products-list product-list-in-card pl-2 pr-2">
                    <?php
                    $query = "SELECT * FROM products WHERE availability = 'Available' AND status='Active' AND productQuantity!=0 ORDER BY productId DESC LIMIT 4";
                    //$query = "SELECT * FROM products WHERE status='Active' AND productQuantity!=0 ORDER BY addDate DESC LIMIT 4";
                    $query_run = mysqli_query($connection, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                      while ($row = mysqli_fetch_assoc($query_run)) {
                    ?>
                    <li class="item">
                      <div class="product-img">
                        <?php  
                          if($row["productImage"] == ""){
                          ?>
                            <img class="rounded-circle" src="../../dist/img/prodDefault.png" height="100;" width="100;" alt="image">
                          <?php
                          }else{
                            echo '<a href="../../dist/img/productImage/'.$row['productImage'].'"><img src="../../dist/img/productImage/'.$row['productImage'].'" class="img-size-100" alt="image" /></a>';
                          }                                              
                        ?>
                      </div>
                      <div class="product-info">
                        <a href="../products/code.php?id=<?php echo $row['productId']; ?>" class="product-title" style="color: #007BFF;width: 50%;" data-toggle="tooltip" title="<?php echo $row["productName"]; ?>">
                          <?php
                            $str = $row['productName'];
                            $str = strlen($row['productName']) > 23 ? substr($row['productName'],0,23)."..." : $row['productName'];
                            echo $str;
                          ?>
                        </a>
                          <?php
                                if($row['availability'] == 'Available'){
                                  ?>
                                  <span class="badge badge-success float-right">Available</span>
                                  <?php
                                }else if($row['availability'] == 'Unavailable'){
                                  ?>
                                  <span class="badge badge-warning float-right">Unavailable</span>
                                  <?php
                                }
                          ?>

                        <span class="product-description" style="width:80%;" data-toggle="tooltip" title="<?php echo $row["productDescription"]; ?>">
                          <?php
                          $str = $row['productDescription'];
                          $str = strlen($row['productDescription']) > 35 ? substr($row['productDescription'],0,35)."..." : $row['productDescription'];
                          $strr = strip_tags($str, '');
                          if($row['productDescription'] != ""){
                            echo $strr;
                          }else{
                            echo "No Description";
                          }
                          
                          ?>
                          <br>
                          <b>RM <?php echo number_format($row['productPrice'],2); ?></b>,
                           Qtt: <b><?php echo $row['productQuantity']; ?></b>&nbsp;
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
                        </span>
                      </div>
                    </li>
                  <!-- /.item -->
                  <?php
                }
              }else{
                ?>
                <br><br>
                <div align="center">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 93 87" style="width: 120px;"><defs><rect id="defaultpage_nodata-a" width="45" height="33" x="44" y="32" rx="2"></rect><mask id="defaultpage_nodata-b" width="45" height="33" x="0" y="0" fill="#fff" maskContentUnits="userSpaceOnUse" maskUnits="objectBoundingBox"><use xlink:href="#defaultpage_nodata-a"></use></mask></defs><g fill="none" fill-rule="evenodd" transform="translate(-3 -4)"><rect width="96" height="96"></rect><ellipse cx="48" cy="85" fill="#F2F2F2" rx="45" ry="6"></ellipse><path fill="#FFF" stroke="#D8D8D8" d="M79.5,17.4859192 L66.6370555,5.5 L17,5.5 C16.1715729,5.5 15.5,6.17157288 15.5,7 L15.5,83 C15.5,83.8284271 16.1715729,84.5 17,84.5 L78,84.5 C78.8284271,84.5 79.5,83.8284271 79.5,83 L79.5,17.4859192 Z"></path><path fill="#DBDBDB" fill-rule="nonzero" d="M66,6 L67.1293476,6 L67.1293476,16.4294956 C67.1293476,17.1939227 67.7192448,17.8136134 68.4469198,17.8136134 L79,17.8136134 L79,19 L68.4469198,19 C67.0955233,19 66,17.849146 66,16.4294956 L66,6 Z"></path><g fill="#D8D8D8" transform="translate(83 4)"><circle cx="7.8" cy="10.28" r="3" opacity=".5"></circle><circle cx="2" cy="3" r="2" opacity=".3"></circle><path fill-rule="nonzero" d="M10.5,1 C9.67157288,1 9,1.67157288 9,2.5 C9,3.32842712 9.67157288,4 10.5,4 C11.3284271,4 12,3.32842712 12,2.5 C12,1.67157288 11.3284271,1 10.5,1 Z M10.5,7.10542736e-15 C11.8807119,7.10542736e-15 13,1.11928813 13,2.5 C13,3.88071187 11.8807119,5 10.5,5 C9.11928813,5 8,3.88071187 8,2.5 C8,1.11928813 9.11928813,7.10542736e-15 10.5,7.10542736e-15 Z" opacity=".3"></path></g><path fill="#FAFAFA" d="M67.1963269,6.66851903 L67.1963269,16.32 C67.2587277,17.3157422 67.675592,17.8136134 68.4469198,17.8136134 C69.2182476,17.8136134 72.735941,17.8136134 79,17.8136134 L67.1963269,6.66851903 Z"></path><use fill="#FFF" stroke="#D8D8D8" stroke-dasharray="3" stroke-width="2" mask="url(#defaultpage_nodata-b)" xlink:href="#defaultpage_nodata-a"></use><rect width="1" height="12" x="54" y="46" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="17" x="62" y="40" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="10" x="70" y="48" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="14" x="78" y="43" fill="#D8D8D8" rx=".5"></rect></g></svg>
                </div>
                <p class=" text-center text-secondary">No Data</p>
                <br>
                <?php
              }
              ?>
                </ul>
              </div>
              </div>
              <!-- /.card-body -->
               <?php
              if($_SESSION["user_role"] == "SuperUser" || $_SESSION["user_role"] == "Admin" ){
                ?>
                   <div class="card-footer clearfix">
                     <a href="../products/add.php" class="btn btn-info float-left"><i class="fa fa-plus"></i> New Product </a>
                    <a href="../products/" class="btn btn-info float-right">All Products</a>
                  </div>
                <?php
              } else{
                ?>
                   <div class="card-footer text-center">
                    <a href="../products/" class="uppercase">View All Products</a>
                  </div>
                <?php
              }
              ?>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          <!--HERE NEW TABLE FOR ADDED PRODUCT-->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->

    <?php 
    if($_SESSION['user_role'] == "SuperUser" || $_SESSION['user_role'] == "Admin"){
      ?>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Sales - <b><?php echo date("F");?></b></h5>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <div class="btn-group">
                    <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                      <i class="fas fa-wrench"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right" role="menu">
                      <a href="<?php echo $base."orders/"; ?>" class="dropdown-item">View Orders</a>
                       <?php
                        if($_SESSION["user_role"] == "SuperUser" || $_SESSION["user_role"] == "Admin"){
                          ?>
                            <a href="<?php echo $base."reports/sales.php"; ?>" class="dropdown-item">View Sales Report</a>
                          <?php
                        }
                      ?>
                    </div>
                  </div>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div id="linediv"></div>
                  </div>
                </div>
              </div>
                <?php
                  $date = date('d M Y');
                 $query = "SELECT sum(sales) as sales, sum(profit) as profit, sum(subcost) as cost FROM orders WHERE orderStatus='Completed' AND orderDate = '$date'";
                $query_run = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($query_run)){
                  ?>
                  <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <!--<span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 0%</span>-->
                        <h5 class="description-header">RM <?php echo number_format($row["sales"],2); ?></h5>
                        <span class="description-text">TODAY SALES</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <!--<span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 0%</span>-->
                        <h5 class="description-header">RM <?php echo number_format($row["cost"],2); ?></h5>
                        <span class="description-text">SALES COST</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                    <!-- /.col -->
                    <div class="col-sm-4 col-6">
                      <div class="description-block border-right">
                        <!--<span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>-->
                       <h5 class="description-header">RM <?php echo number_format($row["profit"],2); ?></h5>
                        <span class="description-text">TODAY PROFIT</span>
                      </div>
                      <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                  </div>
                  <!-- /.row -->
                  <?php
                }
                ?>
              </div>
              <!-- ./card-body -->

            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->


      <div class="row">
        <div class="col-md-6">
          <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Stock Availability</h3>

                   <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div>
                    <?php
                      $query_tt = "SELECT productId FROM products WHERE status='Active' ORDER BY productId";
                      $query_tt_run = mysqli_query($connection, $query_tt);
                      $row_tt = mysqli_num_rows($query_tt_run);

                      ?>
                      <h6>
                        Total Active Products: <span class="text-dark"><?php echo "$row_tt"; ?></span>

                      </h6>
                      <?php
                    ?>
                  </div>
                  <div class="chart">
                    <div id="lvldiv"></div>
                  </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

        </div>

        <div class="col-md-6">
                        <!-- AREA CHART -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Products Brand</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
            </div>
            <div class="card-body">
              <div>
                <?php
                  $query_tt = "SELECT products.brandId, brands.brandName, COUNT(*) AS number FROM products INNER JOIN brands ON brands.brandId = products.brandId WHERE products.status='Active' GROUP BY products.brandId";
                  $query_tt_run = mysqli_query($connection, $query_tt);
                  $row_tt = mysqli_num_rows($query_tt_run);
                ?>
                <h6>
                Total Brand Used: <span class="text-dark"><?php echo "$row_tt"; ?></span>
                </h6>

              </div>

              <div class="chart">
                <div id="chartdiv"></div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!--End Pie-->
      </div>
      <?php
    }
    ?>

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

<?php
/*$query_ava = "SELECT productId FROM products WHERE status='Active' AND availability = 'Available' AND productQuantity!=0 AND productQuantity != 1 ORDER BY productId";
$query_ava_run = mysqli_query($connection, $query_ava);
$row_ava = mysqli_num_rows($query_ava_run);

$query_un = "SELECT productId FROM products WHERE status='Active'  AND availability = 'Unavailable' AND productQuantity!=0 AND productQuantity != 1 ORDER BY productId";
$query_un_run = mysqli_query($connection, $query_un);
$row_un = mysqli_num_rows($query_un_run);*/

$query_ava = "SELECT productId FROM products WHERE status='Active' AND availability='Available' AND productQuantity!=0 ORDER BY productId";
$query_ava_run = mysqli_query($connection, $query_ava);
$row_ava = mysqli_num_rows($query_ava_run);

$query_un = "SELECT productId FROM products WHERE status='Active'  AND availability='Unavailable' OR productQuantity=0 ORDER BY productId";
$query_un_run = mysqli_query($connection, $query_un);
$row_un = mysqli_num_rows($query_un_run);

$query_prod = "SELECT *, COUNT(*) AS num FROM products WHERE status = 'Active' GROUP BY availability";
$query_prod_run = mysqli_query($connection, $query_prod);
?>

<!-- Styles -->
<style>
#lvldiv {
  width: 100%;
  height: 280px;
}
#chartdiv {
  width: 100%;
  height: 280px;
}
</style>
<!-- Chart code -->
<script>
am4core.addLicense("ch-custom-attribution");
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("lvldiv", am4charts.PieChart);

// Let's cut a hole in our Pie chart the size of 40% the radius
chart.innerRadius = am4core.percent(40);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "value";
pieSeries.dataFields.category = "category";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.innerRadius = 10;


pieSeries.slices.template.propertyFields.disabled = "labelDisabled";
pieSeries.labels.template.propertyFields.disabled = "labelDisabled";
pieSeries.ticks.template.propertyFields.disabled = "labelDisabled";



pieSeries.ticks.template.events.on("ready", hideSmall);
pieSeries.ticks.template.events.on("visibilitychanged", hideSmall);
pieSeries.labels.template.events.on("ready", hideSmall);
pieSeries.labels.template.events.on("visibilitychanged", hideSmall);

function hideSmall(ev) {
  if (ev.target.dataItem && (ev.target.dataItem.values.value.percent < 5)) {
    ev.target.hide();
  }
  else {
    ev.target.show();
  }
}



pieSeries.data = [

<?php
while($row_p = mysqli_fetch_assoc($query_prod_run)){
  if($row_p["availability"] == "Available" ){
    echo '{ "category": "Available", "value": "'.$row_ava.'" },';
  }
  if($row_p["availability"] == "Unavailable" ){
    echo '{ "category": "Unavailable", "value": "'.$row_un.'" },';
  }

}
?>
];

if (!pieSeries.data || pieSeries.data.length === 0){
  const noDataMessagecontainer = chart.chartContainer.createChild(am4core.Container);
  noDataMessagecontainer.align = 'center';
  noDataMessagecontainer.isMeasured = false;
  noDataMessagecontainer.x = am4core.percent(50);
  noDataMessagecontainer.horizontalCenter = 'middle';
  noDataMessagecontainer.y = am4core.percent(50);
  noDataMessagecontainer.verticalCenter = 'middle';
  noDataMessagecontainer.layout = 'vertical';

  const messageLabel = noDataMessagecontainer.createChild(am4core.Label);
  messageLabel.text = 'No Data Available';
  messageLabel.textAlign = 'middle';
  messageLabel.maxWidth = 300;
  messageLabel.wrap = true;
}

// Disable sliding out of slices
pieSeries.slices.template.states.getKey("hover").properties.shiftRadius = 0;
pieSeries.slices.template.states.getKey("hover").properties.scale = 1;

// Add second series
var pieSeries2 = chart.series.push(new am4charts.PieSeries());
pieSeries2.dataFields.value = "value";
pieSeries2.dataFields.category = "category";
pieSeries2.slices.template.states.getKey("hover").properties.shiftRadius = 0;
pieSeries2.slices.template.states.getKey("hover").properties.scale = 1;
pieSeries2.slices.template.propertyFields.fill = "fill";

// Add a legend
chart.legend = new am4charts.Legend();
/*chart.legend.position="right";
chart.legend.maxHeight = 150;
chart.legend.scrollable = true;*/

pieSeries.adapter.add("innerRadius", function(innerRadius, target){
  return am4core.percent(40);
})

pieSeries2.adapter.add("innerRadius", function(innerRadius, target){
  return am4core.percent(60);
})

pieSeries.adapter.add("radius", function(innerRadius, target){
  return am4core.percent(100);
})

pieSeries2.adapter.add("radius", function(innerRadius, target){
  return am4core.percent(80);
})

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.items = [
  {
    "label": "...",
    "menu": [
      {
        "label": "Images",
        "menu": [
          { "type": "png", "label": "PNG" },
          { "type": "jpg", "label": "JPG" },
          { "type": "svg", "label": "SVG" },
        ]
      }, {
        "label": "Export",
        "menu": [
          { "type": "json", "label": "JSON" },
          { "type": "csv", "label": "CSV" },
          { "type": "xlsx", "label": "XLSX" },
          { "type": "html", "label": "HTML" },
          { "type": "pdfdata", "label": "PDF" }
        ]
      }, {
        "label": "Print", "type": "print"
      }
    ]
  }
];

}); // end am4core.ready()
</script>


<?php
$query_brand = "SELECT products.brandId, brands.brandName, COUNT(*) AS number FROM products INNER JOIN brands ON brands.brandId = products.brandId WHERE products.status='Active' GROUP BY products.brandId";
$query_brand_run = mysqli_query($connection, $query_brand);
?>


<!--Pie Chart code -->
<script>
am4core.addLicense("ch-custom-attribution");
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_material);
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("chartdiv", am4charts.PieChart);


// Add data
chart.data = [
  <?php
  while($row_b = mysqli_fetch_assoc($query_brand_run)){
    echo '{ "brands": "'.$row_b["brandName"].'", "products": "'.$row_b["number"].'" },';
  }
  ?>
];

if (!chart.data || chart.data.length === 0){
  const noDataMessagecontainer = chart.chartContainer.createChild(am4core.Container);
  noDataMessagecontainer.align = 'center';
  noDataMessagecontainer.isMeasured = false;
  noDataMessagecontainer.x = am4core.percent(50);
  noDataMessagecontainer.horizontalCenter = 'middle';
  noDataMessagecontainer.y = am4core.percent(50);
  noDataMessagecontainer.verticalCenter = 'middle';
  noDataMessagecontainer.layout = 'vertical';

  const messageLabel = noDataMessagecontainer.createChild(am4core.Label);
  messageLabel.text = 'No Data Available';
  messageLabel.textAlign = 'middle';
  messageLabel.maxWidth = 300;
  messageLabel.wrap = true;
}

// Add a legend
/*chart.legend = new am4charts.Legend();
chart.legend.position="right";
chart.legend.maxHeight = 150;
chart.legend.scrollable = true;*/

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "products";
pieSeries.dataFields.category = "brands";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeOpacity = 1;

//label inside
/*pieSeries.ticks.template.disabled = true;
pieSeries.alignLabels = false;
pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
pieSeries.labels.template.radius = am4core.percent(-40);
pieSeries.labels.template.fill = am4core.color("white");

//label outside if too small
pieSeries.labels.template.adapter.add("radius", function(radius, target) {
  if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
    return 0;
  }
  return radius;
});

pieSeries.labels.template.adapter.add("fill", function(color, target) {
  if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
    return am4core.color("#000");
  }
  return color;
});*/

//hide slide which too small
pieSeries.ticks.template.events.on("ready", hideSmall);
pieSeries.ticks.template.events.on("visibilitychanged", hideSmall);
pieSeries.labels.template.events.on("ready", hideSmall);
pieSeries.labels.template.events.on("visibilitychanged", hideSmall);

function hideSmall(ev) {
  if (ev.target.dataItem && (ev.target.dataItem.values.value.percent < 5)) {
    ev.target.hide();
  }
  else {
    ev.target.show();
  }
}

//lable
/*pieSeries.ticks.template.disabled = true;
pieSeries.alignLabels = false;
pieSeries.labels.template.text = "{value.percent.formatNumber('#.0')}%";
pieSeries.labels.template.radius = am4core.percent(-40);
pieSeries.labels.template.fill = am4core.color("white");
pieSeries.labels.template.adapter.add("radius", function(radius, target) {
  if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
    return 0;
  }
  return radius;
});

pieSeries.labels.template.adapter.add("fill", function(color, target) {
  if (target.dataItem && (target.dataItem.values.value.percent < 10)) {
    return am4core.color("#000");
  }
  return color;
});*/

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

chart.hiddenState.properties.radius = am4core.percent(0);

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.items = [
  {
    "label": "...",
    "menu": [
      {
        "label": "Images",
        "menu": [
          { "type": "png", "label": "PNG" },
          { "type": "jpg", "label": "JPG" },
          { "type": "svg", "label": "SVG" },
        ]
      }, {
        "label": "Export",
        "menu": [
          { "type": "json", "label": "JSON" },
          { "type": "csv", "label": "CSV" },
          { "type": "xlsx", "label": "XLSX" },
          { "type": "html", "label": "HTML" },
          { "type": "pdfdata", "label": "PDF" }
        ]
      }, {
        "label": "Print", "type": "print"
      }
    ]
  }
];

}); // end am4core.ready()
</script>


<?php
$oMonth = date('M');
$oYear = date('Y');
$odate = date('d M Y');
$query_li = "SELECT sum(sales) AS sumSales , orders.orderDate FROM orders WHERE orderStatus='Completed' AND orderMonth = '$oMonth' AND orderYear = '$oYear' GROUP BY orderDate";
$query_li_run = mysqli_query($connection, $query_li);
?>

<style>
#linediv {
  width: 100%;
  height: 400px;
}

</style>

<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("linediv", am4charts.XYChart);

// Add data
chart.data = [
  <?php
    while($row_li = mysqli_fetch_assoc($query_li_run)){
      echo '
      {
        "date": "'.$row_li["orderDate"].'",
        "value": "RM '.number_format($row_li["sumSales"],2).'",
        "lineColor": chart.colors.next(),
      },
    ';
    }
  ?>
];


if (!chart.data || chart.data.length === 0){
  const noDataMessagecontainer = chart.chartContainer.createChild(am4core.Container);
  noDataMessagecontainer.align = 'center';
  noDataMessagecontainer.isMeasured = false;
  noDataMessagecontainer.x = am4core.percent(50);
  noDataMessagecontainer.horizontalCenter = 'middle';
  noDataMessagecontainer.y = am4core.percent(50);
  noDataMessagecontainer.verticalCenter = 'middle';
  noDataMessagecontainer.layout = 'vertical';

  const messageLabel = noDataMessagecontainer.createChild(am4core.Label);
  messageLabel.text = 'No Data Available';
  messageLabel.textAlign = 'middle';
  messageLabel.maxWidth = 300;
  messageLabel.wrap = true;
}

// Set input format for the dates
chart.dateFormatter.inputDateFormat = "yyyy-MM-dd";

// Create axes
var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

// Create series
var series = chart.series.push(new am4charts.LineSeries());
series.dataFields.valueY = "value";
series.dataFields.dateX = "date";
series.tooltipText = "{value}"
series.strokeWidth = 2;
series.minBulletDistance = 15;

// Drop-shaped tooltips
series.tooltip.background.cornerRadius = 20;
series.tooltip.background.strokeOpacity = 0;
series.tooltip.pointerOrientation = "vertical";
series.tooltip.label.minWidth = 40;
series.tooltip.label.minHeight = 40;
series.tooltip.label.textAlign = "middle";
series.tooltip.label.textValign = "middle";

// Make bullets grow on hover
var bullet = series.bullets.push(new am4charts.CircleBullet());
bullet.circle.strokeWidth = 2;
bullet.circle.radius = 4;
bullet.circle.fill = am4core.color("#fff");

var bullethover = bullet.states.create("hover");
bullethover.properties.scale = 1.3;

// Make a panning cursor
chart.cursor = new am4charts.XYCursor();
chart.cursor.behavior = "panXY";
chart.cursor.xAxis = dateAxis;
chart.cursor.snapToSeries = series;

// Create vertical scrollbar and place it before the value axis
chart.scrollbarY = new am4core.Scrollbar();
chart.scrollbarY.parent = chart.leftAxesContainer;
chart.scrollbarY.toBack();

// Create a horizontal scrollbar with previe and place it underneath the date axis
chart.scrollbarX = new am4charts.XYChartScrollbar();
chart.scrollbarX.series.push(series);
chart.scrollbarX.parent = chart.bottomAxesContainer;

dateAxis.start = 0;
dateAxis.keepSelection = true;

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.items = [
  {
    "label": "...",
    "menu": [
      {
        "label": "Images",
        "menu": [
          { "type": "png", "label": "PNG" },
          { "type": "jpg", "label": "JPG" },
          { "type": "svg", "label": "SVG" },
        ]
      }, {
        "label": "Export",
        "menu": [
          { "type": "json", "label": "JSON" },
          { "type": "csv", "label": "CSV" },
          { "type": "xlsx", "label": "XLSX" },
          { "type": "html", "label": "HTML" },
          { "type": "pdfdata", "label": "PDF" }
        ]
      }, {
        "label": "Print", "type": "print"
      }
    ]
  }
];

}); // end am4core.ready()

</script>
