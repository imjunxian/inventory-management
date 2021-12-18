<?php
include('../../database/security.php');
$title = "Settings";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<style type="text/css">

.ui-w-80 {
    width: 80px !important;
    height: auto;
}

.btn-default {
    border-color: rgba(24,28,33,0.1);
    background: rgba(0,0,0,0);
    color: #4E5155;
}

label.btn {
    margin-bottom: 0;
}

.btn-outline-primary {
    border-color: #26B4FF;
    background: transparent;
    color: #26B4FF;
}

.btn {
    cursor: pointer;
}

.text-light {
    color: #babbbc !important;
}

.btn-facebook {
    border-color: rgba(0,0,0,0);
    background: #3B5998;
    color: #fff;
}

.btn-instagram {
    border-color: rgba(0,0,0,0);
    background: #000;
    color: #fff;
}

.card {
    background-clip: padding-box;
    box-shadow: 0 1px 4px rgba(24,28,33,0.012);
}

.row-bordered {
    overflow: hidden;
}

.account-settings-fileinput {
    position: absolute;
    visibility: hidden;
    width: 1px;
    height: 1px;
    opacity: 0;
}
.account-settings-links .list-group-item.active {
    font-weight: bold !important;
}
html:not(.dark-style) .account-settings-links .list-group-item.active {
    background: transparent !important;
}
.account-settings-multiselect ~ .select2-container {
    width: 100% !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.material-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24, 28, 33, 0.03) !important;
}
.material-style .account-settings-links .list-group-item.active {
    color: #4e5155 !important;
}
.dark-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(255, 255, 255, 0.03) !important;
}
.dark-style .account-settings-links .list-group-item.active {
    color: #fff !important;
}
.light-style .account-settings-links .list-group-item.active {
    color: #4E5155 !important;
}
.light-style .account-settings-links .list-group-item {
    padding: 0.85rem 1.5rem;
    border-color: rgba(24,28,33,0.03) !important;
}


</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Account Settings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Account Settings</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container light-style flex-grow-1 container-p-y">
            <div class="alert alert-info alert-dismissible" >
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <i class="fa fa-exclamation-triangle"></i> Notes: The maximum image attached file size is 5MB.
                  The only accepted format are png, jpg and jpeg.
              </div>
            <div class="card overflow-hidden">
              <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                  <div class="list-group list-group-flush account-settings-links">
                    <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-info">Info</a>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="tab-content">
                    <div class="tab-pane fade active show" id="account-general">

                      <div class="card-body media align-items-center">
                         <div class="form-group">
                             <label for="product_image">Profile Image</label>
                              <div class="kv-avatar">
                                  <div class="file-loading">
                                      <input id="profile_image" name="profile_image" type="file">
                                  </div>
                              </div>
                            </div>
                      </div>

                      <div class="card-body">
                        <div class="form-group">
                          <label class="form-label">Username</label>
                          <input type="text" class="form-control mb-1" value="nmaxwell">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Name</label>
                          <input type="text" class="form-control" value="Nelle Maxwell">
                        </div>
                        <div class="form-group">
                          <label class="form-label">E-mail</label>
                          <input type="text" class="form-control mb-1" value="nmaxwell@mail.com">
                         
                        </div>
                        <div class="form-group">
                          <label class="form-label">Company</label>
                          <input type="text" class="form-control" value="Company Ltd.">
                        </div>
                      </div>

                    </div>
                    <div class="tab-pane fade" id="account-change-password">
                      <div class="card-body pb-2">
                        <div class="form-group">
                            <p class="mb-2">Password requirements</p>
                              <p class="small text-muted mb-2">To change a new password, you have to meet all of the following requirements:</p>
                              <ul class="small text-muted pl-4 mb-0">
                                <li>Minimum 8 characters</li>
                                <li>At least One Uppercase</li>
                                <li>At least One Lowercase</li>
                                <li>At least One Number</li>
                              </ul>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Current password</label>
                          <input type="password" class="form-control">
                        </div>

                        <div class="form-group">
                          <label class="form-label">New password</label>
                          <input type="password" class="form-control">
                        </div>

                        <div class="form-group">
                          <label class="form-label">Repeat new password</label>
                          <input type="password" class="form-control">
                        </div>

                      </div>
                    </div>
                    <div class="tab-pane fade" id="account-info">
                      <div class="card-body pb-2">

                        <div class="form-group">
                          <label class="form-label">Bio</label>
                          <textarea class="form-control" rows="5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nunc arcu, dignissim sit amet sollicitudin iaculis, vehicula id urna. Sed luctus urna nunc. Donec fermentum, magna sit amet rutrum pretium, turpis dolor molestie diam, ut lacinia diam risus eleifend sapien. Curabitur ac nibh nulla. Maecenas nec augue placerat, viverra tellus non, pulvinar risus.</textarea>
                        </div>
                        <div class="form-group">
                          <label class="form-label">Birthday</label>
                          <input type="text" class="form-control" value="May 3, 1995">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Country</label>
                          <select class="custom-select">
                            <option>USA</option>
                            <option selected="">Canada</option>
                            <option>UK</option>
                            <option>Germany</option>
                            <option>France</option>
                          </select>
                        </div>


                      </div>
                      <hr class="border-light m-0">
                      <div class="card-body pb-2">

                        <h6 class="mb-4">Contacts</h6>
                        <div class="form-group">
                          <label class="form-label">Phone</label>
                          <input type="text" class="form-control" value="+0 (123) 456 7891">
                        </div>
                        <div class="form-group">
                          <label class="form-label">Website</label>
                          <input type="text" class="form-control" value="">
                        </div>

                      </div>
              
                    </div>

                  </div>
                </div>
              </div>

              <div class="card-footer text-right">
                  <button type="button" class="btn btn-primary">Save changes</button>&nbsp;
                  <button type="button" class="btn btn-default">Cancel</button>
                </div>
            </div>
  </div>




</div>
<!-- /.content-wrapper -->


<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>

<script type="text/javascript">
  $(document).ready(function() {
  
    $("#mainProductNav").addClass('active');
    $("#addProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Please dont click this &#128561;\')">' +
        '<i class="fa fa-tag"></i>' +
        '</button>'; 
    $("#profile_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: 'Profile',
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