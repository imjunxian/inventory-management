<?php
include('../../database/security.php');
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
                <h1 class="m-0">Reports</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Reports</li>
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
                    <!--Pie-->
                    <div class="col-md-6">
                        <!-- AREA CHART -->
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Pie Chart (Sales by Brands)</h3>

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
                            <div class="chart">
                              <div id="chartdiv"></div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--End Pie-->

                     <!--Pie2-->
                    <div class="col-md-6">
                        <!-- AREA CHART -->
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Donut Chart (Sales by Category)</h3>

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
                            <div class="chart">
                              <div id="donutchartdiv"></div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--End Pie2-->
                </div>   

                 <div class="row">
                    <!--Bar-->
                    <div class="col-md-12">
                        <!-- AREA CHART -->
                        <div class="card">
                          <div class="card-header">
                            <h3 class="card-title">Sales Chart</h3>

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
                            <div class="chart">
                              <div id="barchartdiv"></div>
                            </div>
                          </div>
                          <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--End Bar-->
                </div><!--End Row-->

                 <div class="row">
                    <div class="col-6">
                    <form action="">
                        <div class="card">
                            <div class="card-header">

                                <h2 class="card-title">Monthly Sales</h2>
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

                                        <tbody>
                                            <tr>
                                                <th width="50%">Months</th>
                                                <th>Sales (RM)</th>
                                            </tr>
                                            <tr>
                                                <th>January</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>February</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>March</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>April</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>May</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>June</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>June</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>July</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>August</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>September</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>October</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>November</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>December</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align:right;">Total Sales (RM)</th>
                                                <td></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!--table responsive-->
                            </div>
                            <!-- /.card-body -->
                          
                        </div>
                        <!-- /.card -->
                    </form>  
          </div>
          <!-- /.col -->
  
                    <div class="col-6">
                    <form action="">
                        <div class="card">
                            <div class="card-header">

                                <h2 class="card-title">Monthly Profit</h2>
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

                                        <tbody>
                                            <tr>
                                                <th width="50%">Months</th>
                                                <th>Profit (RM)</th>
                                            </tr>
                                            <tr>
                                                <th>January</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>February</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>March</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>April</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>May</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>June</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>June</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>July</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>August</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>September</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>October</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>November</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th>December</th>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <th style="text-align:right;">Total Profits (RM)</th>
                                                <td></td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                                <!--table responsive-->
                            </div>
                            <!-- /.card-body -->
                          
                        </div>
                        <!-- /.card -->
                    </form>  
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

            </div>
        </section>    

</div>
<!-- /.content-wrapper -->


<?php
include('../../includes/script.php');
include('../../includes/footer.php');
?>

<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 300px;
}

</style>

<!-- Resources -->
<script src="https://cdn.amcharts.com/lib/4/core.js"></script>
<script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/material.js"></script>
<script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>
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
chart.data = [ {
  "country": "Lithuania",
  "litres": 501.9
}, {
  "country": "Czechia",
  "litres": 301.9
}, {
  "country": "Ireland",
  "litres": 201.1
}, {
  "country": "Germany",
  "litres": 165.8
}, {
  "country": "Australia",
  "litres": 139.9
}, {
  "country": "Austria",
  "litres": 128.3
}, {
  "country": "UK",
  "litres": 99
}
];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeOpacity = 1;

// This creates initial animation
pieSeries.hiddenState.properties.opacity = 1;
pieSeries.hiddenState.properties.endAngle = -90;
pieSeries.hiddenState.properties.startAngle = -90;

chart.hiddenState.properties.radius = am4core.percent(0);


}); // end am4core.ready()
</script>

<!-- donut Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("donutchartdiv", am4charts.PieChart);

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "litres";
pieSeries.dataFields.category = "country";

// Let's cut a hole in our Pie chart the size of 30% the radius
chart.innerRadius = am4core.percent(30);

// Put a thick white border around each Slice
pieSeries.slices.template.stroke = am4core.color("#fff");
pieSeries.slices.template.strokeWidth = 2;
pieSeries.slices.template.strokeOpacity = 1;
pieSeries.slices.template
  // change the cursor on hover to make it apparent the object can be interacted with
  .cursorOverStyle = [
    {
      "property": "cursor",
      "value": "pointer"
    }
  ];

pieSeries.alignLabels = false;
pieSeries.labels.template.bent = false;
pieSeries.labels.template.radius = 3;
pieSeries.labels.template.padding(0,0,0,0);

pieSeries.ticks.template.disabled = true;

// Create a base filter effect (as if it's not there) for the hover to return to
var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
shadow.opacity = 0;

// Create hover state
var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

// Slightly shift the shadow and make it more prominent on hover
var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
hoverShadow.opacity = 0.7;
hoverShadow.blur = 5;



chart.data = [{
  "country": "Lithuania",
  "litres": 501.9
},{
  "country": "Germany",
  "litres": 165.8
}, {
  "country": "Australia",
  "litres": 139.9
}, {
  "country": "Austria",
  "litres": 128.3
}, {
  "country": "UK",
  "litres": 99
}, {
  "country": "Belgium",
  "litres": 60
}];

}); // end am4core.ready()
</script>

<style type="text/css">
    #barchartdiv{
    width: 100%;
  height: 500px;
}
</style>

<!--Bar Chart code -->
<script>
am4core.ready(function() {

// Themes begin
am4core.useTheme(am4themes_animated);
// Themes end

// Create chart instance
var chart = am4core.create("barchartdiv", am4charts.XYChart);
chart.scrollbarX = new am4core.Scrollbar();

// Add data
chart.data = [{
  "Months": "Jan",
  "Sales": 60000
}, {
  "Months": "Feb",
  "Sales": 58000
}, {
  "Months": "Mar",
  "Sales": 69000
}, {
  "Months": "Apr",
  "Sales": 55000
}, {
  "Months": "May",
  "Sales": 52022
}, {
  "Months": "Jun",
  "Sales": 55100
},  {
  "Months": "Jul",
  "Sales": 47000
}, {
  "Months": "Aug",
  "Sales": 54294
}, {
  "Months": "Sep",
  "Sales": 59999
}, {
  "Months": "Oct",
  "Sales": 67000
}, {
  "Months": "Nov",
  "Sales": 63000
}, {
  "Months": "Dec",
  "Sales": 70000
}];

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
series.dataFields.valueY = "Sales";
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

}); // end am4core.ready()
</script>

<!-- Styles -->
<style>
#donutchartdiv {
  width: 100%;
  height: 300px;
}

</style>


