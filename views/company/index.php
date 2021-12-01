<?php
include('../..//database/security.php');
$title = "Company";
include('../../includes/header.php');
include('../../includes/navbar.php');
?>

<!--Add Toggles-->
<div class="modal fade" id="addForm">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Company</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="code.php" id="addF" method="post">
        <div class="modal-body">
            <div class="form-group">
                <label for="username">Company Name</label>
                <input type="text" class="form-control" id="name"  placeholder="Name" name="name">
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email"  placeholder="Email" name="email">
            </div>

            <div class="form-group">
                <label for="contact">PhoneNo</label>
                <input type="text" class="form-control" id="contact"  placeholder="Phone Number" name="contact">
            </div>

            <div class="form-group">
                <label for="contact">Address 1</label>
                <input type="text" class="form-control" id="add1"  placeholder="Address 1" name="add1">
            </div>

            <div class="form-group">
                <label for="contact">Address 2</label>
                <input type="text" class="form-control" id="add2"  placeholder="Address 2" name="add2">
            </div>

            <div class="form-group">
                <label for="contact">Postcode</label>
                <input type="text" class="form-control" id="postcode"  placeholder="Postcode" name="postcode">
            </div>

            <div class="form-group">
                <label for="contact">City</label>
                <input type="text" class="form-control" id="city"  placeholder="City" name="city">
            </div>

            <div class="form-group">
                <label for="contact">State</label>
                <select class="form-control multiselect" id="state" placeholder="State" name="state">>
                    <option value="" selected disabled>Select State</option>
                    <option value="Johor">Johor</option>
                    <option value="Kedah">Kedah</option>
                    <option value="Kelantan">Kelantan</option>
                    <option value="Malacca">Malacca</option>
                    <option value="Negeri Sembilan">Negeri Sembilan</option>
                    <option value="Pahang">Pahang</option>
                    <option value="Penang">Penang</option>
                    <option value="Perak">Perak</option>
                    <option value="Perlis">Perlis</option>
                    <option value="Sabah">Sabah</option>
                    <option value="Sarawak">Sarawak</option>
                    <option value="Selangor">Selangor</option>
                    <option value="Terengganu">Terengganu</option>
                    <option value="Kuala Lumpur">Kuala Lumpur</option>
                    <option value="Labuan">Labuan</option>
                    <option value="Putrajaya">Putrajaya</option>
                </select>
            </div>

            <div class="form-group">
                <label for="contact">Country</label>
                <input type="text" class="form-control" id="scountry" placeholder="Country" name="hscountry" value="Malaysia" disabled>
                <input type="hidden" class="form-control" id="scountry" placeholder="Country" name="scountry" value="Malaysia" >
            </div>
        </div>
        <!--Submit button-->
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="addBtn">Add</button>
        </div>
      </form>
      <!--Form end-->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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
          <div class="col-xl-12 col-md-12 mb-3">
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
                        $query = "SELECT * FROM company";
                        $result = mysqli_query($connection,$query);
                        if(mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_assoc($result)){
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
                        }else{
                            ?>
                                <p class="h5">No Data</p>
                            <?php
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

            $query = "SELECT * FROM company";
            $query_run = mysqli_query($connection, $query);

                if(mysqli_num_rows($query_run) > 0){
                    foreach ($query_run as $row){
                    ?>
                        <form action="code.php" method="POST">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Company</h2>                            
                                    <button type="submit" class="btn btn-primary float-right" name="editBtn">
                                    <i class="fa fa-pencil-alt"></i> Edit
                                    </button>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table" class="table table-hover">

                                            <tbody>
                                                <input type="hidden" name="comid" value="<?php echo $row['companyId']?>" class="form-control">
                                                <tr>
                                                    <th width="40%"><i class="fa fa-building"></i> Company Name</th>
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
                }else{
                    ?>
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="card-title">Company</h2>                            
                                    <button type="submit" class="btn btn-primary float-right" name="addBtn" data-toggle="modal" data-target="#addForm">
                                    <i class="fa fa-plus"></i> Add
                                    </button>
                                </div>

                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="table" class="table table-hover">
                                            <tbody>
                                                <br>
                                                <p class="text-center text-secondary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 93 87" style="width: 120px;"><defs><rect id="defaultpage_nodata-a" width="45" height="33" x="44" y="32" rx="2"></rect><mask id="defaultpage_nodata-b" width="45" height="33" x="0" y="0" fill="#fff" maskContentUnits="userSpaceOnUse" maskUnits="objectBoundingBox"><use xlink:href="#defaultpage_nodata-a"></use></mask></defs><g fill="none" fill-rule="evenodd" transform="translate(-3 -4)"><rect width="96" height="96"></rect><ellipse cx="48" cy="85" fill="#F2F2F2" rx="45" ry="6"></ellipse><path fill="#FFF" stroke="#D8D8D8" d="M79.5,17.4859192 L66.6370555,5.5 L17,5.5 C16.1715729,5.5 15.5,6.17157288 15.5,7 L15.5,83 C15.5,83.8284271 16.1715729,84.5 17,84.5 L78,84.5 C78.8284271,84.5 79.5,83.8284271 79.5,83 L79.5,17.4859192 Z"></path><path fill="#DBDBDB" fill-rule="nonzero" d="M66,6 L67.1293476,6 L67.1293476,16.4294956 C67.1293476,17.1939227 67.7192448,17.8136134 68.4469198,17.8136134 L79,17.8136134 L79,19 L68.4469198,19 C67.0955233,19 66,17.849146 66,16.4294956 L66,6 Z"></path><g fill="#D8D8D8" transform="translate(83 4)"><circle cx="7.8" cy="10.28" r="3" opacity=".5"></circle><circle cx="2" cy="3" r="2" opacity=".3"></circle><path fill-rule="nonzero" d="M10.5,1 C9.67157288,1 9,1.67157288 9,2.5 C9,3.32842712 9.67157288,4 10.5,4 C11.3284271,4 12,3.32842712 12,2.5 C12,1.67157288 11.3284271,1 10.5,1 Z M10.5,7.10542736e-15 C11.8807119,7.10542736e-15 13,1.11928813 13,2.5 C13,3.88071187 11.8807119,5 10.5,5 C9.11928813,5 8,3.88071187 8,2.5 C8,1.11928813 9.11928813,7.10542736e-15 10.5,7.10542736e-15 Z" opacity=".3"></path></g><path fill="#FAFAFA" d="M67.1963269,6.66851903 L67.1963269,16.32 C67.2587277,17.3157422 67.675592,17.8136134 68.4469198,17.8136134 C69.2182476,17.8136134 72.735941,17.8136134 79,17.8136134 L67.1963269,6.66851903 Z"></path><use fill="#FFF" stroke="#D8D8D8" stroke-dasharray="3" stroke-width="2" mask="url(#defaultpage_nodata-b)" xlink:href="#defaultpage_nodata-a"></use><rect width="1" height="12" x="54" y="46" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="17" x="62" y="40" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="10" x="70" y="48" fill="#D8D8D8" rx=".5"></rect><rect width="1" height="14" x="78" y="43" fill="#D8D8D8" rx=".5"></rect></g></svg>
                                                    <p class=" text-center text-secondary">Please Add Your Company Info</p>
                                                </p>
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                    <!--table responsive-->
                                </div>
                                <!-- /.card-body -->
                                <div class="card-footer"><br></div>
                            </div>
                            <!-- /.card -->
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

<script>
  $(document).ready(function() {
    $('.multiselect').select2({
      theme: 'bootstrap4',
      closeOnSelect: true,
    });
  });   

</script>

<script>
  $(function () {
  /*$.validator.setDefaults({
    submitHandler: function () {
      window.location.href = "profile.php";
    }
  });*/

  $.validator.addMethod(
      "regex",
      function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
      },
      "Please check your input."
    );

  $('#addF').validate({
    rules: {
      email: {
        required: true,
        email: true,
        regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i
      },
      add1: {
        required: true
      },
      add2: {
        required: true
      },
      name: {
        required: true
      },
      contact: {
        required: true,
        minlength:10,
        digits: true
      },
      city: {
        required: true
      },
      state: {
        required: true
      },
      postcode: {
        required: true
      },
      scountry:{
        required: true
      },
    },
    messages: {
      email: {
        required: "Please enter a email",
        email: "Please enter a vaild email",
        regex: "Please enter a valid email"
      },
      add1: {
        required: "Please provide address 1"
      },
      add2: {
        required: "Please provide address 2"
      },
      name: {
        required: "Please provide name"
      },
      contact: {
        required: "Please provide a contact number",
        minlength: "Please enter valid phone number eg. 0123456789"
      },
      city:{
        required: "Please provide city"
      },
      state: {
        required: "Please provide state"
      },
      postcode: {
        required: "Please provide postcode"
      },
      scountry:{
        required: "Please provide country"
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>

<script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>