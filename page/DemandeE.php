<?php
session_start();
?>
<?php
require_once("Database.php");
?>
<?php
    include_once 'FPDF/fpdf.php';
    
    include('include/Horloge.php');
    $matri=$_GET['matri'];
    $num=$_GET['num'];
    $attri=$_GET['matris'];

    if (!empty($matri)){
        $form="SELECT absence.date_pointage, absence.journe,absence.matricule,personnel.cadre, personnel.sexe_per, personnel.nom_per, personnel.prenom_per,
        personnel.matricule from absence,personnel where (absence.matricule=personnel.matricule)and (absence.numero='$num') 
        and (absence.matricule='$matri')";
    }else{
        if(!empty($attri)){
            $datiny=$_POST['date'];
            $journe=$_POST['journe'];

            $form="SELECT absence.date_pointage, absence.etat_pointage, absence.journe,absence.matricule, personnel.sexe_per, 
            personnel.nom_per, personnel.cadre, personnel.prenom_per,personnel.matricule from absence,personnel where 
            (absence.matricule=personnel.matricule)and (absence.date_pointage='$datiny') 
            and (absence.journe='$journe') and (absence.matricule='$attri')";
            $forma=mysql_query($form) or die(mysql_error());
            $formal=mysql_fetch_assoc($forma);
            $row=mysql_num_rows($forma);
            $etaty=$formal['etat_pointage'];
            $nom=$formal['prenom_per'];
            if ($row==0){
                $form="SELECT prenom_per from personnel where matricule='$attri'";
                $exec=mysql_query($form) or die (mysql_error());
                $prenom=mysql_fetch_assoc($exec);
                $nom=$prenom['prenom_per'];
                header("location:FormDemandeE.php?info=Date invalide&&matricule=$attri&&prenom=$nom");
            }else{
                if($etaty=='en congé'){
                    header("location:FormDemandeE.php?info=Mr $nom etait en congé lors du pointage de cette date&&matricule=$attri&&prenom=$nom");
                }else{
                    if(($etaty=='présente')||($etaty=='présent')){
                        header("location:FormDemandeE.php?info=Mr $nom etait présente lors du pointage de cette date&&matricule=$attri&&prenom=$nom");
                    }else{
                        $form="SELECT absence.date_pointage, absence.etat_pointage, absence.journe,absence.matricule, personnel.sexe_per, personnel.nom_per, personnel.prenom_per,
                        personnel.matricule, personnel.cadre from absence,personnel where (absence.matricule=personnel.matricule)and (absence.date_pointage='$datiny') 
                        and (absence.journe='$journe') and (absence.matricule='$attri')";
                    }
                }
            }
        }
    }
    
    $forma=mysql_query($form) or die(mysql_error());
    $formal=mysql_fetch_assoc($forma);
    $code_date=$formal['date_pointage'];
    $nom=$formal['nom_per'];
    $prenom=$formal['prenom_per'];
    $sexe=$fromal['sexe_per'];
    $andro=$formal['journe'];
    $cadres=$formal['cadre'];

    $pdf= new FPDF('P','mm','A4');
    $pdf ->AddPage();
    $pdf ->setFont("times","","14");
    

    $pdf ->Image("../image/Armoirie_CUA.png","20","10","18","");
    $pdf ->setLeftMArgin(70);
    $pdf->Write(5,"REPOBLIKAN ' I MADAGASIKARA");
    
    $pdf ->setFont("times","","10");
    $pdf ->setLeftMArgin(82);
    $pdf->Write(5,"Fitiavana-Fandrosoana-Fandrosoana");
    $pdf->Line(95, 23,120,23);
    $pdf ->setFontSize(9);
    $pdf->SetXY(12,35);
    $pdf ->Cell(50,10,"COMMUNE URBAINE");
    $pdf->SetXY(17,38);
    $pdf ->Write(10,"AMBALAVAO");
    $pdf->Line(20, 45,35,45);

    $pdf ->setFont("times","B","12");
    $pdf->SetXY(80,38);
    $pdf ->Write(10,"FANGATAHAM-PANAZAVANA");
    $pdf->SetXY(92,40);
    $pdf ->Write(10,"_________________");

    $pdf ->setFont("times","","11");
    $pdf->SetXY(12,50);
    $pdf ->Write(10,"N* 016 /2022-CU/AVAO/BE/PERS/DE.");
    $pdf->SetXY(90,60);
    $pdf ->Write(10,"Ho an'");
    $pdf->SetXY(90,67);
    if($sexe=='F'){
        $pdf ->Write(10,"Ramatoa  $nom  $prenom");
    }else{
        $pdf ->Write(10,"Andriamatoa  $nom  $prenom");
    }
    $pdf->SetXY(103,74);
    $pdf ->Write(10,"MPIASA ATO AMIN ' NY COMMUNE URBAINE");
    $pdf->SetXY(160,81);
    $pdf ->Write(10,"AMBALAVAO");
    $pdf ->setFontSize(12);
    $pdf->SetXY(36,90);
    if ($cadres=="VOIRIE"){
        $pdf ->Write(10,"Araka ny tatitra avy amin'ny Tompon'andraikitra ao amin'ny Service Technique (voirie)");
    }else{
        $pdf ->Write(10,"Araka ny fanarahamaso sy fisavana natao");
    }
    
    $pdf->SetXY(12,97);

    if($andro=="Après-midi"){
        $zahoe="tolokandro";
    }else{
        if($andro=="Matin"){
            $zahoe="maraina";
        }else{
            $zahoe="";
        }
    }
    $convert="SELECT day('$code_date') as day,month('$code_date') as month, year('$code_date') as year";
    $converting=mysql_query($convert) or die (mysql_error());
    $converted=mysql_fetch_assoc($converting);
    $day=$converted['day'];
    $month=$converted['month'];
    $year=$converted['year'];
    $mois=$nyvolana2[$month];
    $pdf ->Write(10,"ny $aujour $j $volana $anne $zahoe, dia tsy tratra teo amin'ny toeram-piasana ianao ny $day $mois $year");
    $pdf->SetXY(12,104);
    $pdf ->Write(10,"$folakandro[$andro] nandritra ny fotoana naharitra ka nisy fiatraikany teo amin'ny fanatanterahana ny asa.");
    $pdf->SetXY(42,111);
    $pdf ->Write(10,"Koa:");
    $pdf->SetXY(12,125);
    
    $pdf ->setFont("times","B","13");
    $pdf ->Cell(90,8,"FANONTANIANA","1","0","C");
    $pdf ->Cell(90,8,"VALINY","1","1","C");
    $pdf->SetXY(12,133);
    $pdf ->Cell(90,100,"","1","0","C");
    $pdf ->Cell(90,100,"","1","1","C");
    $pdf->SetXY(72,233);
    $pdf ->setFont("times","","12");
    $pdf ->Write(10,"Mangataka valiny an-tsoratra avy aminao izahay, ato anatin'ny 48 ora.");
    $pdf->SetXY(125,240);
    $pdf ->Write(10,"Ambalavao, faha $j $volana $anne");
    $pdf->SetXY(125,247);
    $pdf ->Write(10,"NY BEN'NY TANANA");
    $pdf->SetXY(12,247);
    $pdf ->setFontSize(10);
    $pdf ->Write(10,"ANDEFASANA:");
    $pdf->SetXY(15,253);
    $pdf ->Write(10,"- Ny Ben'ny Tanana");
    $pdf->SetXY(15,258);
    $mot="- Intéréssé(e)";
    $encode=utf8_decode($mot);
    $pdf ->Write(10,"$encode");
    $pdf->SetXY(15,263);
    $pdf ->Write(10,"- Dossiers");
    
    $pdf ->setFontSize(11);
    $pdf->SetXY(15,133);
    $pdf ->Write(10,"1*) Omeo ny fanazavanao momba izany.");
    $pdf->SetXY(15,163);
    $pdf ->Write(10,"2*) Mbola mendrika ho mpiasa eto anivon'ny");
    $pdf->SetXY(15,168);
    $pdf ->Write(10,"Commune Urbaine Ambalavao ve ianao?");
    $pdf->SetXY(15,198);
    $pdf ->Write(10,"3*) Inona no sazy ampiharina raha mbola mamerina");
    $pdf->SetXY(15,203);
    $pdf ->Write(10,"izany fihetsika izany?");
    $pdf ->Output();
?>