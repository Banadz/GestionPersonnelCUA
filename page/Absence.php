<?php

    session_start();

?>
<?php
    require("Database.php");
    include('include/Horloge.php');
    
    // compter le nombre de jour
    $daty=date("Y-m-d");
    $requete="SELECT*from absence  GROUP BY(date_pointage)";
    $query=mysql_query($requete) or die(mysql_error());
    $resulting=mysql_num_rows($query);

    // au plus de 5, on doit vider la table
    if(($resulting > 5)||(($aujourdhui="Lundi")&&($after=="Matin"))){
        $vider="TRUNCATE TABLE absence";
        mysql_query($vider) or die(mysql_error());
    }

    $cat=$_SESSION['cat'];

    $quete="SELECT * FROM personnel";
	$executy=mysql_query($quete) or die(mysql_error());

    while ($secret=mysql_fetch_assoc($executy)) {

        $abs=$secret['matricule'];
        
        $sexe=$secret["sexe_per"];

        // tester si le pointage est déja fait

        $voir_abs="SELECT absence.numero, absence.date_pointage, absence.matricule,absence.journe
		, absence.etat_pointage from personnel,absence where (personnel.matricule=absence.matricule)
		and (absence.journe='$after') and (absence.date_pointage='$daty') and (absence.matricule='$abs')";
            
        
        $voila=mysql_query($voir_abs) or die(mysql_error());
        $mana=mysql_num_rows($voila);
        $absence=mysql_fetch_assoc($voila);
        $etat=$absence['etat_pointage'];
        
        //tester si le personne est en conge

        $daty=date('Y-m-d');
        $etet="SELECT COUNT(matricule) as eka from conge where (matricule='$abs') and (((DATEDIFF(date_fin, '$daty'))+1)>0) and (etat_conge='accorde')";
        $query_etet=mysql_query($etet) or die(mysql_fetch_assoc());
        $etiquet=mysql_fetch_assoc($query_etet);
        $enconge=$etiquet['eka'];

        if (($mana != 0)){
            if (($etat=='absent')||($etat=='absente')){
                $retro="SELECT total_abs from personnel where (matricule='$abs')";
                $alefaso=mysql_query($retro) or die(mysql_error());
                $viseur=mysql_fetch_assoc($alefaso);
                $getena=$viseur['total_abs'];
                $taha=($getena-1);
                $modifier="UPDATE personnel set total_abs='$taha' where (matricule='$abs') limit 1";
                mysql_query($modifier) or die(mysql_error());

            }
            $delete="DELETE from absence where (date_pointage='$daty') and (journe='$after') and (matricule='$abs') limit 1";
            mysql_query($delete) or die(mysql_error());
        }
        if($enconge!=0){
            $statut="en congé";
            
            $inserer="INSERT into absence (date_pointage,journe,matricule,etat_pointage)value ('$daty','$after','$abs','$statut')";
            mysql_query($inserer) or die(mysql_error());
        }else{
            if ((isset($_POST["prs$abs"]))||(!isset($_POST["abs$abs"]))){

                // PRESENT
                
    
                if($sexe=='F'){
                    $statut="présente";
                }else{
                    $statut="présent";
                }
                $inserer="INSERT into absence (date_pointage,journe,matricule,etat_pointage)value ('$daty','$after','$abs','$statut')";
                mysql_query($inserer) or die(mysql_error());
        
            }else{
    
                // ABSENT
                $retro="SELECT total_abs from personnel where (matricule='$abs')";
                $alefaso=mysql_query($retro) or die(mysql_error());
                $viseur=mysql_fetch_assoc($alefaso);
                $getena=$viseur['total_abs'];
                $faha=($getena+1);
    
                if($sexe=='F'){
                    $statut="absente";
                }else{
                    $statut="absent";
                }
                $inserer="INSERT into absence (date_pointage,journe,matricule,etat_pointage)value ('$daty','$after','$abs','$statut')";
                mysql_query($inserer) or die(mysql_error());
        
                $modifier="UPDATE personnel set total_abs='$faha' where (matricule='$abs') limit 1";
                mysql_query($modifier) or die(mysql_error());
            }
        }
    }

    // pour le statisqtique

    
    $stocker=" SELECT COUNT(numero) as total from absence where (etat_pointage='absent')or(etat_pointage='absente') and (date_pointage='$daty') and (journe='$after') ";
    $executeo=mysql_query($stocker) or die(mysql_error());
    $resulteo=mysql_fetch_assoc($executeo);
    $total=$resulteo['total'];

    $stocke=" SELECT COUNT(numero) as total from absence where (etat_pointage='encongé') and (date_pointage='$daty') and (journe='$after')";
    $execu=mysql_query($stocke) or die(mysql_error());
    $resu=mysql_fetch_assoc($execu);
    $ttl=$resu['total'];

    $limiter=" SELECT COUNT(daty) as limity from stock";
    $limiteo=mysql_query($limiter) or die(mysql_error());

    
    $heky=" SELECT daty from stock where (daty='$daty') and (journe='$after')";
    $aloha=mysql_query($heky) or die(mysql_error());
    $ty=mysql_num_rows($aloha);


    $limity=mysql_fetch_assoc($limiteo);
    $delai=$limity['limity'];

    // limiter à 10 contenus
    if($delai > 10){


    }else{
        // effecer s'il y a deja un valeur pour aujourd'hui
        if($ty!=0){
            
            $fafao="DELETE from stock where (daty='$daty') and (journe='$after') limit 1";
            mysql_query($fafao) or die(mysql_error());
        }
        
        $mistock="INSERT into stock (daty,journe,titre,valeur)value ('$daty','$after','absence','$total')";
        mysql_query($mistock) or die(mysql_error());
        $mistock="INSERT into stock (daty,journe,titre,valeur)value ('$daty','$after','enconge','$ttl')";
        mysql_query($mistock) or die(mysql_error());
    }
    header("Location: Pointage.php");
?>