<?php
include('../../database/security.php');
$title = "Notes";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<style type="text/css">

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid transparent;
    border-radius: 10px;
}
.card {
    margin-bottom: 30px;
}
.card-body {
    flex: 1 1 auto;
    padding: 1.57rem;
}

 .note-has-grid .nav-link {
     padding: .5rem
 }

 .note-has-grid .single-note-item .card {
     border-radius: 10px
 }

 .note-has-grid .single-note-item .favourite-note {
     cursor: pointer
 }

 .note-has-grid .single-note-item .side-stick {
     position: absolute;
     width: 3px;
     height: 35px;
     left: 0;
     background-color: rgba(82, 95, 127, .5)
 }

 .note-has-grid .single-note-item .category-dropdown.dropdown-toggle:after {
     display: none
 }

 .note-has-grid .single-note-item .category [class*=category-] {
     height: 15px;
     width: 15px;
     display: none
 }

 .note-has-grid .single-note-item .category [class*=category-]::after {
     content: "\f0d7";
     font: normal normal normal 14px/1 FontAwesome;
     font-size: 12px;
     color: #fff;
     position: absolute
 }

 .note-has-grid .single-note-item .category .category-business {
     background-color: rgba(44, 208, 126, .5);
     border: 2px solid #2cd07e
 }

 .note-has-grid .single-note-item .category .category-social {
     background-color: rgba(44, 171, 227, .5);
     border: 2px solid #2cabe3
 }

 .note-has-grid .single-note-item .category .category-important {
     background-color: rgba(255, 80, 80, .5);
     border: 2px solid #ff5050
 }

 .note-has-grid .single-note-item.all-category .point {
     color: rgba(82, 95, 127, .5)
 }

 .note-has-grid .single-note-item.note-business .point {
     color: rgba(44, 208, 126, .5)
 }

 .note-has-grid .single-note-item.note-business .side-stick {
     background-color: rgba(44, 208, 126, .5)
 }

 .note-has-grid .single-note-item.note-business .category .category-business {
     display: inline-block
 }

 .note-has-grid .single-note-item.note-favourite .favourite-note {
     color: #ffc107
 }

 .note-has-grid .single-note-item.note-social .point {
     color: rgba(44, 171, 227, .5)
 }

 .note-has-grid .single-note-item.note-social .side-stick {
     background-color: rgba(44, 171, 227, .5)
 }

 .note-has-grid .single-note-item.note-social .category .category-social {
     display: inline-block
 }

 .note-has-grid .single-note-item.note-important .point {
     color: rgba(255, 80, 80, .5)
 }

 .note-has-grid .single-note-item.note-important .side-stick {
     background-color: rgba(255, 80, 80, .5)
 }

 .note-has-grid .single-note-item.note-important .category .category-important {
     display: inline-block
 }

 .note-has-grid .single-note-item.all-category .more-options,
 .note-has-grid .single-note-item.all-category.note-favourite .more-options {
     display: block
 }

 .note-has-grid .single-note-item.all-category.note-business .more-options,
 .note-has-grid .single-note-item.all-category.note-favourite.note-business .more-options,
 .note-has-grid .single-note-item.all-category.note-favourite.note-important .more-options,
 .note-has-grid .single-note-item.all-category.note-favourite.note-social .more-options,
 .note-has-grid .single-note-item.all-category.note-important .more-options,
 .note-has-grid .single-note-item.all-category.note-social .more-options {
     display: none
 }

 @media (max-width:767.98px) {
     .note-has-grid .single-note-item {
         max-width: 100%
     }
 }

 @media (max-width:991.98px) {
     .note-has-grid .single-note-item {
         max-width: 250px;
     }
 }
</style>

<!-- Modal Add notes -->
    <div class="modal fade" id="addnotesmodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">           
            <div class="modal-content border-0">
                <form action="code.php" id="addnotesmodalTitle" method="POST">
                 <div class="modal-header">
                    <h4 class="modal-title">New Note</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                           
                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Note Title</label>
                                            <input type="text" id="note-has-title" class="form-control" placeholder="Title" name="title"/>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Note Description</label>
                                            <textarea id="note-has-description" class="form-control" placeholder="Description" rows="5" name="desc"></textarea>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>

                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="addBtn" id="btn-n-add">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal Update notes -->
    <div class="modal fade" id="updatenotesmodal" tabindex="-1" role="dialog" aria-labelledby="addnotesmodalTitle" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">           
            <div class="modal-content border-0">
                <form action="code.php" id="updatenotesmodalTitle" method="POST">
                 <div class="modal-header">
                    <h4 class="modal-title">Edit Note</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                           
                                <div class="row">

                                    <input type="hidden" id="upnoteId" class="form-control" placeholder="id" name="upnoteid"/>
                                  
                                    <div class="col-md-12 mb-3">
                                        <div class="form-group">
                                            <label>Note Title</label>
                                            <input type="text" id="upnote-has-title" class="form-control" placeholder="Title" name="uptitle"/>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Note Description</label>
                                            <textarea id="upnote-has-description" class="form-control" placeholder="Description" rows="5" name="updesc"></textarea>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>

                    <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="updateBtn" id="btn-n-update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Notes</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Notes</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


