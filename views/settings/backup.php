<?php
include '../../database/security.php';
$title = "Settings";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<?php
  if(($_SESSION['user_role'] != "SuperUser") && ($_SESSION['user_role'] != "Admin")){
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
          <h1 class="m-0">Backup & Restore</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="../dashboard">Home</a></li>
            <li class="breadcrumb-item active">Backup & Restore</li>
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
              <div class="card-header">             	
                <h2 class="card-title"> Backup & Restore</h2>         
              </div>
              <!-- /.card-header -->
             	<div class="card-body">
               <?php
                if (isset($_SESSION['statusE']) && $_SESSION['statusE'] != '') {
                  echo '
                        <div class="form-group" id="success-alert">
                        <div class="alert alert-danger alert-dismissible" >
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-exclamation-circle"></i> ' . $_SESSION['statusE'] . '
                        </div>
                        </div>
                        ';
                  unset($_SESSION['statusE']);
                }
            ?>

            <?php
                if (isset($_SESSION['successState']) && $_SESSION['successState'] != '') {
                  echo '
                        <div class="form-group" id="success-alert">
                        <div class="alert alert-success alert-dismissible ">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check-circle"></i> ' . $_SESSION['successState'] . '
                        </div>
                        </div>
                        ';
                  unset($_SESSION['successState']);
                }
            ?>

            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-content-above-home-tab" data-toggle="pill" href="#custom-content-above-home" role="tab" aria-controls="custom-content-above-home" aria-selected="true">Backup</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-content-above-profile-tab" data-toggle="pill" href="#custom-content-above-profile" role="tab" aria-controls="custom-content-above-profile" aria-selected="false">Restore</a>
              </li>
            
            </ul>
         
            <div class="tab-content" id="custom-content-above-tabContent">
              <div class="tab-pane fade show active" id="custom-content-above-home" role="tabpanel" aria-labelledby="custom-content-above-home-tab">
              	<form method="POST" id="exportForm" enctype="multipart/form-data" action="code.php">
                  <p class="h5 text-center mt-5">Export SQL File to Backup Data</h4>
                    <p class="text-center mt-5">
                      <button type="submit" class="btn btn-dark" id="exportBtn" name="exportBtn" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-download"></i> Backup Database File</button>
                    </p><br>
				        </form>
              </div>
              <div class="tab-pane fade" id="custom-content-above-profile" role="tabpanel" aria-labelledby="custom-content-above-profile-tab">
                	<form id="importForm" method="POST" enctype="multipart/form-data" action="code.php">
                    <p class="h5 text-center mt-5">Select SQL File to Restore Data</h4>
                    <p class="text-center mt-5 importTag">
                        <input type="file" name="importFile" placeholder="Import" id="importFile">
                    </p>
                    <p class="text-center mt-5">
                     
                      <button class="btn btn-dark mb-3" id="importBtn" name="importBtn" type="submit"><i class="fa fa-upload"></i> Restore Database File</button>
                    </p>   
                      <div class="form-group" id="process" style="display: none;">
                          <div class="progress">
                             <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="">
                             </div>
                          </div>
  	                  </div>
  	             </form>
            </div>
          </div>
        </div>

        </div>
        <!-- /.card -->

        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-12">

          <div class="card">
            <form action="">
              <div class="card-header">
                <h2 class="card-title">Backup Records</h2>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 
                <div class="table-responsive">
                  <?php
                  $query = $connection -> prepare("SELECT backup.*, users.userName FROM backup INNER JOIN users ON users.userId = backup.users");
                  $query->execute(); 
                  $result = $query->get_result(); 
                  //$query = 'SELECT * FROM customers';
                  //$query_run = mysqli_query($connection, $query);
                  ?>
                  <table id="dataTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="50px;">ID</th>
                        <th>File Name</th>
                        <th>Backup On</th>
                        <th>Backup By</th>
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
                            </tr>
                          </tfoot>

                    <tbody>
                      <?php
                      if ($result > '0') {
                        $n = 0;
                        while ($row = $result->fetch_assoc()) {
                          $n++;
                      ?>
                          <tr>
                            <form></form>
                            <td><?php echo $n ?></td>
                            <td>
                              <?php echo $row['name']; ?>
                              <input type="hidden" name="fname" id="fname" class="form-control" value="<?php echo $row['name']; ?>">
                            </td>
                            <td><?php echo $row['dateTime']; ?></td>
                            <td><?php echo $row['userName']; ?></td>
                            <td style="text-align:center;">
                              <form action="code.php" method="post">
                                <div class="btn">

                                  <input type="hidden" name="delete_id" value="<?php echo $row['backupId']; ?>">
                                  <a href="#deleteModal" class="btn btn-danger deleteBtn" data-id="<?php echo $row['backupId']; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash" data-toggle="tooltip" title="Delete <?php echo $row["name"]; ?>"></i></a>
                                </div>

                              </form>
                            </td>
                          </tr>
                      <?php
                        }
                      } else {
                        echo "";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <!--Table responsive-->
              </div>
              <!-- /.card-body -->
            </form>

          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
      <?php
  }
?>  
</div>
<!-- /.content-wrapper -->

<!-- Delete Modal-->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Confirm Delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Select "Delete" below if you want to delete backup record.</p>
          <p class="text-danger">*Caution: Changes cannot be made after delete successful.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="code.php" method="POST">
            <input type="hidden" name="deleteid" value="" />
            <input type="hidden" name="filename" id="filename" class="form-control" value="">
            <button type="submit" name="delete_btn" class="btn btn-primary">Delete</button>
          </form>
        </div>
    </div>
  </div>
</div>


<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>

<script type="text/javascript">
  $(document).on('submit', '#exportForm', function() {
  setTimeout(function() {
    window.location = "backup.php";
  }, 100);
});
</script>

<script>
  $(function() {
    $('#dataTable').on('click', 'a.deleteBtn', function(e) {
      e.preventDefault();
      var link = this;
      var  fn = $('#fname').val();
      var deleteModal = $("#deleteModal");
      // store the deleteID inside the modal's form
      deleteModal.find('input[name=deleteid]').val(link.dataset.id);
      deleteModal.find('input[name=filename]').val(fn);
      // open modal
      deleteModal.modal();
    });
  });

  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

</script>
<script type="text/javascript">
/* $(document).ready(function(){
  $('#importForm').on('submit', function(event){
   event.preventDefault();
   var count_error = 0;
   if(count_error == 0)
   {
    $.ajax({
     url:"backup.php",
     method:"POST",
     data:$(this).serialize(),
     beforeSend:function()
     {
      $('#importBtn').attr('disabled', 'disabled');
      $('#process').css('display', 'block');
     },
     success:function(data)
     {
      var percentage = 0;

      var timer = setInterval(function(){
       percentage = percentage + 20;
       progress_bar_process(percentage, timer);
      }, 1000);
     },
      error: function (data) {
        alert("Something went wrong");
      },
    })
   }
   else
   {
    return false;
   }
  });

  function progress_bar_process(percentage, timer)
  {
   $('.progress-bar').css('width', percentage + '%');
   if(percentage > 100)
   {
    clearInterval(timer);
    $('#importForm')[0].reset();
    $('#process').css('display', 'none');
    $('.progress-bar').css('width', '0%');
    $('#importBtn').attr('disabled', false);
    setTimeout(function(){}, 5000);
    
   }
  }

 });*/

 $(document).ready(function() {
  
    var btnCust = ''; 
    $("#importFile").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: 'SQL File',
        removeLabel: '',
        browseIcon: '<i class="fa fa-folder-open"></i>',
        removeIcon: '<i class="fa fa-times"></i>',
        removeTitle: 'Reset or Cancel SQL File',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["sql"]
    });

  });

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End

</script>

<script type="text/javascript">
  $(function() {

    $.validator.addMethod("valueNotEquals", function(value, element, arg) {
      return arg !== value;
    }, "Value must not equal arg.");

    $.validator.addMethod("greaterThan",
    function (value, element, param) {
          var $otherElement = $(param);
          return parseInt(value, 10) >= parseInt($otherElement.val(), 10) || parseFloat(value, 10) >= parseFloat($otherElement.val(), 10);
    });

    $('#importForm').validate({
      rules: {
        importFile: {
          required: true,
        },
      },
      messages: {
        importFile: {
          required: "SQL File is Required"
        },
      },
      errorElement: 'span',
      errorPlacement: function(error, element) {
        error.addClass('invalid-feedback');
        element.closest('.importTag').append(error);
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
