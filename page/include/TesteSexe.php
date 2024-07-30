<?php
    $sexe="SELECT sexe_per FROM personnel where matricule='$se'";
    $toys=mysql_query($sexe) or die(mysql_error());
    $cana=mysql_fetch_assoc($toys);
    $sex=$cana['sexe_per'];
?>