<?php
include('../..//database/security.php');
$title = "Company";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

     <?php
  if(($_SESSION['user_role'] != "SuperUser")){
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
                <h1 class="m-0">Company</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="../dashboard/">Home</a></li>
                <li class="breadcrumb-item active">Company</li>
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
      <div class="col-xl-12 col-md-6 mb-3">
        <div class="card card-outline card-primary shadow">
          <div class="card-body" id="profile">
            <div class="row  align-items-center">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <div>
                            <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                <i class="fa fa-building" style="font-size: 50px;"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <?php
                    $com = 1;
                    $query = $connection -> prepare("SELECT * FROM company where companyId=?");
                    $query -> bind_param("i", $com);
                    $query->execute(); 
                    $result = $query->get_result(); 

                    if($result > '0'){
                        while($row = $result -> fetch_assoc()){
                        ?>
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5>Name : <b><?php echo $row["companyName"]; ?></b></h5>
                                    <h6 class="mt-1 text-sm">
                                    Email : <b><?php echo $row["email"]; ?></b>
                                    </h6>
                                    <h6 class="mt-1 text-sm">PhoneNo : <b><?php echo $row["contact"]; ?></b></h6>
                                </div>
                            </div>   
                        <?php
                        }
                    }
                ?>          
            </div>
            <div></div>
          </div>
        </div>
      </div>   
    </div>


        <div class="row">
          <div class="col-12">
          <?php
          if(isset($_SESSION["user_id"])){

            $query = "SELECT * FROM company WHERE companyId=1";
            $query_run = mysqli_query($connection, $query);

                foreach ($query_run as $row){
                ?>
                    <form action="code.php" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Company</h2>                            
                                <button type="submit" class="btn btn-primary float-right" name="editBtn">
                                Edit <i class="fa fa-pencil-alt"></i>
                                </button>
                            </div>

                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="table" class="table table-hover">

                                        <tbody>
                                            <tr>
                                                <th><i class="fa fa-building"></i> Company Name</th>
                                                <td><?php echo $row['companyName']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-envelope"></i> Email</th>
                                                <td><?php echo $row['email']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-phone-alt"></i> PhoneNo</th>
                                                <td><?php echo $row['contact']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-map-marker-alt"></i> Address 1</th>
                                                <td><?php echo $row['address1']?></td>
                                            </tr>
                                             <tr>
                                                <th><i class="fa fa-map-marker-alt"></i> Address 2</th>
                                                <td><?php echo $row['address2']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-map-pin"></i> Postcode</th>
                                                <td><?php echo $row['postcode']?></td>
                                            </tr>
                                            <tr>
                                                <th><i class="fa fa-city"></i> City</th>
                                                <td><?php echo $row['city']?></td>
                                            </tr>
                                             <tr>
                                                <th><i class="fa fa-city"></i> State</th>
                                                <td><?php echo $row['state']?></td>
                                            </tr>
                                             <tr>
                                                <th><i class="fa fa-flag"></i> Country</th>
                                                <td><?php echo $row['country']?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!--table responsive-->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer"><br></div>
                        </div>
                        <!-- /.card -->
                    </form>
                <?php
                }
            }
            ?>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!--Map API-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Google Maps</h2>                            
                    </div>

                    <div class="card-body">
                        <div id="map"></div>
                    </div>

                    <div class="card-footer">
                        
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
 <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCd62WwUBWwl-8_6mvycgMFVHxB8WhDuaA&callback=initMap&libraries=&v=weekly&channel=2"
      async
    ></script>

<script type="text/javascript">
    // Initialize and add the map
    function initMap() {
      // The location of Uluru
      const uluru = { lat: -25.344, lng: 131.036 };
      // The map, centered at Uluru
      const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 4,
        center: uluru,
        mapTypeId: "roadmap",
      });
      // The marker, positioned at Uluru
      const marker = new google.maps.Marker({
        position: uluru,
        map: map,
      });
    }
    /*function loadMap(){
        var bt = {lat: 5.4380, lng: 100.3882};
        maps = new google.maps.Map(document.getElementById('maps'), {
          zoom: 12,
          center: bt
        });

        var marker = new google.maps.Marker({
          position: bt,
          map: maps
        });
,
        var cdata = JSON.parse(document.getElementById('data').innerHTML);
        geocoder = new google.maps.Geocoder();  
        codeAddress(cdata);

        var allData = JSON.parse(document.getElementById('allData').innerHTML);
        showAllColleges(allData)

    }

    function showAllColleges(allData) {
    var infoWind = new google.maps.InfoWindow;
    Array.prototype.forEach.call(allData, function(data){
        var content = document.createElement('div');
        var strong = document.createElement('strong');
        
        strong.textContent = data.name;
        content.appendChild(strong);

        var img = document.createElement('img');
        img.src = 'img/Leopard.jpg';
        img.style.width = '100px';
        content.appendChild(img);

        var marker = new google.maps.Marker({
          position: new google.maps.LatLng(data.lat, data.lng),
          map: map
        });

        marker.addListener('mouseover', function(){
            infoWind.setContent(content);
            infoWind.open(map, marker);
        })
    })
}

function codeAddress(cdata) {
   Array.prototype.forEach.call(cdata, function(data){
        var address = data.name + ' ' + data.address;
        geocoder.geocode( { 'address': address}, function(results, status) {
          if (status == 'OK') {
            map.setCenter(results[0].geometry.location);
            var points = {};
            points.id = data.id;
            points.lat = map.getCenter().lat();
            points.lng = map.getCenter().lng();
            updateCollegeWithLatLng(points);
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
    });
}

function updateCollegeWithLatLng(points) {
    $.ajax({
        url:"action.php",
        method:"post",
        data: points,
        success: function(res) {
            console.log(res)
        }
    })*/

</script>