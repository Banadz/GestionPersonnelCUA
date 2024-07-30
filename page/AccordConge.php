<?php
    require("Database.php");
	
    $acc=$_GET['matri'];
    $ref=$_GET['cule'];

    if (isset($acc)){
        $modifier="UPDATE conge set etat_conge='accordé' where (numerotation='$acc') limit 1";
        mysql_query($modifier) or die(mysql_error());
        $apio="SELECT conge_restant from personnel where matricule='$acc'";
        $valio=mysql_query($apio) or die(mysql_error());
        $vakio=mysql_fetch_assoc($valio);
        $sisa=$vakio['conge_restant'];
        $tavela=($sisa-1);

        $ovay="UPDATE personnel set conge_restant='$tavela' where (matricule='$acc') limit 1";
        mysql_query($ovay) or die(mysql_error());
        
        header("Location: ValidationConge.php");
    }else{
        $modifier="UPDATE conge set etat_conge='refusé' where (numerotation='$ref') limit 1";
        mysql_query($modifier) or die(mysql_error());

        header("Location: ValidationConge.php");
    }
    
?>