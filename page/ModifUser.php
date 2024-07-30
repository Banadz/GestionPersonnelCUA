<?php
    require_once("Database.php");
?>
<?php 	
    $num=$_GET['matri'];
?>
<?php
    $nom=$_POST["nom"];
    $_SESSION['name']=$nom;
    $prn=$_POST["prenom"];
    $mail=$_POST["mail"];
    $tel=$_POST["phone"];
    $adr=$_POST["adrs"];
    
    $mdp=$_POST["mdp"];

    $photo=$_FILES['photo']['name'];

    $file_tmp_name=$_FILES['photo']['tmp_name'];

    move_uploaded_file($file_tmp_name,"../profil/$photo");
    echo ("$photo");

    $modifier="UPDATE user set nom_admin='$nom',prenom_admin='$prn',mail_admin='$mail',tel_admin='$tel',adresse_admin='$adr',photo_admin='$photo',motdepasse='$mdp' where (id='$num') limit 1";
    mysql_query($modifier) or die(mysql_error());
    header("location:Home.php");
?>
