<?php
session_start();
?>
<?php
require_once("Database.php");
include('include/Horloge.php');
?>
<?php
    if($aujourdhui=='Lundi'){
        $ref=date('Y-m');

        $day0=date('d');
        $jour0=date('Y-m-d');

        $day1=$day0+1;
        $jour1=("$ref-$day1");

        $day2=$day0+2;
        $jour2=("$ref-$day2");

        $day3=$day0+3;
        $jour3=("$ref-$day3");

        $day4=$day0+4;
        $jour4=("$ref-$day4");

    }if($aujourdhui=='Mardi'){
        $ref=date('Y-m');

        $day1=date('d');
        $jour1=date('Y-m-d');

        $day0=($day1-1);
        $jour0=("$ref-$day0");

        $day2=$day1+1;
        $jour2=("$ref-$day2");

        $day3=$day1+2;
        $jour3=("$ref-$day3");

        $day4=$day1+3;
        $jour4=("$ref-$day4");
    }if($aujourdhui=='Mercredi'){
        $ref=date('Y-m');

        $day2=date('d');
        $jour2=date('Y-m-d');

        $day0=($day2-2);
        $jour0=("$ref-$day0");

        $day1=$day2+1;
        $jour1=("$ref-$day1");

        $day3=$day2+1;
        $jour3=("$ref-$day3");

        $day4=$day2+2;
        $jour4=("$ref-$day4");
    }
    if($aujourdhui=='Jeudi'){
        $jeu=($deb_sem+3);
        $jeu_datiny=(date('Y-m-')+"$jeu");
    }if($aujourdhui=='Vendredi'){
        
        $ref=date('Y-m');
        $day4=date('d');
        $jour4=date("Y-m-d");

        $day0=($day4-4);
        $jour0=("$ref-$day0");

        $day1=($day4-3);
        $jour1=("$ref-$day1");

        $day2=$day4-2;
        $jour2=("$ref-$day2");

        $day3=$day4-1;
        $jour3=("$ref-$day3");
    }if($aujourdhui=='Samedi'){
        
        $ref=date('Y-m');
        $day5=date('d');
        $jour5=date("Y-m-d");

        $day0=($day5-5);
        $jour0=("$ref-$day0");

        $day1=($day5-4);
        $jour1=("$ref-$day1");

        $day2=$day5-3;
        $jour2=("$ref-$day2");

        $day3=$day5-2;
        $jour3=("$ref-$day3");

        $day4=$day5-1;
        $jour4=("$ref-$day4");
    }if($aujourdhui=='Dimanche'){
        
        $ref=date('Y-m');
        $day6=date('d');
        $jour6=date("Y-m-d");

        $day0=($day6-6);
        $jour0=("$ref-$day0");

        $day1=($day6-5);
        $jour1=("$ref-$day1");

        $day2=$day6-4;
        $jour2=("$ref-$day2");

        $day3=$day6-3;
        $jour3=("$ref-$day3");

        $day4=$day6-2;
        $jour4=("$ref-$day4");
    }

    include_once 'FPDF/fpdf.php';
    $pdf= new FPDF('L','mm','A4');
    $pdf ->AddPage();
    $pdf ->setFont("Arial","","18");
    $pdf->AddFont('Comic','','courier.php');
    
    $pdf ->Image("../image/Armoirie_CUA.png","25","5","15","");
    $pdf ->setFont("Comic","",9);
    $pdf->SetXY(12,23);
    $pdf ->Cell(50,10,"COMMUNE URBAINE AMBALAVAO");
    $pdf->Line(25, 30,45,30);
    $pdf ->setFont("times","","20");
    $pdf->SetXY(82,15);
    $mois=utf8_decode($mois);
    $pdf->Write(5,"Fiche de presence de la semaine de $day0 au $day4 $mois $anne");

    $cat=$_SESSION['cat'];
    $daty=date("Y-m-d");
    if(($cat=='Secretaire')){
        $voir_abs="SELECT absence.numero, absence.date_pointage, absence.matricule, personnel.cadre, personnel.prenom_per, absence.journe
        , absence.etat_pointage from personnel,absence where (personnel.matricule=absence.matricule) and (personnel.cadre='CUA')";
    }else{
            $voir_abs="SELECT absence.numero, absence.date_pointage, personnel.matricule, personnel.cadre,personnel.prenom_per, absence.journe
        , absence.etat_pointage from personnel,absence where (personnel.matricule=absence.matricule) and (personnel.cadre='CUA') GROUP BY(personnel.matricule)";
    }
    

    $sel2 = mysql_query($voir_abs) or die(mysql_error());
    $pdf->SetXY(13,32);
    $pdf ->setFont("Arial","B","8");
    $pdf ->Cell(8,8,"N*","1","0","C");
    $pdf ->Cell(53,8,"Anarana","1","0","C");
    $pdf ->Cell(42,4,"Lundi","1","0","C");
    $pdf ->Cell(42,4,"Mardi","1","0","C");
    $pdf ->Cell(42,4,"Mercredi","1","0","C");
    $pdf ->Cell(42,4,"jeudi","1","0","C");
    $pdf ->Cell(42,4,"Vendredi","1","1","C");
    
    $pdf ->setLeftMArgin(13);
    $pdf ->Cell(61,4,"","0","0","C");
    $pdf ->Cell(21,4,"Maraina","1","0","C");
    $pdf ->Cell(21,4,"Hariva","1","0","C");
    $pdf ->Cell(21,4,"Maraina","1","0","C");
    $pdf ->Cell(21,4,"Hariva","1","0","C");
    $pdf ->Cell(21,4,"Maraina","1","0","C");
    $pdf ->Cell(21,4,"Hariva","1","0","C");
    $pdf ->Cell(21,4,"Maraina","1","0","C");
    $pdf ->Cell(21,4,"Hariva","1","0","C");
    $pdf ->Cell(21,4,"Maraina","1","0","C");
    $pdf ->Cell(21,4,"Hariva","1","1","C");

    while($perso= mysql_fetch_assoc($sel2)){
        $auto=$perso['matricule'];
        $prenom=$perso['prenom_per'];
        $parjour="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour0') and (journe='Matin')";
        $query_parjour = mysql_query($parjour) or die(mysql_error());
        $array_parjour= mysql_fetch_assoc($query_parjour);
        $state0=$array_parjour['etat_pointage'];
        $parjour="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour0') and (journe='Après-midi')";
        $query_parjour = mysql_query($parjour) or die(mysql_error());
        $array_parjour= mysql_fetch_assoc($query_parjour);
        $state00=$array_parjour['etat_pointage'];

        $parjour="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour1') and (journe='Matin')";
        $query_parjour = mysql_query($parjour) or die(mysql_error());
        $array_parjour= mysql_fetch_assoc($query_parjour);
        $state1=$array_parjour['etat_pointage'];
        $parjour6="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour1') and (journe='Après-midi')";
        $query_parjour6 = mysql_query($parjour6) or die(mysql_error());
        $array_parjour6= mysql_fetch_assoc($query_parjour6);
        $state11=$array_parjour6['etat_pointage'];
        
        $parjour="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour2') and (journe='Matin')";
        $query_parjour = mysql_query($parjour) or die(mysql_error());
        $array_parjour= mysql_fetch_assoc($query_parjour);
        $state2=$array_parjour['etat_pointage'];
        $parjour6="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour2') and (journe='Après-midi')";
        $query_parjour6 = mysql_query($parjour6) or die(mysql_error());
        $array_parjour6= mysql_fetch_assoc($query_parjour6);
        $state22=$array_parjour6['etat_pointage'];

        $parjour="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour3') and (journe='Matin')";
        $query_parjour = mysql_query($parjour) or die(mysql_error());
        $array_parjour= mysql_fetch_assoc($query_parjour);
        $state3=$array_parjour['etat_pointage'];
        $parjour6="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour3') and (journe='Après-midi')";
        $query_parjour6 = mysql_query($parjour6) or die(mysql_error());
        $array_parjour6= mysql_fetch_assoc($query_parjour6);
        $state6=$array_parjour6['etat_pointage'];

        $parjour4="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour4') and (journe='Matin')";
        $query_parjour4 = mysql_query($parjour4) or die(mysql_error());
        $array_parjour4= mysql_fetch_assoc($query_parjour4);
        $state4=$array_parjour['etat_pointage'];
        $parjour8="SELECT * from absence where (matricule='$auto') and(date_pointage='$jour4') and (journe='Après-midi')";
        $query_parjour8 = mysql_query($parjour8) or die(mysql_error());
        $array_parjour8= mysql_fetch_assoc($query_parjour8);
        $state8=$array_parjour8['etat_pointage'];
        
        $pdf ->setLeftMArgin(13);
        $pdf ->setFont("times","","10");
        if (!empty($auto)){
            $pdf ->Cell(8,5,"$auto","1","0","C");
        }else{
            $pdf ->Cell(12,5,"","1","0","C");
        }
        if (!empty($prenom)){
            $prenom=utf8_decode($prenom);
            $pdf ->Cell(53,5,"$prenom","1","0","");
        }else{
            $pdf ->Cell(35,5,"","1","0","C");
        }


        if (!empty($state0)){
            if (($state0=='présent')||($state0=='présente')){
                $state0=utf8_decode($state0);
                $pdf ->Cell(21,5,"$state0","1","0","C");
            }else{
                if (($state0=='absent')||($state0=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state0","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state0","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }
        if (!empty($state00)){
            if (($state00=='présent')||($state00=='présente')){
                $state00=utf8_decode($state00);
                $pdf ->Cell(21,5,"$state00","1","0","C");
            }else{
                if (($state00=='absent')||($state00=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state00","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state00","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }
        

        if (!empty($state1)){
            if (($state1=='présent')||($state1=='présente')){
                $state1=utf8_decode($state1);
                $pdf ->Cell(21,5,"$state1","1","0","C");
            }else{
                if (($state1=='absent')||($state1=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state1","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state1","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }
        if (!empty($state11)){
            if (($state11=='présent')||($state11=='présente')){
                $state11=utf8_decode($state11);
                $pdf ->Cell(21,5,"$state11","1","0","C");
            }else{
                if (($state11=='absent')||($state11=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state11","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state11","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }


        if (!empty($state2)){
            if (($state2=='présent')||($state2=='présente')){
                $state2=utf8_decode($state2);
                $pdf ->Cell(21,5,"$state2","1","0","C");
            }else{
                if (($state2=='absent')||($state2=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state2","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state2","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }
        if (!empty($state22)){
            if (($state22=='présent')||($state22=='présente')){
                $state22=utf8_decode($state22);
                $pdf ->Cell(21,5,"$state22","1","0","C");
            }else{
                if (($state22=='absent')||($state22=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state22","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state22","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }


        if (!empty($state3)){
            if (($state3=='présent')||($state3=='présente')){
                $state3=utf8_decode($state3);
                $pdf ->Cell(21,5,"$state3","1","0","C");
            }else{
                if (($state3=='absent')||($state3=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state3","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state3","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }
        if (!empty($state6)){
            if (($state6=='présent')||($state6=='présente')){
                $state6=utf8_decode($state6);
                $pdf ->Cell(21,5,"$state6","1","0","C");
            }else{
                if (($state6=='absent')||($state6=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state6","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state6","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("times","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }
        
        if (!empty($state4)){
            if (($state4=='présent')||($state4=='présente')){
                $state4=utf8_decode($state4);
                $pdf ->Cell(21,5,"$state4","1","0","C");
            }else{
                if (($state4=='absent')||($state4=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state4","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("Arial","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state4","1","0","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("Arial","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","0","C");
        }
        if (!empty($state8)){
            if (($state8=='présent')||($state8=='présente')){
                $state8=utf8_decode($state8);
                $pdf ->Cell(21,5,"$state8","1","1","C");
            }else{
                if (($state8=='absent')||($state8=='absente')){
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(200 ,100, 40);
                    $pdf ->Cell(21,5,"$state8","1","1","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("Arial","","10");
                }else{
                    $pdf ->setFont("times","B","11");
                    $pdf ->SetTextColor(20 ,200, 40);
                    $pdf ->Cell(21,5,"$state8","1","1","C");
                    $pdf ->SetTextColor(0 ,0,0);
                    $pdf ->setFont("Arial","","10");
                }
            }
        }else{
            $pdf ->Cell(21,5,"","1","1","C");
        }
    }  
    $pdf ->Output();
?>