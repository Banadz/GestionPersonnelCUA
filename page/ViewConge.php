
<?php
    
    
    require_once("Database.php");
    
    $req="SELECT personnel.prenom_per as title, conge.date_debut as start, DATE_ADD(conge.date_fin, interval 1 day) as end FROM personnel,conge where (personnel.matricule=conge.matricule) and (etat_conge='accordé')";
    $query=mysql_query($req) or die(mysql_error());
    $array_list=array();
    while($mesy=mysql_fetch_assoc($query)){
        if ($mesy['title']==''){
            $req1="SELECT personnel.nom_per as title, conge.date_debut as start, DATE_ADD(conge.date_fin, interval 1 day) as end FROM personnel,conge where (personnel.matricule=conge.matricule) and (etat_conge='accordé') and(personnel.prenom_per='')";
            $query1=mysql_query($req1) or die(mysql_error());
            $mesy1=mysql_fetch_assoc($query1);
            array_push($array_list,$mesy1);
        }else{
            array_push($array_list,$mesy);
        }
    }
   
    echo json_encode($array_list);
    
    
?>