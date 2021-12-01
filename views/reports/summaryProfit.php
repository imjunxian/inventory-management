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
                <h1 class="m-0">Summary Profits Report</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Summary Profits Report</li>
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

                 <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-xl-3 col-md-6 col-sm-12">
                                <form action="summaryProfit.php" method="POST">
                                <div class="input-group" style="">
                                <!--<input type="text" class="form-control" name="datepicker" id="datepicker"  placeholder="Select Year" />-->
                                <select class="form-control multiselect" id="reportYear" name="reportYear">
                                    <?php
                                    $query_ye = "SELECT * FROM orders WHERE orderStatus = 'Completed' GROUP BY orderYear";
                                    $query_ye_run = mysqli_query($connection, $query_ye);
                                        while($row_ye = mysqli_fetch_assoc($query_ye_run)){
                                            ?>
                                            <option value="<?php echo $row_ye["orderYear"]?>" <?php if(date("Y") == $row_ye["orderYear"]) { echo "selected"; } ?>><?php echo $row_ye["orderYear"]?></option>
                                            <?php
                                            
                                        }
                                    ?>
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit" name="submit_Btn" style="display: inline-block;">Submit</button>
                                </span>
                              </div>
                            </form>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>


                 <div class="row">
                    <!--Bar-->
                    <div class="col-md-12">
                        <!-- AREA CHART -->
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Profit Chart</h3>

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
                            <br>
                            <div class="chart">
                              <div id="barchartdiv"></div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                          <!--<div class="card-footer">
                                     <button type="button" class="btn btn-primary" onclick='window.location.href="../reports/totalSales.php"'>
                                    Total Sales Report <i class="fa fa-chart-pie"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick='window.location.href="../reports/sales.php"'>
                                    Sales Report <i class="fa fa-chart-pie"></i>
                                    </button>
                            </div>-->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--End Bar-->
                </div><!--End Row-->



        <div class="row">
                    <div class="col-12">
                    <form action="">
                        <div class="card">
                            <div class="card-header">

                                <h2 class="card-title">Profit Summary</h2>
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
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                    <th width="50%">Year-Months</th>
                                                    <th>Profits (RM)</th>
                                                </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            if(isset($_POST['submit_Btn'])){
                                                $year = $_POST['reportYear'];
                                            }else{
                                                $year = date('Y');
                                            }
                                             $query = $connection -> prepare("SELECT *, sum(profit) FROM orders WHERE orderStatus = 'Completed' AND orderYear='$year' GROUP BY orderMonth ORDER BY orderMonth DESC");
                                            $query->execute(); 
                                            $result = $query->get_result(); 
                                            if($result > "0"){
                                                while($row = $result -> fetch_assoc()){
                                                ?>
                                                <tr>
                                                    <th>
                                                        <?php 
                                                        $old = strtotime($row["orderMonth"]);
                                                        $new = date('m', $old);
                                                        echo $year."-".$new; 
                                                        ?>                                 
                                                    </th>
                                                    <td><b>RM <?php echo number_format($row["sum(profit)"],2) ;?></b></td>
                                                </tr>                                           
                                                <?php
                                                }
                                            }
                                            ?>    
                                        </tbody>
                                        <tbody>
                                            <?php
                                            if(isset($_POST['submit_Btn'])){
                                                $year = $_POST['reportYear'];
                                            }else{
                                                $year = date('Y');
                                            }
                                             $query = $connection -> prepare("SELECT sum(profit) FROM orders WHERE orderStatus = 'Completed' AND orderYear='$year'");
                                            $query->execute(); 
                                            $result = $query->get_result(); 
                                            if($result > "0"){
                                                while($row = $result -> fetch_assoc()){
                                                ?>
                                                <tr>
                                                    <th style="text-align:right;">Total Profits (RM)</th>
                                                    <td><b>RM <?php echo number_format($row["sum(profit)"],2) ;?></b></td>
                                                </tr>                                         
                                                <?php
                                                }
                                            }
                                            ?>    
                                        </tbody>
                                    </table>
                                </div>
                                <!--table responsive-->
                            </div>
                            <!-- /.card-body -->
                            <!--<div class="card-footer">
                                     <button type="button" class="btn btn-primary" onclick='window.location.href="../reports/totalSales.php"'>
                                    Total Sales Report <i class="fa fa-chart-pie"></i>
                                    </button>
                                    <button type="button" class="btn btn-primary" onclick='window.location.href="../reports/sales.php"'>
                                    Sales Report <i class="fa fa-chart-pie"></i>
                                    </button>
                            </div>-->
                        </div>
                        <!-- /.card -->
                    </form>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

            </div>
        </section>

            <?php
  }
  ?>

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
<!--Pie Chart code -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" rel="stylesheet"/>


