<?php
include '../../database/security.php';
$title = "Product";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <?php
 if($_SESSION['user_role'] != "SuperUser" && $_SESSION['user_role'] != "Admin"){
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
          <h1 class="m-0">Add Product</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
            <li class="breadcrumb-item"><a href="../products">Products</a></li>
            <li class="breadcrumb-item active">Add Product</li>
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
              <h3 class="card-title">Add Product</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="code.php" id="addForm" method="post" enctype="multipart/form-data">
              <div class="card-body">
                 <?php
                            if (isset($_SESSION['statusSKU']) && $_SESSION['statusSKU'] != '') {
                              echo '
                                    <div class="form-group">
                                    <div class="alert alert-danger alert-dismissible" >
                                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <i class="fa fa-exclamation-circle"></i> ' . $_SESSION['statusSKU'] . '
                                    </div>
                                    </div>
                                    ';
                              unset($_SESSION['statusSKU']);
                            }
                          ?>

                  <div class="form-group">
                   <label for="product_image">Product Image</label>
                    <div class="kv-avatar">
                        <div class="file-loading">
                            <input id="product_image" name="product_image" type="file">
                        </div>
                    </div>
                  </div>

                <div class="form-group">
                  <label for="name">Product SKU</label>
                  <input type="text" class="form-control" id="sku" placeholder="SKU" name="sku" required>
                </div>

                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
                </div>

                <div class="form-group">
                  <label for="contact">Product Quantity</label>
                  <input type="text" class="form-control" id="qtt" placeholder="Quantity" name="quantity" min=0 oninput="validity.valid||(value='');" required>
                </div>

                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Cost</label>
                      <input type="text" id="cost" class="form-control" placeholder="Cost" name="cost" min=0 oninput="validity.valid||(value='');" required>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Product Price</label>
                      <input type="text" id="price" class="form-control" placeholder="Price" name="price" min=0 oninput="validity.valid||(value='');" required>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="description">Product Description</label>
                   <textarea class="form-control rounded-0" id="description" name="description" placeholder="Description" rows="6"></textarea>
                </div>

                 <div class="row">
                  <div class="col-sm-6">
                       <div class="form-group">
                        <label>Brand</label>
                        <select class="form-control multiselect" name="brand">
                          <option value="" disabled selected>-- Select Brand --</option>
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
                        <select class="form-control multiselect" multiple="multiple" name="category[]">
                          <?php
                           $records = mysqli_query($connection, "SELECT * From category WHERE categoryStatus ='Active'");
                              while($data = mysqli_fetch_array($records)){
                                  echo "<option value='". $data["categoryId"] ."'>" .$data['categoryName'] ."</option>";
                              }
                          ?>
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
                      <select class="form-control multiselect" multiple="multiple" name="attvalue[]">
                        <?php
                         $record_attv = mysqli_query($connection, "SELECT * From attributes_value WHERE status ='Active' AND parentId='".$data_att['attributeId']."'");
                            foreach($record_attv as $attvdata => $data_attv){
                                echo "<option value='". $data_attv["attvalueId"] ."'>" .$data_attv['attvalueName'] ."</option>";
                            }
                        ?>
                      </select>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                  <label>Supplier</label>
                  <select class="form-control multiselect" multiple="multiple" name="supplier[]">
                    <?php
                     $records = mysqli_query($connection, "SELECT * From suppliers WHERE supplierStatus ='Active'");
                        while($data = mysqli_fetch_array($records)){
                            echo "<option value='". $data["supplierId"] ."'>" .$data['supplierName'] ."</option>";
                        }
                    ?>
                  </select>
                </div>

                 <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Availability</label>
                      <select class="form-control" name="availability" placeholder="Availability" required>
                        <option value="Available">Available</option>
                        <option value="Unavailable">Unavailable</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Status</label>
                      <select class="form-control" name="status" placeholder="Status" required>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                      </select>
                    </div>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <a href="javascript:history.go(-1)" class="btn btn-secondary">Cancel</a>
                <!--<button type="submit" class="btn btn-secondary">Cancel</button>-->
                <button type="submit" name="addBtn" class="btn btn-primary">Add</button>
              </div>
            </form>
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

<script>
  $(function() {

    $.validator.addMethod("valueNotEquals", function(value, element, arg) {
      return arg !== value;
    }, "Value must not equal arg.");

    $.validator.addMethod("greaterThan",
    function (value, element, param) {
          var $otherElement = $(param);
          return parseInt(value, 10) >= parseInt($otherElement.val(), 10) || parseFloat(value, 10) >= parseFloat($otherElement.val(), 10);
    });

    $('#addForm').validate({
      rules: {
        product_image: {
          required: true,
        },
        name: {
          required: true,
        },
        sku: {
          required: true,
        },
        price: {
          required: true,
          greaterThan: "#cost",
        },
        cost: {
          required: true,
        },
        quantity: {
          required: true,
          maxlength:3
        },
         status: {
          required: true,
        },
         availability: {
          required: true,
        },
        brand: {
          required: true,
        },
      },
      messages: {
        product_image: {
          required: "Product Image cannot be empty"
        },
        name: {
          required: "Product Name cannot be empty"
        },
        sku: {
          required: "Product SKU cannot be empty",
        },
        price: {
          required: "Price cannot be empty",
          numbers: "Price can be number or digits only",
          greaterThan: "Price must be greater or equal to Cost",
        },
        cost: {
          required: "Cost cannot be empty",
          numbers: "Cost can be number or digits only"
        },
        quantity: {
          required: "Quantity cannot be empty",
          numbers: "Quantity can be number or digits only",
          maxlength:"Quantity too much",
        },
        status: {
          required: "Status is required",
        },
        availability: {
          required: "Availability is required",
        },
        brand:{
          required: "Brand is required",
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

</script>

<script>
  $(document).ready(function() {
    $('.multiselect').select2({
      theme: 'bootstrap4'
    });
});   
</script>

<script type="text/javascript">
  $(document).ready(function() {
 
    $("#description").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#addProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Please dont click this &#128561;\')">' +
        '<i class="fa fa-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: 'Image',
        removeLabel: '',
        browseIcon: '<i class="fa fa-folder-open"></i>',
        removeIcon: '<i class="fa fa-times"></i>',
        removeTitle: 'Reset or Cancel Image',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif", "jpeg", "svg"]
    });

  });

</script>
