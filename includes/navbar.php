<?php
//include('loading.php'); 
if ($_SESSION["user_role"] == "SuperUser" || $_SESSION["user_role"] == "Admin" || $_SESSION["user_role"] == "Staff") {
  if(isset($_SESSION['timeout'])){
    if((time() - $_SESSION['timeout']) > 3600){
      session_unset();
      session_destroy();
      header("Location:../auth/index.php?sessiontimeout");
      exit();
    }
  }
  include('navbar_user.php'); 
}

?>


<div class="loader"></div>
<style type="text/css">
  .loader{
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('../../dist/img/806.gif') 
              50% 50% no-repeat rgb(249,249,249);

}
</style>

<script type="text/javascript">
/*function onReady(callback) {
  var intervalId = window.setInterval(function() {
    if (document.getElementsByTagName('body')[0] !== undefined) {
      window.clearInterval(intervalId);
      callback.call(this);
    }
  }, 500);
}

function setVisible(selector, visible) {
  document.querySelector(selector).style.display = visible ? 'block' : 'none';
}

onReady(function() {
  setVisible('body', true);
  setVisible('.loader', false);
});*/

//loader while loading
document.onreadystatechange = function () {
    if (document.readyState !== "complete") {
        document.querySelector(
            "body").style.visibility = "hidden";
        document.querySelector(
            ".loader").style.visibility = "visible";
    } else {
        document.querySelector(
            ".loader").style.display = "none";
        document.querySelector(
            "body").style.visibility = "visible";
    }
};

</script>