<?php
if(isset($_POST["submit_Btn"])){
    $today_year = $_POST["reportYear"];
}else{
    $today_year = date('Y');
}

    $query = $connection -> prepare("SELECT *, sum(profit) FROM orders WHERE orderStatus = 'Completed' AND orderYear='$today_year' GROUP BY orderMonth DESC");
    $query->execute(); 
    $result = $query->get_result(); 

    /*$final_data = array();
    foreach ($months as $month_k => $month_y) {
    $get_mon_year = $year.'-'.$month_y; 

    $final_data[$get_mon_year][] = '';
        foreach ($result as $k => $v) {
            $month_year = date('Y-m', $v['orderYear']);

            if($get_mon_year == $month_year) {
                $final_data[$get_mon_year][] = $v;
            }
        }
    }   */

?>


<script type="text/javascript">
    $("#datepicker").datepicker({
      format: " yyyy",
      viewMode: "years",
      minViewMode: "years",
      autoclose:true //to close picker once year is selected
    });
</script>

<style type="text/css">
    #barchartdiv{
    width: 100%;
  height: 500px;
}
</style>

<!--Bar Chart code -->
<script>
am4core.addLicense("ch-custom-attribution");
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("barchartdiv", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

// Add data
chart.data = [
<?php
 while($row = $result -> fetch_assoc()){
    ?>
        {
            "Months": 
            <?php 
            $old = strtotime($row["orderMonth"]);
            $new = date('F', $old);
            echo '"'.$new.'"'
            ?>,
            "Profit": 
            <?php 
            if($row["sum(profit)"] == ""){
                echo "0";
            }else{
                echo $row["sum(profit)"];
            }
            ?>,
        },
    <?php
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

// Create axes
var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
categoryAxis.dataFields.category = "Months";
categoryAxis.renderer.grid.template.location = 0;
categoryAxis.renderer.minGridDistance = 30;
categoryAxis.renderer.labels.template.horizontalCenter = "middle";
categoryAxis.renderer.labels.template.verticalCenter = "middle";
categoryAxis.renderer.labels.template.rotation = 0;
categoryAxis.tooltip.disabled = true;
categoryAxis.renderer.minHeight = 110;

var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
valueAxis.renderer.minWidth = 50;

// Create series
var series = chart.series.push(new am4charts.ColumnSeries());
series.sequencedInterpolation = true;
series.dataFields.valueY = "Profit";
series.dataFields.categoryX = "Months";
series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
series.columns.template.strokeWidth = 0;

series.tooltip.pointerOrientation = "vertical";

series.columns.template.column.cornerRadiusTopLeft = 10;
series.columns.template.column.cornerRadiusTopRight = 10;
series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
var hoverState = series.columns.template.column.states.create("hover");
hoverState.properties.cornerRadiusTopLeft = 0;
hoverState.properties.cornerRadiusTopRight = 0;
hoverState.properties.fillOpacity = 1;

series.columns.template.adapter.add("fill", function(fill, target) {
  return chart.colors.getIndex(target.dataItem.index);
});

// Cursor
chart.cursor = new am4charts.XYCursor();

// Enable export
chart.exporting.menu = new am4core.ExportMenu();
chart.exporting.menu.verticalAlign = "bottom";
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



<script type="text/javascript">
    if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
     $(document).ready(function() {
    $('.multiselect').select2({
      theme: 'bootstrap4'
    });
});   
</script>
