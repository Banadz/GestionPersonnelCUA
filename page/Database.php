<?php
    $con = mysql_connect("localhost","root","") or die(mysql_error());
    mysql_select_db("gestionpersonnel",$con) or die(mysql_error());
?>