<?php
require_once("Database.php");
?>
<?php

        //inserer conge

    $matri=$_GET['matris'];

    $motif=$_POST['motif'];
    $date_deb=$_POST['date_deb'];
    $date_fin=$_POST['date_fin'];

    $date="SELECT (DATEDIFF('$date_fin','$date_deb')+1) as nbr";
    $traite=mysql_query($date) or die(mysql_error());
    $resulting=mysql_fetch_assoc($traite);
    $nbr=$resulting['nbr'];

    $inserer="INSERT INTO conge(date_conge,matricule,motif,nbr_jour,date_debut,date_fin,etat_conge)values(now(),'$matri','$motif','$nbr','$date_deb','$date_fin','en attente')";
    mysql_query($inserer) or die(mysql_error());
    header("location:Conge.php");
?>