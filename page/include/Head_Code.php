<?php

    session_start();

?>
<?php if (empty($_SESSION['name'])) {
     
	
	header("location:Login.php");
 
}

?>
<?php
	$anarany=$_SESSION['name'];
    $getSary="SELECT * from user where (nom_admin='$anarany')";
    $answer=mysql_query($getSary) or die(mysql_error());
	$nombre=mysql_num_rows($answer);
	$sary=mysql_fetch_assoc($answer);

	$pic=$sary['photo_admin'];
	$cat=$sary['id_service'];
	$_SESSION['id_cat']=$sary['id_service'];

	$test2="SELECT * FROM service where (id_service='$cat')";
	$val=mysql_query($test2) or die(mysql_error());
	$service=mysql_fetch_assoc($val);
	$_SESSION['cat']=$service['label_service'];
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../image/JMA.jpg" type="image/x-icon"/>
	
	<!-- Loading -->
	<link href="../css/loading/pace.min.css" rel="stylesheet"/>
  	<script src="../css/loading/pace.min.js"></script>
	
	
	<!--Full Calendar Css-->
	<link href="include/jsUtil/css/fullcalendar.css" rel='stylesheet'/>
	<!-- end -->
	<!-- Custom Style-->
	<link href="include/jsUtil/stilCall/css/app-style.css" rel="stylesheet"/>

	<!-- Fonts and icons -->
	<script src="assets/js/plugin/webfont/webfont.min.js"></script>

	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">

	<!-- Custom template | don't include it in your project! -->
	<?php 	include("include/Custom.php");	 ?>

	<!-- End Custom template -->
<script type="text/javascript">
	function getTime(){
		var d = new Date();
		var heure =d.getHours();
		var minutes =d.getMinutes();
		var seconde = d.getSeconds();
		if(heure < 10){
			heure = '0'+heure;
		}
		if(minutes < 10){
			minutes = '0'+minutes;
		}
		if(seconde <10){
			seconde = '0'+seconde;
		}
		document.getElementById('h').innerHTML = heure;
		document.getElementById('mn').innerHTML = minutes;
		document.getElementById('s').innerHTML = seconde;
		setTimeout("getTime()",1000);
	}

</script>