<div class="page-content container note-has-grid">

    <?php
        if (isset($_SESSION['statusEmail']) && $_SESSION['statusEmail'] != '') {
            echo '
                    <div class="alert alert-danger alert-dismissible" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-exclamation-circle"></i>  ' . $_SESSION['statusEmail'] . '
                    </div>
                ';
            unset($_SESSION['statusEmail']);
        }
        if (isset($_SESSION['statusSuccess']) && $_SESSION['statusSuccess'] != '') {
            echo '
                    <div class="alert alert-success alert-dismissible" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <i class="fa fa-check-circle"></i>  ' . $_SESSION['statusSuccess'] . '
                    </div>
                ';
            unset($_SESSION['statusSuccess']);
        }
    ?>

    <!--<div class="form-group">
        <div class="alert alert-danger alert-dismissible" >
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <i class="fa fa-exclamation-circle"></i> <span class="text-justify" id="message"></span>
        </div>
    </div>-->

    <ul class="nav nav-pills p-3 bg-white mb-3 align-items-center" style="border-radius:10px;">
        <li class="nav-item">
            <p class="h4">All Notes</p>
        </li>

        
        <li class="nav-item ml-auto">
            <a href="javascript:void(0)" class="nav-link btn-primary  d-flex align-items-center px-3" id="add-notes" data-toggle="modal" data-target="#addnotesmodal"> <span class="font-14" style="color:white;"> <i class="fa fa-plus"></i> New Note</span></a>
        </li>
    </ul>

    <div class="tab-content bg-transparent">


        <div id="note-full-container " class="note-has-grid row d-flex justify-content-center justify-content-sm-start">

            <?php
                $id = $_SESSION["user_id"];
                $query = $connection -> prepare("SELECT * FROM notes WHERE userId=? ORDER BY Id DESC");
                $query -> bind_param("i", $id);
                $query->execute(); 
                $result = $query->get_result();

                if ($result > '0') {
                    while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-md-4 single-note-item all-category">
                        <div class="card card-body shadow">
                            <span class="side-stick" style="background:#17a2b8;"></span>
                            <input type="hidden" name="noteId" value="<?php echo $row["Id"];?>">
                            <h5 class="note-title text-truncate w-75 mb-0"><?php echo $row["title"];?></h5>
                            <p class="note-date font-12 text-muted"><?php echo $row["date"];?></p>
                            <div class="note-content">
                                <?php 
                                  $str = $row['description'];                          
                                  $strr = strip_tags($str, '<br>');
                                  echo "<p class=\"note-inner-content text-muted text-dark\">".$strr."</p>";
                                ?>
                            </div>
                            <div class="d-flex align-items-center">
                                <a href="#" class="btn btn-sm btn-primary editBtn" data-id="<?php echo $row["Id"]; ?>" data-toggle="tooltip" title="Edit <?php echo $row["title"]; ?>"><i class="fa fa-pen edit-note"></i></a>&nbsp;
                                <a href="#" class="btn btn-sm btn-danger deleteBtn" data-id="<?php echo $row["Id"]; ?>" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash remove-note" data-toggle="tooltip" title="Remove <?php echo $row["title"]; ?>"></i></a>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
            ?>        
        </div>
        
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
  
                    </ul>
                </nav>
            </div>
        </div>

    </div>

</div>



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
          <p>Select "Delete" below if you want to delete note.</p>
          <p class="text-danger">*Caution: Changes cannot be made after delete successful.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="code.php" method="POST">
            <input type="hidden" name="deleteid" value="" />
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
 $(function () {
    $('.single-note-item').on('click', 'a.deleteBtn', function(e) {
        e.preventDefault();
        var link = this;
        var deleteModal = $("#deleteModal");
        // store the ID inside the modal's form
        deleteModal.find('input[name=deleteid]').val(link.dataset.id);
        // open modal
        deleteModal.modal();
    });
});

//retrieve data in modal (notes)
$(document).ready(function(){
    $('.editBtn').on('click', function(){
        var notesId = $(this).attr("data-id");
        $.ajax({
            url:"ajax.php",
            type:"POST",
            data:{notesId:notesId},
            dataType: "json",
            success: function(data){
                $('#upnote-has-title').val(data.title);
                $('#upnote-has-description').val(data.description);
                $('#upnoteId').val(data.Id);

                $('#btn-n-update').val('.editBtn');
                $('#updatenotesmodal').modal('show');
            },
            error: function (data) {
                alert("Something went wrong");
            },
        });
    });

    /*$('#btn-n-add').on('click', function(){
        var notesId = $(this).attr("data-id");
        $.ajax({
            url:"ajax.php",
            type:"POST",
            data:{notesId:notesId},
            dataType: "json",
            success: function(data){
                $('#note-has-title').val();
                $('#upnote-has-description').val(data.description);
                $('#upnoteId').val(data.Id);

                $('#btn-n-update').val('.editBtn');
                $('#updatenotesmodal').modal('show');
            },
        });
    });*/

});

if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
}

