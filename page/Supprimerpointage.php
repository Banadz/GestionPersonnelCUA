<?php
require_once("Database.php");
?>
<?php
    
    $num=$_GET['poid'];
    $supprimer="DELETE FROM absence where (numero='$num') limit 1";
    mysql_query($supprimer) or die(mysql_error());
    
    header("location:Absence.php");
?>