<?php
include('../../database/security.php');
$title = "Settings";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<style type="text/css">

.list-group {
    display: flex;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    border-radius: 0.25rem;
}

.list-group-item-action {
    width: 100%;
    color: #4d5154;
    text-align: inherit;
}
.list-group-item-action:hover,
.list-group-item-action:focus {
    z-index: 1;
    color: #4d5154;
    text-decoration: none;
    background-color: #f4f6f9;
}
.list-group-item-action:active {
    color: #8e9194;
    background-color: #eef0f3;
}

.list-group-item {
    position: relative;
    display: block;
    padding: 0.75rem 1.25rem;
    background-color: #ffffff;
    border: 1px solid #eef0f3;
}
.list-group-item:first-child {
    border-top-left-radius: inherit;
    border-top-right-radius: inherit;
}
.list-group-item:last-child {
    border-bottom-right-radius: inherit;
    border-bottom-left-radius: inherit;
}
.list-group-item.disabled,
.list-group-item:disabled {
    color: #6d7174;
    pointer-events: none;
    background-color: #ffffff;
}
.list-group-item.active {
    z-index: 2;
    color: #ffffff;
    background-color: #1b68ff;
    border-color: #1b68ff;
}
.list-group-item + .list-group-item {
    border-top-width: 0;
}
.list-group-item + .list-group-item.active {
    margin-top: -1px;
    border-top-width: 1px;
}

.list-group-horizontal {
    flex-direction: row;
}
.list-group-horizontal > .list-group-item:first-child {
    border-bottom-left-radius: 0.25rem;
    border-top-right-radius: 0;
}
.list-group-horizontal > .list-group-item:last-child {
    border-top-right-radius: 0.25rem;
    border-bottom-left-radius: 0;
}
.list-group-horizontal > .list-group-item.active {
    margin-top: 0;
}
.list-group-horizontal > .list-group-item + .list-group-item {
    border-top-width: 1px;
    border-left-width: 0;
}
.list-group-horizontal > .list-group-item + .list-group-item.active {
    margin-left: -1px;
    border-left-width: 1px;
}

@media (min-width: 576px) {
    .list-group-horizontal-sm {
        flex-direction: row;
    }
    .list-group-horizontal-sm > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
    }
    .list-group-horizontal-sm > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
    }
    .list-group-horizontal-sm > .list-group-item.active {
        margin-top: 0;
    }
    .list-group-horizontal-sm > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
    }
    .list-group-horizontal-sm > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
    }
}

@media (min-width: 768px) {
    .list-group-horizontal-md {
        flex-direction: row;
    }
    .list-group-horizontal-md > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
    }
    .list-group-horizontal-md > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
    }
    .list-group-horizontal-md > .list-group-item.active {
        margin-top: 0;
    }
    .list-group-horizontal-md > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
    }
    .list-group-horizontal-md > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
    }
}

@media (min-width: 992px) {
    .list-group-horizontal-lg {
        flex-direction: row;
    }
    .list-group-horizontal-lg > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
    }
    .list-group-horizontal-lg > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
    }
    .list-group-horizontal-lg > .list-group-item.active {
        margin-top: 0;
    }
    .list-group-horizontal-lg > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
    }
    .list-group-horizontal-lg > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
    }
}

@media (min-width: 1200px) {
    .list-group-horizontal-xl {
        flex-direction: row;
    }
    .list-group-horizontal-xl > .list-group-item:first-child {
        border-bottom-left-radius: 0.25rem;
        border-top-right-radius: 0;
    }
    .list-group-horizontal-xl > .list-group-item:last-child {
        border-top-right-radius: 0.25rem;
        border-bottom-left-radius: 0;
    }
    .list-group-horizontal-xl > .list-group-item.active {
        margin-top: 0;
    }
    .list-group-horizontal-xl > .list-group-item + .list-group-item {
        border-top-width: 1px;
        border-left-width: 0;
    }
    .list-group-horizontal-xl > .list-group-item + .list-group-item.active {
        margin-left: -1px;
        border-left-width: 1px;
    }
}

.list-group-flush {
    border-radius: 0;
}
.list-group-flush > .list-group-item {
    border-width: 0 0 1px;
}
.list-group-flush > .list-group-item:last-child {
    border-bottom-width: 0;
}

.list-group-item-primary {
    color: #0e3685;
    background-color: #bfd5ff;
}
.list-group-item-primary.list-group-item-action:hover,
.list-group-item-primary.list-group-item-action:focus {
    color: #0e3685;
    background-color: #a6c4ff;
}
.list-group-item-primary.list-group-item-action.active {
    color: #ffffff;
    background-color: #0e3685;
    border-color: #0e3685;
}

