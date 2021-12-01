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
          <h1 class="m-0">Products</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
            <li class="breadcrumb-item active">Products</li>
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
                                <div class="col-xl-4 col-md-6 col-sm-12">
                                <form action="code.php" method="POST" id="statusForm">
                                <div class="input-group" style="">
                                <!--<input type="text" class="form-control" name="datepicker" id="datepicker"  placeholder="Select Year" />-->
                                <select class="form-control multiselect" id="status" name="status">
                                  <option value="" selected disabled>--- Select Stock Status ---</option>
                                  <option value="All">All</option>
                                  <option value="Available">Available</option>
                                  <option value="Unavailable">Unavailable</option>
                                  <option value="LowStock">LowStock</option>
                                  <option value="StockOut">StockOut</option>
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
                <h2 class="card-title">Product Records</h2>
                <?php
                  if($_SESSION["user_role"] == "SuperUser" || $_SESSION["user_role"] == "Admin"){
                    ?>
                      <button type="button" class="btn btn-primary float-right" onclick='window.location.href="add.php"'>
                      <i class="fa fa-plus"></i> Add 
                      </button>
                    <?php
                  }elseif($_SESSION["user_role"] == "Staff"){
                    ?>
                     
                    <?php
                  }
                ?>
               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <?php
                  if(isset($_GET["stock"])){ 
                    if($_GET['stock'] == "Available"){
                      $sta = "Active";
                      $s = $_GET['stock'];
                      $query = $connection -> prepare("SELECT * FROM products WHERE status=? AND availability=? AND productQuantity!=0 ORDER BY productId DESC");
                      $query -> bind_param("ss", $sta, $s);
                      $query->execute(); 
                      $result = $query->get_result();
                    }else if($_GET['stock'] == "Unavailable"){
                      $sta = "Active";
                      $s = $_GET['stock'];
                      $query = $connection -> prepare("SELECT * FROM products WHERE status=? AND availability=? OR productQuantity=0 ORDER BY productId DESC");
                      $query -> bind_param("ss", $sta, $s);
                      $query->execute(); 
                      $result = $query->get_result();
                    }else if($_GET['stock'] == "StockOut"){
                      $sta = "Active";
                      $query = $connection -> prepare("SELECT * FROM products WHERE status=? AND productQuantity=0 ORDER BY productId DESC");
                      $query -> bind_param("s", $sta);
                      $query->execute(); 
                      $result = $query->get_result();
                    }else if($_GET['stock'] == "LowStock"){
                      $sta = "Active";
                      $query = $connection -> prepare("SELECT * FROM products WHERE status=? AND productQuantity=1 ORDER BY productId DESC");
                      $query -> bind_param("s", $sta);
                      $query->execute(); 
                      $result = $query->get_result();
                    }
                  }else{
                    $sta = "Active";
                    $query = $connection -> prepare("SELECT * FROM products WHERE status=? ORDER BY productId DESC");
                    $query -> bind_param("s", $sta);
                    $query->execute(); 
                    $result = $query->get_result(); 
                  }
                  ?>

                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Image</th>
                        <th>SKU</th>
                        <th width="260px;">Name</th>
                        <th>Price (RM)</th>
                        <th>Cost (RM)</th>
                        <th>Quantity</th>
                        <th>Availability</th>
                        <th style="text-align:center;" width="140px"><i class="fa fa-cog"></i> Actions</th>
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
                            </tr>
                          </tfoot>

                    <tbody>
                      <?php
                      if($result > '0'){
                          while($row = $result -> fetch_assoc()){
                        ?>
                          <tr>
                            <form></form>
                            <td>
                              <?php  
                                  if($row["productImage"] == ""){
                                    ?>
                                      <img class="rounded-circle" src="../../dist/img/prodDefault.png" height="100;" width="100;" alt="image">
                                    <?php
                                  }else{
                                    echo '<a href="../../dist/img/productImage/'.$row['productImage'].'"><img src="../../dist/img/productImage/'.$row['productImage'].'" width="100" height="100" class="img-circle" alt="image" /></a>';
                                  }
                                              
                              ?>
                            </td>
                            <td><?php echo $row['productSKU']; ?></td>
                            <td>
                              <?php echo $row['productName']; ?><br>
                                <?php
                                  if($row['productDescription'] == ''){
                                    echo '<span class="product-description" style="font-size:14px;color: #6C757D;">No Description</span>';
                                  }else{
                                    ?>
                                      <span class="product-description" style="font-size:14px;color: #6C757D;">
                                        Description: 
                                        <?php   
                                        $str = $row['productDescription'];                          
                                        $str = strlen($row['productDescription']) > 50 ? substr($row['productDescription'],0,50)."..." : $row['productDescription'];
                                        echo $str;            
                                        ?>
                                      </span> 
                                    <?php
                                  }
                                ?>
                              </td>
                            <td><?php echo number_format($row['productPrice'],2); ?></td>
                            <td><?php echo number_format($row['productCost'],2); ?></td>
                            <td>
                              <?php echo $row['productQuantity']; ?>&nbsp;
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
                            <td>
                              <?php
                                if($row['availability'] == 'Available'){
                                  ?>
                                  <span class="badge badge-success">Available</span>
                                  <?php
                                }else if($row['availability'] == 'Unavailable'){
                                  ?>
                                  <span class="badge badge-warning">Unavailable</span>
                                  <?php
                                }
                              ?>
                            </td>
                          
                              <td style="text-align:center;">
                                <form action="code.php" method="post">
                                  <div class="btn">
                                    <input type="hidden" name="view_id" value="<?php echo $row['productId']; ?>">
                                    <button type="submit" name="viewBtn" class="btn btn-info" data-toggle="tooltip" title="View <?php echo $row["productName"]; ?>"><i class="fa fa-eye" style="font-size:14px;"></i></button>
                                     <?php
                                    if($_SESSION["user_role"] == "SuperUser" || $_SESSION["user_role"] == "Admin"){
                                      ?>
                                        <input type="hidden" name="edit_id" value="<?php echo $row['productId']; ?>">
                                        <button type="submit" name="editBtn" class="btn btn-primary" data-toggle="tooltip" title="Edit <?php echo $row["productName"]; ?>"><i class="fa fa-pencil-alt" style="font-size:14px;"></i></button>
                                        <input type="hidden" name="delete_id" value="<?php echo $row['productId']; ?>">
                                        <a href="#deleteModal" class="btn btn-danger deleteBtn" data-id="<?php echo $row['productId']; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" data-toggle="tooltip" title="Remove <?php echo $row["productName"]; ?>"></i></a>
                                       <?php 
                                     }elseif($_SESSION["user_role"] == "Staff"){
                                      ?>
                                       
                                      <?php
                                    }
                                  ?>
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
            <?php 
            if($_SESSION['user_role'] == "SuperUser" || $_SESSION['user_role'] == "Admin"){
              ?>
                <div class="card-footer">
                  <a class="btn btn-secondary" href="../recycle/products.php"><i class="fa fa-recycle"></i> Recycle Bin</a>
                </div>
              <?php
            }
            ?>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!--<ul class="nav nav-pills p-3 bg-white mb-3 align-items-center" style="border-radius:10px;">
        <li class="nav-item">
            <p class="h4">Products</p>
        </li>

        
        <li class="nav-item ml-auto">
            <a href="../products/add.php" class="nav-link btn-primary d-flex align-items-center px-3" id="add-notes"> <span class="font-14" style="color:white;"> <i class="fa fa-plus"></i> Add Product</span></a>
        </li>
    </ul>


        <?php
            $sta = "Active";
            $query = $connection -> prepare("SELECT * FROM products WHERE status=? ORDER BY productId DESC");
            $query -> bind_param("s", $sta);
            $query->execute(); 
            $result = $query->get_result(); 
            if($result > '0'){
                while($row = $result -> fetch_assoc()){      
                ?>
                <div class="container  mb-5">
                  <div class="d-flex justify-content-center row">
                      <div class="col-md-12">
                          <div class="row p-2 bg-white border rounded">
                              <div class="col-md-3 mt-1"><img src="../../dist/img/productImage/<?php echo $row['productImage']; ?>" alt="image" width="200" height="200"/></div>
                              <div class="col-md-6 mt-1">
                                  <h6><?php echo $row['productSKU']; ?></h6>
                                  <h5><?php echo $row['productName']; ?></h5>
                                
                                  <p class="text-justify text-truncate para mb-0">
                                    <?php echo $row['productDescription']?>
                                  </p>
                              </div>
                              <div class="align-items-center align-content-center col-md-3 border-left mt-1">
                                  <div class="d-flex flex-row align-items-center">
                                      <h6 class="mr-1">Price : RM <?php echo number_format($row['productPrice'],2);?></h6>
                                  </div>
                                  <div class="d-flex flex-row align-items-center">
                                      <h6 class="mr-1">Cost : RM <?php echo number_format($row['productPrice'],2);?></h6>
                                  </div>
                                  <br>
                                  <h6 class="text-dark"><i class="fa fa-cog"></i> Actions</h6>
                                  <div class="d-flex flex-column mt-4">
                                    <button class="btn btn-primary btn-sm" type="button">Details</button>
                                    <button class="btn btn-outline-primary btn-sm mt-2" type="button">Edit</button>
                                    <button class="btn btn-outline-danger btn-sm mt-2" type="button">Remove</button>
                                  </div>
                              </div>
                          </div>
                         
                          </div>
                      </div>
                  </div>
                  <?php
                  }
                }
              ?>-->
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Move to Recycle Bin?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Select "Confirm" below if you want to move it to recycle bin.</p>
          
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="code.php" method="POST">
            <input type="hidden" name="deleteid" value="" />
            <button type="submit" name="recycleBtn" class="btn btn-primary">Confirm</button>
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
      // store the ID inside the modal's form
      deleteModal.find('input[name=deleteid]').val(link.dataset.id);
      // open modal
      deleteModal.modal();
    });
  });
</script>

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
          required: "Stock Status is required.",
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
