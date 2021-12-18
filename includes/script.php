<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="../../plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->

<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="../../plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="../../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../../dist/js/pages/dashboard.js"></script>
<!--File Upload js file-->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!--sweetalert-->
<script src="../../plugins/sweetalert2/sweetalert.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="../../plugins/fullcalendar/main.js"></script>
<script src="//code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
<!--Datatable-->
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>
<!--Validation-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<!-- Toastr -->
<script src="../../plugins/toastr/toastr.min.js"></script>

<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
<script src="../../plugins/fileinput/fileinput.min.js"></script>
<!--daterange-->
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Ekko Lightbox -->
<script src="../../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>

<!-- Filterizr-->
<script src="../../plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- Bootstrap Switch -->
<script src="../../plugins/bootstrap-switch/js/bootstrap-switch.js"></script>

<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

</script>

<script>
//DataTable
$(document).ready(function() {
      $('#dataTable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" class="form-control" />' );
      });

    var table =  $("#dataTable").DataTable({
      "dom":"l<'row'<'col-sm-3 html5buttons'B><'col-sm-9'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "oLanguage": {
          "sLengthMenu": "Show _MENU_ records",
          "info": "Showing _START_ to _END_ of _TOTAL_ Records",
          "emptyTable": "No records available",
      },
      "aLengthMenu": [[5, 10, 15, 20, 50, 100, -1], [5, 10, 15, 20, 50, 100, 'All']],
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": false,
      "paginationType": 'full_numbers',
      /*"scrollY": "500px",
      "scrollCollapse": true,*/
      "buttons": [
            {
              extend: 'collection',
              text: '<i class="fas fa-list"></i>',
              className: 'btn-default',
              buttons: [{
                extend: 'excelHtml5',
                text: '<i class="fas fa-file-excel text-green"></i> Excel',
                titleAttr: 'Excel',
                className: 'btn-info',
            },
                {
                  extend: 'csvHtml5',
                  text: '<i class="fas fa-file-csv text-olive"></i> CSV',
                  titleAttr: 'CSV',
                  className: 'btn-success',
                },
                {
                  extend: 'pdfHtml5',
                  text: '<i class="fas fa-file-pdf text-danger"></i> PDF',
                  titleAttr: 'PDF',
                  className: 'btn-danger',
                },
                {
                  extend: 'print',
                  text: '<i class="fas fa-print text-dark"></i> Print',
                  titleAttr: 'Print',
                  className: 'btn-secondary',
                  /*exportOptions: {
                    stripHtml : false,
                  },*/
                },
              ]
            },
            {
              extend: 'colvis',
              text: '<i class="fas fa-columns"></i>',
              titleAttr: 'Colvis',
              className: 'btn-default ',
            },
            {
               extend:'',
               text: '<i class="fas fa-sync-alt"></i>',
               titleAttr: 'Refresh Table',
              className: 'btn-default',
            },
      ],
      initComplete: function () {
          this.api().columns().every( function () {
              var column = this;
              $( 'input', this.footer() ).on( 'keyup change clear', function () {
                  if ( column.search() !== this.value ) {
                      column.search( this.value ).draw();
                    }
              });
          });
      },
      infoCallback: function( settings, start, end, max, total, pre ) {
        return "Showing " + start +" to "+ end + " of " + total +" records ";
      }
 
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');

    /*$('.reloadTable').on('click', function(e){
    table.ajax.reload();
    console.log("hello");
    });*/
});

//File Upload name (Image)
$(function () {
  bsCustomFileInput.init();
});

//Alert Notification auto Slide UP
$("#success-alert").fadeTo(5000, 1000).slideUp(500, function(){
    $("#success-alert").slideUp(500);
});

</script>

<?php
    if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
      ?>
      <script>
        swal({
          title: "<?php echo $_SESSION['status']?>",
          icon: "<?php echo $_SESSION['status_code']?>",
          button: "OK",
          timer: 1300,
          customClass: {
            container: 'position-absolute',
          },
          position: 'bottom-right',
        });

      </script>
      <?php
      unset($_SESSION['status']);
    }
  ?>

<?php
    if(isset($_SESSION['cstatus']) && $_SESSION['cstatus'] != ''){
      ?>
      <script>
        swal({
          title: "<?php echo $_SESSION['cstatus']?>",
          icon: "<?php echo $_SESSION['cstatus_code']?>",
          button: "OK",
          timer: 1300,
        });
      </script>
      <?php
      unset($_SESSION['cstatus']);
    }
  ?>

