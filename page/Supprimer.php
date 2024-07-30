<?php
 session_start();
require_once("Database.php");
?>
<?php
    
    $matricule=$_GET['matri'];
    $supprimer="DELETE FROM personnel where (matricule='$matricule') limit 1";
    mysql_query($supprimer) or die(mysql_error());

    $vari=$_SESSION['name'];

    $changer="SELECT id, id_service from user where (nom_admin='$vari')";
    $changing=mysql_query($changer) or die(mysql_error());
    $changed=mysql_fetch_assoc($changing);
    $changeded=$changed['id'];
    $tension=$changed['id_service'];
    $daty=date("Y-m-d");
    
    if($tension != "Maire"){
        $marquer="INSERT INTO information(imma,id,section,ref,date_info) values ('','$changeded','suppressionPersonnel','$matricule','$daty')";
        mysql_query($marquer) or die(mysql_error());
    }
    header("location:AffichePersonnel.php");
?>