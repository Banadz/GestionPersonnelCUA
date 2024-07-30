<?php
    require_once("Database.php");
?>
<?php

    $type=$_POST['type'];
    $nom=$_POST['name'];
    $prenom=$_POST['prenom'];
    $sexe=$_POST['sexe'];
    $mail=$_POST['mail'];
    $telephone=$_POST['telephone'];
    $adress=$_POST['adresse'];
    $mdp=$_POST['mpd'];
    $code=$_POST['code'];

    // avoir la photo

    $nomphoto=$_FILES['photo']['name'];

    $depalced=$_FILES['photo']['tmp_name'];
    move_uploaded_file($depalced,"../profil/$nomphoto");

    $inserer="INSERT INTO user(id_service,nom_admin,prenom_admin,sexe,mail_admin,tel_admin,adresse_admin,photo_admin,motdepasse,code) values ('$type','$nom','$prenom','$sexe','$mail','$telephone','$adress','$nomphoto','$mdp','$code')";
    mysql_query($inserer) or die(mysql_error());
    header("location:GestionUser.php");
?>