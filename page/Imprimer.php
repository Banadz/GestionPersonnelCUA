<?php
session_start();
?>
<?php
require_once("Database.php");
?>
<?php
    include_once 'FPDF/fpdf.php';
    $pdf= new FPDF();
    $pdf ->AddPage();
    $pdf ->setFont("Arial","B","12");
    $pdf ->Cell(200,20,"RELEVE DE NOTE","0","1","C");

    $matricule=$_GET['matri'];

    $requete1 = "SELECT *from personnel where (matricule='$matricule')";
    $sel2 = mysql_query($requete1) or die(mysql_error());
    $perso= mysql_fetch_assoc($sel2);

    $matricule = $perso['matricule'];
    $nom = $perso['nom_per'];
    $prenom = $perso['prenom_per'];
    $cin = $perso['cin_per'];
    $fonction = $perso['fonction'];
    $date_naiss = $perso['date_naiss'];
    $indice = $perso['indice'];
    $adresse = $perso['adresse'];
    $phone = $perso['telephone'];
    $nbr_enfant = $perso['nbr_enfant'];

    $pdf ->setLeftMArgin(30);
    $pdf ->Cell(50,10,"Matricule N $matricule","0","1","B");
    $pdf ->Cell(50,10,"Nom:                 $nom","0","1","B");
    $pdf ->Cell(200,10,"Prenom:             $prenom","0","1","B");
    $pdf ->Cell(200,10,"CIN:                $cin","0","1","B");
    $pdf ->Cell(200,10,"Fonction:           $fonction","0","1","B");
    $pdf ->Cell(200,10,"Date de naissance:  $date_naiss","0","1","B");
    $pdf ->Cell(200,10,"Indice:             $indice","0","1","B");
    $pdf ->Cell(200,10,"Adresse:            $adresse","0","1","B");
    $pdf ->Cell(200,10,"Telephone           $phone","0","1","B");
    $pdf ->Cell(200,10,"Nombre d'enfant en charge:$nbr_enfant","0","1","B");
    $pdf ->Cell(200,10,"","0","1","B");
    
    
    // $pdf ->Cell(50,10,"Matiere","1","0","C");
    // $pdf ->Cell(30,10,"Coefficient","1","0","C");
    // $pdf ->Cell(20,10,"Note","1","1","C");

    // function afficherMat($code_matiere){
    //     $requete1 = "SELECT nom_mat from matiere where (id_mat=$code_matiere)";
    //     $sel2 = mysql_query($requete1) or die(mysql_error());
    //     $etu2= mysql_fetch_assoc($sel2);
    //     return $etu2['nom_mat'];
    // }

    // $requete1 = "SELECT *from controle where (id_etu='$matricule')";
    // $sel2 = mysql_query($requete1) or die(mysql_error());
    // while($etu2= mysql_fetch_assoc($sel2)){
    //     $id_mat=$etu2['id_mat'];
    //     $note=$etu2['note'];
    //     $nom_mat=afficherMat($id_mat);

    //     $sql = "SELECT *from matiere where (id_mat=$id_mat)";
    //     $res = mysql_query($sql) or die(mysql_error());
    //     $coef= mysql_fetch_assoc($res);
    //     $coef_mat=$coef['coeff_mat'];

    //     $pdf ->Cell(50,10,"$nom_mat","1","0","C");
    //     $pdf ->Cell(30,10,"$coef_mat","1","0","C");
    //     $pdf ->Cell(20,10,"$note","1","1","C");
    // }

    // $pdf ->Cell(50,10,"Total","1","0","C");
    // $pdf ->Cell(30,10,"$coefficeint_total","1","0","C");
    // $pdf ->Cell(20,10,"$note_total","1","1","C");

    // $pdf ->Cell(50,10,"Moyenne","1","0","C");
    // $pdf ->Cell(50,10,"$moy","1","1","C");
    
    
    $pdf ->Output();
?>