<?php
session_start();
?>
<?php
require_once("Database.php");
include('include/Horloge.php');
?>
<?php
    include_once 'FPDF/fpdf.php';
    $pdf= new FPDF();
    $pdf ->AddPage();
    $pdf ->setFont("Arial","","18");
    $anne=date("Y");
    $j=date("d");

    $jour=array("Mon"=>"Lundi", "Tue"=>"Mardi","Wed"=>"Mercredi","Thu"=>"Jeudi","Fri"=>"Vendredi","Sat"=>"Samedi","Sun"=>"Dimanche");
    $month = array('Jan'=>"Janvier", 'Feb'=>"Février", 'Ma'=>"Mars", 'Apr'=>"Avril", 'May'=>"Mai", 'Jun'=>"Juin", 'Jul'=>"Juillet", 'Aug'=>"Août", 'Sept'=>"Septembre", 'Oct'=>"Octobre", 'Nov'=>"Novembre", 'Dec'=>"Décembre");
    $aujourdhui=$jour[date("D")];
    $mois=$month[date("M")];
    
    $pdf ->Image("../image/Armoirie_CUA.png","15","10","30","");

    $pdf ->Cell(200,50,"POINTAGE du $aujourdhui $j $mois $anne ($after)","0","1","C");

    $cat=$_SESSION['cat'];
    $daty=date("Y-m-d");
    if(($cat=='Secretaire')){
        $voir_abs="SELECT absence.numero, absence.date_pointage, absence.matricule, personnel.cadre, absence.nom_ab, absence.prenom_ab, absence.journe
        , absence.categorie, absence.statut from personnel,absence where (personnel.matricule=absence.matricule) and (personnel.cadre='CUA') 
        and (absence.journe='$after') and(absence.date_pointage='$daty')";	
    }else{
        if(($cat=='VOIRIE')){
            $voir_abs="SELECT absence.numero, absence.date_pointage, absence.matricule, personnel.cadre, absence.nom_ab, absence.prenom_ab, absence.journe
            , absence.categorie, absence.statut from personnel,absence where (personnel.matricule=absence.matricule) and (personnel.cadre='VOIRIE') and(absence.date_pointage='$daty')
            and (absence.journe='$after')";
        }else{
            $voir_abs="SELECT absence.numero, absence.date_pointage, absence.matricule, personnel.cadre, absence.nom_ab, absence.prenom_ab, absence.journe
        , absence.categorie, absence.statut from personnel,absence where (personnel.matricule=absence.matricule) and (absence.journe='$after')and(absence.date_pointage='$daty')";
        }
    }
    

    $sel2 = mysql_query($voir_abs) or die(mysql_error());
    
    $pdf ->setLeftMArgin(25);
    $pdf ->setFont("Arial","B","11");
    $pdf ->Cell(12,10,"N*","1","0","C");
    $pdf ->Cell(100,10,"Nom et Prenoms","1","0","C");
    $pdf ->Cell(20,10,"Grade","1","0","C");
    $pdf ->Cell(20,10,"$after","1","1","C");

    while($perso= mysql_fetch_assoc($sel2)){
        $auto=$perso['numero'];
        $nom=$perso['nom_ab'];
        $prenom=$perso['prenom_ab'];
        $cate=$perso['categorie'];
        $state=$perso['statut'];
        
        $pdf ->setLeftMArgin(25);
        $pdf ->setFont("Arial","","11");
        $pdf ->Cell(12,10,"$auto","1","0","C");
        $pdf ->Cell(100,10,"$nom $prenom","1","0","");
        $pdf ->Cell(20,10,"$cate","1","0","C");
        $pdf ->Cell(20,10,"$state","1","1","C");
    }
      
    $pdf ->Output();
?>