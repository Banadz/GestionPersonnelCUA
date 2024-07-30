<?php
session_start();
?>
<?php
require_once("Database.php");
?>
<?php
    $_SESSION['name']="";
    $nom="";
    $pass = "";
    $_SESSION['theErr']= array();
?>
<?php
    if(isset($_POST['logger'])){
        $nom=$_POST['name'];
        $_SESSION['name']=$nom;
        $pass=$_POST['mdp'];
            // Si le nom et vide
        if(empty($nom)){
            array_push($_SESSION['theErr'],"Entrez votre nom d'abord");
            header("location:Login.php");
        }else{
            $_SESSION['name']=$nom;
            // Si le mot de passe est vide
            if(empty($pass)){
                array_push($_SESSION['theErr'],"le mot de passe est obligatoire");
                header("location:Login.php");
            }else{
                $select="SELECT * from user where (nom_admin='$nom')";
                $answer=mysql_query($select) or die(mysql_error());
                $nombre=mysql_num_rows($answer);
                if ($nombre ==0) {
                    array_push($_SESSION['theErr'],"votre nom n'existe pas");
                    header("location:Login.php");
                }else{
                    if (count($_SESSION['theErr']) ==0){
                        $select2="SELECT * from user where (nom_admin='$nom') and (motdepasse='$pass') limit 1";
                        $answer2=mysql_query($select2) or die(mysql_error());
                        $nbr=mysql_num_rows($answer2);
                        if ($nbr==1) {
                            header("location:Home.php");
                            $_SESSION['theErr']= array();
                        }else{
                            array_push($_SESSION['theErr'],"le mot de passe est incorrect");
                            header("location:Login.php");
                        }
                    }else{
                        header("location:Login.php");
                    }
                }
            }
        }
    }
?>