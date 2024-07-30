<?php

    session_start();

?>
<?php
    require("Database.php");
    include('include/Horloge.php');
	
    $mat=$_GET['matri'];
    $num=$_GET['num'];

        $apio="SELECT * from absence where numero='$num'";
        $valio=mysql_query($apio) or die(mysql_error());
        $vakio=mysql_fetch_assoc($valio);
        $sisa=$vakio['etat_pointage'];

        $select="SELECT total_abs, sexe_per from personnel where matricule='$mat'";
        $execut=mysql_query($select) or die(mysql_error());
        $resu=mysql_fetch_assoc($execut);
        $absence=$resu['total_abs'];
        $sex=$resu['sex_per'];

        
        $daty=date("Y-m-d");
        $jereo="SELECT valeur from stock where (daty='$daty')and (journe='$after')";
        $atsia=mysql_query($jereo) or die(mysql_error());
        $hita=mysql_fetch_assoc($atsia);
        $aia=$hita['valeur'];


    if (($sisa=="présent")||($sisa=="présente")){
        $vari=$_SESSION['name'];

        $changer="SELECT id, id_service from user where (nom_admin='$vari')";
        $changing=mysql_query($changer) or die(mysql_error());
        $changed=mysql_fetch_assoc($changing);
        $changeded=$changed['id'];
        $daty=date("Y-m-d");
        $tension=$changed['id_service'];

        if ($tension != 'Maire') {
            $marquer="INSERT INTO information(imma,id,section,ref,date_info) values ('','$changeded','pointage','$num','$daty')";
            mysql_query($marquer) or die(mysql_error());
        }

        if($sex=="F"){
            $statut='absente';
        }else{
            $statut='absent';
        }
        $tot_abs=($absence+1);

        $ovay="UPDATE absence set etat_pointage='$statut' where (numero='$num') limit 1";
        mysql_query($ovay) or die(mysql_error());

        $ovaykoa="UPDATE personnel set total_abs='$tot_abs' where (matricule='$mat') limit 1";
        mysql_query($ovaykoa) or die(mysql_error());

        $total=($aia+1);
        $daty=date("Y-m-d");

        $miova="UPDATE stock set valeur='$total' where (daty='$daty') and (journe='$after') limit 1";
        mysql_query($miova) or die(mysql_error());
        
        header("Location: VerificationPointage.php");
    }else{
        $vari=$_SESSION['name'];

        $changer="SELECT id, id_service from user where (nom_admin='$vari')";
        $changing=mysql_query($changer) or die(mysql_error());
        $changed=mysql_fetch_assoc($changing);
        $changeded=$changed['id'];
        $tension=$changed['id_service'];
        $daty=date("Y-m-d");

        if ($tension != 'Maire') {
            $marquer="INSERT INTO information(imma,id,section,ref,date_info) values ('','$changeded','pointage','$num','$daty')";
            mysql_query($marquer) or die(mysql_error());
        }

        $tot_abs=($absence-1);
        if($sex=='F'){
            $statut='présente';
        }else{
            $statut='présent';
        }
        $ovay="UPDATE absence set etat_pointage='$statut' where (numero='$num') limit 1";
        mysql_query($ovay) or die(mysql_error());

        $ovaykoa="UPDATE personnel set total_abs='$tot_abs' where (matricule='$mat') limit 1";
        mysql_query($ovaykoa) or die(mysql_error());

        $total=($aia-1);
        $daty=date("Y-m-d");

        $miova="UPDATE stock set valeur='$total' where (daty='$daty') and (journe='$after') limit 1";
        mysql_query($miova) or die(mysql_error());
        
        header("Location: VerificationPointage.php");
    }
    
?>