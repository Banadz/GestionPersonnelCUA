<?php
require_once("Database.php");
?>
<?php

        //inserer un etudiant

    $nom=$_POST['name'];
    $prenom=$_POST['prenom'];
    $cadre=$_POST['cadre'];
    $cin=$_POST['cin'];
    $sx=$_POST['sx'];
    $fonction=$_POST['fonction'];
    $section=$_POST['section'];
    $datenais=$_POST['daten'];
    $indice=$_POST['indice'];
    $adress=$_POST['adres'];
    $tel=$_POST['phone'];
    $enfant=$_POST['nbr_enf'];
    $photo=$_FILES['photo']['name'];
    
    $file_tmp_name=$_FILES['photo']['tmp_name'];
    move_uploaded_file($file_tmp_name,"../profil/$photo");

    $inserer="INSERT INTO personnel(conge_restant,matricule,nom_per,prenom_per,sexe_per,cin_per,fonction,statut,cadre,date_naiss,indice,adresse,telephone,nbr_enfant,photo)values(40,'','$nom','$prenom','$sex','$cin','$fonction','$section','$cadre','$datenais','$indice','$adress','$tel','$enfant','$photo')";
    mysql_query($inserer) or die(mysql_error());
    header("location:AffichePersonnel.php");
?>