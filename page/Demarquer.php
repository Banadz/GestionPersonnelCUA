<?php

    session_start();

?>
<?php
    require("Database.php");
    include('include/Horloge.php');
?>
<?php
    
    $identite=$_GET['iteration'];
    $reference=$_GET['ref'];

    $demarque="DELETE from `gestionpersonnel`.`information`WHERE `information`.`imma` ='$identite'";
    mysql_query($demarque) or die(mysql_error());

    header("location:VerificationPointage.php?ref=$reference");
?>