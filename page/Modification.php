<?php
    require_once("Database.php");
?>
<?php 	
    $num=$_GET['matri'];
?>
<?php
    $nom=$_POST["nom"];
    $conge=$_POST["conge"];
    $abs=$_POST["abs"];
    $sx=$_POST["sx"];
    $prn=$_POST["prenom"];
    $idc=$_POST["index"];
    $fct=$_POST["fonct"];
    $sct=$_POST["sect"];
    $cdr=$_POST["cadre"];
    $cin=$_POST["cin"];
    $tel=$_POST["tel"];
    $adr=$_POST["adrs"];
    $photo=$_FILES['photo']['name'];
    
   
    $file_tmp_name=$_FILES['photo']['tmp_name'];
    move_uploaded_file($file_tmp_name,"../profil/$photo");
?>
<?php
    $modifier="UPDATE personnel set total_abs='$abs',conge_restant='$conge',nom_per='$nom',prenom_per='$prn',sexe_per='$sx',indice='$idc',cadre='$cdr',fonction='$fct',statut='$sct',adresse='$adr',telephone='$tel',photo='$photo' where (matricule='$num') limit 1";
    mysql_query($modifier) or die(mysql_error());
    header("location:AffichePersonnel.php");
?>
