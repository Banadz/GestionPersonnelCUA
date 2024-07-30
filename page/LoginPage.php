<?php
session_start();
?>

<?php
  $_SESSION['name']="";
?>
<?php
require_once("Database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- loadding -->
  <link href="../css/loading/pace.min.css" rel="stylesheet"/>
  <script src="../css/loading/pace.min.js"></script>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LoginPage</title>
  <link rel="shortcut icon" href="../image/JMA.jpg" />
  <!-- plugins:css -->
  <link rel="stylesheet" href="../design_login/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../design_login/vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../design_login/css/style.css">
</head>
<script type="text/javascript">
        function updateClock(){
            var now =new Date () ;
            var dname=now.getDay(),
                mo=now.getMonth(),
                dnum=now.getDate();
                yr=now.getFullYear(),
                hou=now.getHours(),
                min=now.getMinutes(),
                sec=now.getSeconds()
                ;

               
            var months =["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Aout","Septembre","Octobre","Novembre","Decembre"];    
            var week =["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi",];
            var ids=["dayname","month","daynum","year","hour","minutes","secondes",];
            var values= [week[dname],months[mo],dnum,yr,hou,min,sec];
            for(var i=0; i<ids.length ;i++ )
            document.getElementById(ids[i]).firstChild.nodeValue=values[i];
        }  
        function initClock(){
            updateClock();
            window.setInterval("updateClock()",1);
        }
        
</script>
<style>
    body{
    background-image: url("../image/CUApic4.jpg");
    background-size:cover;
    height:100%;
    width:100%;
    
  }
</style>
<body>
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto" style="background-color:rgba(25, 35, 50,0.8); margin-top:5%;">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="../design_login/vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="../design_login/js/off-canvas.js"></script>
  <script src="../design_login/js/hoverable-collapse.js"></script>
  <script src="../design_login/js/template.js"></script>
  <!-- endinject -->
</body>

</html>