$(function() {
    //Add Customer Form
    $('#addnotesmodalTitle').validate({
      rules: {
        title: {
          required: true,
        },
        desc: {
          required: true,
        },
      },
      messages: {
        title: {
          required: "Title is required",
        },
        desc: {
          required: "Description is required",
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

    $('#updatenotesmodalTitle').validate({
      rules: {
        uptitle: {
          required: true,
        },
        updesc: {
          required: true,
        },
      },
      messages: {
        uptitle: {
          required: "Title is required",
        },
        updesc: {
          required: "Description is required",
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

<script type="text/javascript">
    function getPageList(totalPages, page, maxLength){
      function range(start, end){
        return Array.from(Array(end - start + 1), (_, i) => i + start);
      }

      var sideWidth = maxLength < 9 ? 1 : 2;
      var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
      var rightWidth = (maxLength - sideWidth * 2 - 3) >> 1;

      if(totalPages <= maxLength){
        return range(1, totalPages);
      }

      if(page <= maxLength - sideWidth - 1 - rightWidth){
        return range(1, maxLength - sideWidth - 1).concat(0, range(totalPages - sideWidth + 1, totalPages));
      }

      if(page >= totalPages - sideWidth - 1 - rightWidth){
        return range(1, sideWidth).concat(0, range(totalPages- sideWidth - 1 - rightWidth - leftWidth, totalPages));
      }

      return range(1, sideWidth).concat(0, range(page - leftWidth, page + rightWidth), 0, range(totalPages - sideWidth + 1, totalPages));
    }

    $(function(){
      var numberOfItems = $(".single-note-item .card").length;
      var limitPerPage = 6; //How many card items visible per a page
      var totalPages = Math.ceil(numberOfItems / limitPerPage);
      var paginationSize = 7; //How many page elements visible in the pagination
      var currentPage;

      function showPage(whichPage){
        if(whichPage < 1 || whichPage > totalPages) return false;

        currentPage = whichPage;

        $(".single-note-item .card").hide().slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage).show();

        $(".pagination li").slice(1, -1).remove();

        getPageList(totalPages, currentPage, paginationSize).forEach(item => {
          $("<li>").addClass("page-item").addClass(item ? "current-page" : "dots")
          .toggleClass("active", item === currentPage).append($("<a>").addClass("page-link")
          .attr({href: "javascript:void(0)"}).text(item || "...")).insertBefore(".next-page");
        });

        $(".previous-page").toggleClass("disable", currentPage === 1);
        $(".next-page").toggleClass("disable", currentPage === totalPages);
        return true;
      }

      $(".pagination").append(
        $("<li>").addClass("page-item").addClass("previous-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Previous")),
        $("<li>").addClass("page-item").addClass("next-page").append($("<a>").addClass("page-link").attr({href: "javascript:void(0)"}).text("Next"))
      );

      $(".card-content").show();
      showPage(1);

      $(document).on("click", ".pagination li.current-page:not(.active)", function(){
        return showPage(+$(this).text());
      });

      $(".next-page").on("click", function(){
        return showPage(currentPage + 1);
      });

      $(".previous-page").on("click", function(){
        return showPage(currentPage - 1);
      });
    });
</script>