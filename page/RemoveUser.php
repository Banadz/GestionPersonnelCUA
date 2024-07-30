<?php
require_once("Database.php");
?>
<?php
    
    $matricule=$_GET['matri'];
    $supprimer="DELETE FROM user where (id='$matricule') limit 1";
    mysql_query($supprimer) or die(mysql_error());

    $selects="SELECT photo_admin from user";
	$answers=mysql_query($selects) or die(mysql_error());
    $use=mysql_fetch_assoc($answers);
    // $nomphoto=$use['photo_admin'];
    
    header("location:GestionUser.php");

?>