.list-group-item-secondary {
    color: #0a395d;
    background-color: #bdd6ea;
}
.list-group-item-secondary.list-group-item-action:hover,
.list-group-item-secondary.list-group-item-action:focus {
    color: #0a395d;
    background-color: #aacae4;
}
.list-group-item-secondary.list-group-item-action.active {
    color: #ffffff;
    background-color: #0a395d;
    border-color: #0a395d;
}

.list-group-item-success {
    color: #107259;
    background-color: #c0f5e8;
}
.list-group-item-success.list-group-item-action:hover,
.list-group-item-success.list-group-item-action:focus {
    color: #107259;
    background-color: #aaf2e0;
}
.list-group-item-success.list-group-item-action.active {
    color: #ffffff;
    background-color: #107259;
    border-color: #107259;
}

.list-group-item-info {
    color: #005d83;
    background-color: #b8eafe;
}
.list-group-item-info.list-group-item-action:hover,
.list-group-item-info.list-group-item-action:focus {
    color: #005d83;
    background-color: #9fe3fe;
}
.list-group-item-info.list-group-item-action.active {
    color: #ffffff;
    background-color: #005d83;
    border-color: #005d83;
}

.list-group-item-warning {
    color: #855701;
    background-color: #ffe7b8;
}
.list-group-item-warning.list-group-item-action:hover,
.list-group-item-warning.list-group-item-action:focus {
    color: #855701;
    background-color: #ffde9f;
}
.list-group-item-warning.list-group-item-action.active {
    color: #ffffff;
    background-color: #855701;
    border-color: #855701;
}

.list-group-item-danger {
    color: #721c24;
    background-color: #f5c6cb;
}
.list-group-item-danger.list-group-item-action:hover,
.list-group-item-danger.list-group-item-action:focus {
    color: #721c24;
    background-color: #f1b0b7;
}
.list-group-item-danger.list-group-item-action.active {
    color: #ffffff;
    background-color: #721c24;
    border-color: #721c24;
}

.list-group-item-light {
    color: #7f8081;
    background-color: #fcfcfd;
}
.list-group-item-light.list-group-item-action:hover,
.list-group-item-light.list-group-item-action:focus {
    color: #7f8081;
    background-color: #ededf3;
}
.list-group-item-light.list-group-item-action.active {
    color: #ffffff;
    background-color: #7f8081;
    border-color: #7f8081;
}

.list-group-item-dark {
    color: #17191c;
    background-color: #c4c5c6;
}
.list-group-item-dark.list-group-item-action:hover,
.list-group-item-dark.list-group-item-action:focus {
    color: #17191c;
    background-color: #b7b8b9;
}
.list-group-item-dark.list-group-item-action.active {
    color: #ffffff;
    background-color: #17191c;
    border-color: #17191c;
}
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Notification Settings</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Notification Settings</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mt-2">Notifications Settings</h5>
                        </div>
                        <div class="card-body">
                                <strong class="mb-0">System</strong>
                                <p>Please enable system alert you will get.</p>
                                <div class="list-group mb-5 shadow-sm">
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong class="mb-0">Notify me by product for latest news</strong>
                                                <p class="text-muted mb-0">Notification of new product added</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="alert1" checked="" />
                                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" style="width: 86px;">
                                                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: -42px;">
                                                            <span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 42px;">ON</span>
                                                            <span class="bootstrap-switch-label" style="width: 42px;">&nbsp;</span>
                                                            <span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 42px;">OFF</span>
                                                            <input id="onoff" type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="checked">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list-group-item">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <strong class="mb-0">Notify me by purchasing order for latest news</strong>
                                                <p class="text-muted mb-0">Notification of new PO added</p>
                                            </div>
                                            <div class="col-auto">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="alert1" checked="" />
                                                    <div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-focused bootstrap-switch-animate bootstrap-switch-off" style="width: 86px;">
                                                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: -42px;">
                                                            <span class="bootstrap-switch-handle-on bootstrap-switch-primary" style="width: 42px;">ON</span>
                                                            <span class="bootstrap-switch-label" style="width: 42px;">&nbsp;</span>
                                                            <span class="bootstrap-switch-handle-off bootstrap-switch-default" style="width: 42px;">OFF</span>
                                                            <input id="onoff" type="checkbox" name="my-checkbox" checked="" data-bootstrap-switch="checked">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>




</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
     $("input[id=onoff]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
</script>

<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>