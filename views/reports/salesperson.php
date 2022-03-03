<?php
include('../../database/security.php');
$title = "Report";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <?php
 if(($_SESSION['user_role'] != "SuperUser") && ($_SESSION['user_role'] != "Admin")){
    ?>
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Personal Sales Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Personal Report</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!--Order Table-->
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">

                <div class="card">
               
                    <div class="card-header">
                      <h2 class="card-title">Report</h2>
                      <button type="button" class="btn btn-secondary float-right" onclick="window.print();">
                         <i class="fa fa-print"></i> Print
                      </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <div class="table-responsive">

                        <table id="dataTableRe" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                                <th width="10px;">No</th>
                                <th>#Invoice No</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>DateTime</th>
                                <th>Status</th>
                                <th>Sales</th>
                                <th>Profits</th>
                            </tr>
                          </thead>
                            <tfoot>
                                <?php 
                                        $query_sum = "SELECT sum(sales), sum(profit) FROM orders WHERE salesperson='".$_SESSION["user_id"]."' AND orderStatus='Completed'";
                                        $query_sum_run = mysqli_query($connection, $query_sum); 

                                        if(mysqli_num_rows($query_sum_run) > 0){
                                            while($row_sum = mysqli_fetch_array($query_sum_run)){
                                                ?>
                                                
                                                <tr>
                                                    <th colspan="6" style="text-align:right;">Total : </th>
                                                    <th>RM <?php echo number_format($row_sum['sum(sales)'],2); ?></th>
                                                    <th>RM <?php echo number_format($row_sum['sum(profit)'],2); ?></th>
                                                </tr>
                              
                                                <?php
                                            }
                                        }
                                ?>
                            </tfoot>
                          <tbody>
                            <?php
                                $uid = $_SESSION['user_id'];
                                $query_sp = "SELECT * FROM orders WHERE salesperson='$uid' ORDER BY orderId DESC";
                                $query_sp_run = mysqli_query($connection, $query_sp); 
                                
                                if(mysqli_num_rows($query_sp_run) > 0){
                                    $n=0;
                                    while($row_sp = mysqli_fetch_array($query_sp_run)){
                                        $n++;
                                       ?> 
                                           <tr>
                                                <td><?php echo $n; ?></td>
                                              <td><?php $in = $row_sp['invoiceNo']; echo "#$in"; ?></td>
                                              <td><?php echo $row_sp['orderCustName']; ?></td>
                                              <td><?php echo $row_sp['orderCustContact']; ?></td>
                                              <td><?php echo $row_sp['orderDateTime']; ?></td>
                                              <td>
                                                  <?php
                                                    if($row_sp['orderStatus'] == 'Completed'){
                                                      ?>
                                                          <span class="badge badge-success">Completed</span>
                                                      <?php
                                                    }else if($row_sp['orderStatus'] == 'Pending'){
                                                      ?>
                                                          <span class="badge badge-warning">Pending</span>
                                                      <?php
                                                    }else if($row_sp['orderStatus'] == 'Cancelled'){
                                                      ?>
                                                          <span class="badge badge-danger">Cancelled</span>
                                                      <?php
                                                    }
                                                ?>
                                              </td>
                                              <td >RM <?php echo number_format($row_sp['sales'],2);?></td>
                                              <td >RM <?php echo number_format($row_sp['profit'],2); ?></td>
                                            </tr>
                                        <?php
                                    } //end while
                                } //end if 
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!--Table responsive-->
                    </div>
                    <!-- /.card-body -->

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
 }else{
    ?>
        <!-- Content Header (Page header) -->
        <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Sales Person Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Sales Person Report</li>
                </ol>
            </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!--Order Table-->
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">

            <div class="row">
              <div class="col-12">
                <div class="card">
               
                    <div class="card-header">
                      <h2 class="card-title">Report</h2>
                      <button type="button" class="btn btn-secondary float-right" onclick="window.print();">
                         <i class="fa fa-print"></i> Print
                      </button>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <form action="salesperson.php" method="POST" id="salespersonForm">
                                    <div class="input-group">
                                        <select type="select" name="salesperson" class="form-control multiselect" id="salesperson">
                                            <option value="" disabled selected>--- Select Sales Person ---</option>
                                             <?php
                                                 $records = mysqli_query($connection, "SELECT * FROM users");
                                                    while($data = mysqli_fetch_array($records)){
                                                        echo "<option value='". $data["userId"] ."'>".$data['userName']." ( ".$data['status']." ) - " .$data['userRoles'] ."</option>";
                                                    }
                                            ?>
                                        </select>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit" id="submit_Btn" name="submit_Btn" style="display: inline-block;">Generate</button>
                                            <!--<a href="../orders/salesperson.php?id=<?php echo $userid; ?>" class="btn btn-default" type="submit" name="submit_Btn" style="display: inline-block;">Generate</a>-->
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <br>
                      <div class="table-responsive">

                        <table id="dataTableRe" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                                <th width="10px;">No</th>
                                <th>#Invoice No</th>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>DateTime</th>
                                <th>Status</th>
                                <th>Sales</th>
                                <th>Profits</th>
                            </tr>
                          </thead>
                            <tfoot>
                                <?php 
                                    if(isset($_POST['submit_Btn'])){                                       
                                        if($_POST['salesperson'] != "" && $_POST['salesperson'] != null){       
                                            $uid = $_POST['salesperson'];
                                        }else{
                                            $uid = $_SESSION["user_id"];
                                        } 
                                    }else{
                                        $uid = $_SESSION["user_id"];
                                    }
                                    $query_sum = "SELECT sum(sales), sum(profit) FROM orders WHERE salesperson='$uid' AND orderStatus='Completed'";
                                        $query_sum_run = mysqli_query($connection, $query_sum); 

                                        if(mysqli_num_rows($query_sum_run) > 0){
                                            while($row_sum = mysqli_fetch_array($query_sum_run)){
                                                ?>
                                                
                                                <tr>
                                                    <th colspan="6" style="text-align:right;">Total : </th>
                                                    <th>RM <?php echo number_format($row_sum['sum(sales)'],2); ?></th>
                                                    <th>RM <?php echo number_format($row_sum['sum(profit)'],2); ?></th>
                                                </tr>
                              
                                                <?php
                                            }
                                        }
                                ?>
                            </tfoot>
                          <tbody>
                            <?php
                            if(isset($_POST['submit_Btn'])){
                                if($_POST['salesperson'] != "" && $_POST['salesperson'] != null){       
                                    $uid = $_POST['salesperson'];
                                }else{
                                    $uid = $_SESSION["user_id"];
                                }   
                            }else{
                                $uid = $_SESSION["user_id"];
                            }
                            $query_sp = "SELECT * FROM orders WHERE salesperson='$uid' ORDER BY orderId DESC";
                                $query_sp_run = mysqli_query($connection, $query_sp); 
                                
                                if(mysqli_num_rows($query_sp_run) > 0){
                                    $n=0;
                                    while($row_sp = mysqli_fetch_array($query_sp_run)){
                                        $n++;
                                       ?> 
                                           <tr>
                                            <td><?php echo $n; ?></td>
                                              <td><?php $in = $row_sp['invoiceNo']; echo "#$in"; ?></td>
                                              <td><?php echo $row_sp['orderCustName']; ?></td>
                                              <td><?php echo $row_sp['orderCustContact']; ?></td>
                                              <td><?php echo $row_sp['orderDateTime']; ?></td>
                                              <td>
                                                  <?php
                                                    if($row_sp['orderStatus'] == 'Completed'){
                                                      ?>
                                                          <span class="badge badge-success">Completed</span>
                                                      <?php
                                                    }else if($row_sp['orderStatus'] == 'Pending'){
                                                      ?>
                                                          <span class="badge badge-warning">Pending</span>
                                                      <?php
                                                    }else if($row_sp['orderStatus'] == 'Cancelled'){
                                                      ?>
                                                          <span class="badge badge-danger">Cancelled</span>
                                                      <?php
                                                    }
                                                ?>
                                              </td>
                                              <td >RM <?php echo number_format($row_sp['sales'],2);?></td>
                                              <td >RM <?php echo number_format($row_sp['profit'],2); ?></td>
                                            </tr>
                                        <?php
                                    } //end while
                                } //end if 
                            ?>
                          </tbody>
                        </table>
                      </div>
                      <!--Table responsive-->
                    </div>
                    <!-- /.card-body -->

                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>

           <!-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-lg-3 col-md-6 col-sm-12">
                                <form action="#" method="POST">
                                <div class="input-group" style="">
                                <select class="form-control multiselect" id="reportYear" name="reportYear">
                                    <?php
                                    $query_ye = "SELECT * FROM orders WHERE orderStatus = 'Completed' GROUP BY orderYear AND orderMonth";
                                    $query_ye_run = mysqli_query($connection, $query_ye);
                                        while($row_ye = mysqli_fetch_assoc($query_ye_run)){
                                            $old_date = $row_ye["orderMonth"];  
                                            $old_date_timestamp = strtotime($old_date);
                                            $new_date = date('m', $old_date_timestamp);  
                                            ?>
                                            <option value="<?php echo $row_ye["orderYear"].'-'.$row_ye["orderMonth"] ?>" <?php if(date("Y") == $row_ye["orderYear"]) { echo "selected"; } ?>><?php echo $row_ye["orderYear"].'-'.$new_date?></option>
                                            <?php
                                            
                                        }
                                    ?>
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="subBtn" style="display: inline-block;">Submit</button>
                                </span>
                              </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>-->

            <!-- /.row -->
            <div class="row">
              <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Sales Person (Sales)</h2>
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
                                  $query_tt = "SELECT sum(sales) FROM orders WHERE orderStatus='Completed'";
                                  $query_tt_run = mysqli_query($connection, $query_tt);
                                  $row_tt = mysqli_fetch_assoc($query_tt_run);
                                  ?>
                                  <h6>
                                    Total Sales: <span class="text-dark"><b>RM <?php echo number_format($row_tt["sum(sales)"],2); ?></b></span>

                                  </h6>
                                  <?php
                                ?>
                        </div>
                         <div id="chartdiv"></div>
                    </div>
                </div>
            </div>
        </div>

          <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Sales Person (Profits)</h2>
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
                                  $query_ttp = "SELECT sum(profit) FROM orders WHERE orderStatus='Completed'";
                                  $query_ttp_run = mysqli_query($connection, $query_ttp);
                                  $row_ttp = mysqli_fetch_assoc($query_ttp_run);
                                  ?>
                                  <h6>
                                    Total Profits: <span class="text-dark"><b>RM <?php echo number_format($row_ttp["sum(profit)"],2); ?></b></span>

                                  </h6>
                                  <?php
                                ?>
                        </div>
                         <div id="prodiv"></div>
                    </div>
                </div>
            </div>
        </div>

          </div>
          <!-- /.container-fluid -->
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

<script type="text/javascript">
if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

  $(document).ready(function() {
    $('.multiselect').select2({
      theme: 'bootstrap4',   
    });
  });

   $(function() {

    $('#salespersonForm').validate({
      rules: {
        salesperson: {
          required: true,
        },

      },
      messages: {
        salesperson: {
          required: "Salesperson is required.",
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

<script type="text/javascript">

    $("#dataTableRe").DataTable({
      "dom":"l<'row'<'col-sm-3'B><'col-sm-9'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        "oLanguage": {
          "sLengthMenu": "Show _MENU_ records",
      },
      "aLengthMenu": [[10, 15, 20, 50, 100, -1], [10, 15, 20, 50, 100, 'All']],
      "responsive": true,
      "lengthChange": true,
      "autoWidth": false,
      "paginationType": 'full_numbers',
      buttons: [
            /*{
                extend: 'pageLength',
                titleAttr: 'pageLength',
                className: 'btn-default',
            },*/
            {
                extend: 'collection',
                text: '<i class="fas fa-list"></i>',
                className: 'btn-default',
                buttons: [
                  {
                      extend: 'excelHtml5',
                      text: '<i class="fas fa-file-excel text-green"></i> Excel',
                      titleAttr: 'Excel',
                      className: 'btn-info',
                      exportOptions: {
                            stripHtml: false
                      },
                  },
                  {
                      extend: 'csvHtml5',
                      text: '<i class="fas fa-file-csv text-olive"></i> CSV',
                      titleAttr: 'CSV',
                      className: 'btn-success',
                      exportOptions: {
                            stripHtml: false
                      },
                  },
                  {
                      extend: 'pdfHtml5',
                      text: '<i class="fas fa-file-pdf text-danger"></i> PDF',
                      titleAttr: 'PDF',
                      className: 'btn-danger',
                      exportOptions: {
                            stripHtml: false
                      },
                  },
                  {
                      extend: 'print',
                      text: '<i class="fas fa-print text-dark"></i> Print',
                      titleAttr: 'Print',
                      className: 'btn-secondary',
                      exportOptions: {
                              stripHtml : false,
                      },
                  },
                ],
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
      infoCallback: function( settings, start, end, max, total, pre ) {
        return "Showing " + start +" to "+ end + " of " + total +" records ";
      }
    }).buttons().container().appendTo('#dataTable_wrapper .col-md-6:eq(0)');

</script>



<style>
#chartdiv {
  width: 100%;
  height: 450px;
}

#prodiv {
  width: 100%;
  height: 450px;
}

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>


<?php

 $query_sas = "SELECT orders.sales AS persales, users.userName, sum(sales) AS sales FROM orders INNER JOIN users ON orders.salesperson = users.userId WHERE orders.orderStatus='Completed' GROUP BY orders.salesperson";
 $query_sas_run = mysqli_query($connection, $query_sas);

?>

<!-- Chart code -->
<script>
am4core.addLicense("ch-custom-attribution");
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("chartdiv", am4charts.XYChart);
chart.padding(40, 40, 40, 40);

var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "user";
categoryAxis.renderer.minGridDistance = 1;
categoryAxis.renderer.inversed = true;
categoryAxis.renderer.grid.template.disabled = true;

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryY = "user";
series.dataFields.valueX = "sales";
series.tooltipText = "{valueX.value}"
series.columns.template.strokeOpacity = 0;
series.columns.template.column.cornerRadiusBottomRight = 5;
series.columns.template.column.cornerRadiusTopRight = 5;

var labelBullet = series.bullets.push(new am4charts.LabelBullet())
labelBullet.label.horizontalCenter = "left";
labelBullet.label.dx = 10;
labelBullet.label.text = "{values.valueX.workingValue.formatNumber('#.0as')}";
labelBullet.locationX = 1;

// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
series.columns.template.adapter.add("fill", function(fill, target){
  return chart.colors.getIndex(target.dataItem.index);
});

categoryAxis.sortBySeries = series;
chart.data = [ 
    <?php
    while($row_sales = mysqli_fetch_assoc($query_sas_run)){
        echo '{ 
            "user": "'.$row_sales["userName"].'", 
            "sales": "'.$row_sales["sales"].'", 
        },';
    }
    ?>
]

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
chart.legend = new am4charts.Legend();

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
 $query_pros = "SELECT orders.profit AS perprofit, users.userName, sum(profit) AS profit FROM orders INNER JOIN users ON orders.salesperson = users.userId WHERE orders.orderStatus='Completed' GROUP BY orders.salesperson";
 $query_pros_run = mysqli_query($connection, $query_pros);

?>

<!-- Chart code -->
<script>
am4core.addLicense("ch-custom-attribution");
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

var chart = am4core.create("prodiv", am4charts.XYChart);
chart.padding(40, 40, 40, 40);

var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.dataFields.category = "user";
categoryAxis.renderer.minGridDistance = 1;
categoryAxis.renderer.inversed = true;
categoryAxis.renderer.grid.template.disabled = true;

var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
valueAxis.min = 0;

var series = chart.series.push(new am4charts.ColumnSeries());
series.dataFields.categoryY = "user";
series.dataFields.valueX = "sales";
series.tooltipText = "{valueX.value}"
series.columns.template.strokeOpacity = 0;
series.columns.template.column.cornerRadiusBottomRight = 5;
series.columns.template.column.cornerRadiusTopRight = 5;

var labelBullet = series.bullets.push(new am4charts.LabelBullet())
labelBullet.label.horizontalCenter = "left";
labelBullet.label.dx = 10;
labelBullet.label.text = "{values.valueX.workingValue.formatNumber('#.0as')}";
labelBullet.locationX = 1;

// as by default columns of the same series are of the same color, we add adapter which takes colors from chart.colors color set
series.columns.template.adapter.add("fill", function(fill, target){
  return chart.colors.getIndex(target.dataItem.index);
});

categoryAxis.sortBySeries = series;
chart.data = [ 
    <?php
    while($row_profit = mysqli_fetch_assoc($query_pros_run)){
        echo '{ 
            "user": "'.$row_profit["userName"].'", 
            "sales": "'.$row_profit["profit"].'", 
        },';
    }
    ?>
]

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
chart.legend = new am4charts.Legend();

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
