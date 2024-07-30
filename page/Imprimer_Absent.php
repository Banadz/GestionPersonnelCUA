<?php
session_start();
?>
<?php
require_once("Database.php");
?>
<?php
    include_once 'FPDF/fpdf.php';
    
    include('include/Horloge.php');
    $pdf= new FPDF();
    $pdf ->AddPage();
    $pdf ->setFont("times","","16");
    $ajour=date("D d M Y");
    
    $pdf->SetXY(26,0);
    $mois=utf8_decode($mois);
    $after=utf8_decode($after);
    $pdf ->Cell(200,50,"Les ABSENTS du $aujourdhui $j $mois $anne ($after)","0","1","C");

    $after=utf8_encode($after);

    $pdf ->Image("../image/Armoirie_CUA.png","25","5","15","");
    $pdf ->setFontSize(7);
    $pdf->SetXY(12,23);
    $pdf ->Cell(50,10,"COMMUNE URBAINE AMBALAVAO");
    $pdf->Line(20, 30,42,30);

    $cadre=$_GET['cadre'];
    $voir_abs="SELECT absence.numero, personnel.matricule, personnel.cadre, personnel.statut, personnel.prenom_per, absence.journe
    , absence.etat_pointage from personnel,absence where (personnel.matricule=absence.matricule)
    and (absence.journe='$after') and(absence.etat_pointage='absent')or(absence.etat_pointage='absente')and(absence.date_pointage='$daty')";
    $trait=mysql_query($voir_abs) or die(mysql_error());
    
    $pdf->SetXY(25,45);
    $pdf ->setFont("times","B","13");
    $pdf ->Cell(12,10,"N*","1","0","C");
    $pdf ->Cell(100,10,"Nom","1","0","C");
    $pdf ->Cell(20,10,"Statut","1","0","C");
    $pdf ->Cell(20,10,"","1","1","C");

    while($perso= mysql_fetch_assoc($trait)){
        $auto=$perso['matricule'];
        $prenom=$perso['prenom_per'];
        $cate=$perso['statut'];
        $state=$perso['etat_pointage'];
        
        $pdf ->setLeftMArgin(25);
        $pdf ->setFont("times","","12");
        $pdf ->Cell(12,10,"$auto","1","0","C");
        $pdf ->Cell(100,10,"$prenom","1","0","");
        $pdf ->Cell(20,10,"$cate","1","0","C");
        $pdf ->Cell(20,10,"$state","1","1","C");
    }
      
    $pdf ->Output();
?>