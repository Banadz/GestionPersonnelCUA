<?php
require_once("Database.php");
?>
<?php
    
    $num=$_GET['num'];

    $reco="SELECT matricule,etat_conge FROM conge where (numerotation='$num')";
    $recot=mysql_query($reco) or die(mysql_error());
    $recoti=mysql_fetch_assoc($recot);
    $matri=$recoti['matricule'];
    $etat=$recoti['etat_conge'];

    $rec="SELECT conge_restant FROM personnel where (matricule='$matri')";
    $rect=mysql_query($rec) or die(mysql_error());
    $recti=mysql_fetch_assoc($rect);
    $rectif=$recti['conge_restant'];

    $rectifi=($rectif+1);
    
    if($etat=='accord'){
        $rectifica="UPDATE personnel set conge_restant='$rectifi' where (matricule='$matri')";
        $rectification=mysql_query($rectifica);    
    }
    $rectifica="UPDATE personnel set conge_restant='$rectifi' where (matricule='$matri')";
    $rectification=mysql_query($rectifica);


    $supprimer="DELETE FROM conge where (numerotation='$num') limit 1";
    mysql_query($supprimer) or die(mysql_error());
    
    header("location:conge.php");
?>