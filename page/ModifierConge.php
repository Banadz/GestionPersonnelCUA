<?php
require_once("Database.php");
?>
<?php

        //Modifier conge
    $numerotation=$_GET['matris'];
    $motif=$_POST['motif'];
    $nbr_jour=$_POST['nbr_jour'];
    $date_deb=$_POST['date_deb'];
    $date_fin=$_POST['date_fin'];

    $modifier="UPDATE conge set date_conge=now(),motif='$motif',nbr_jour='$nbr_jour',date_debut='$date_deb',date_fin='$date_fin',etat_conge='en attente' where (numerotation='$numerotation')";
    mysql_query($modifier) or die(mysql_error());
    header("location:Conge.php");
?>