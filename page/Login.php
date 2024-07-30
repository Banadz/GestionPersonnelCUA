<?php
session_start();
?>

<?php
  $_SESSION['name']="";
?>
<?php
require_once("Database.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SeConnecter%Main</title>
  <!-- loadding -->
  <link href="../css/loading/pace.min.css" rel="stylesheet"/>
  <script src="../css/loading/pace.min.js"></script>
  
  <link href="../bootstrap-5.0.0/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="../bootstrap-5.0.0/css/bootstrap.css" rel="stylesheet"/>
  
  <link rel="shortcut icon" href="../image/JMA.jpg" />
</head>

<style>
  body{
    background-image: url("../image/Type1.JPG");
    background-size:cover;
    height:100%;
    width:100%;
    
  }
  .label{
    color:#abd5bd;
    font-size:98%;
    margin-bottom:2%;
    /* font-family:Berlin Sans FB; */
    font-family:Candara;
  }
  .form-control{
    background:rgba(25, 35, 50,0.1);
    border-color:#abd5bd;
    color:rgba(225, 225, 225);
  }
</style>
<script type="text/javascript">
        function updateClock(){
            var now =new Date () ;
            var dname=now.getDay(),
                mo=now.getMonth(),

                daty=now.getDate();
                if (daty<10) {
                  dnum= "0"+now.getDate()+""
                }else{
                  hou=now.now.getDate()
                }

                yr=now.getFullYear(),
                hou=now.getHours(),
                min=now.getMinutes(),
                sec=now.getSeconds();

               
            var months =["Janvier","Fevrier","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Decembre"];    
            var week =["Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi",];
            var ids=["dayname","month","daynum","year","hour","minutes","secondes",];
            var values= [week[dname],months[mo],dnum,yr,hou,min,sec];
            for(var i=0; i<ids.length ;i++ )
            document.getElementById(ids[i]).firstChild.nodeValue=values[i];
        }  
        function initClock(){
            updateClock();
            window.setInterval("updateClock()",1);
        }
        
</script>

<body onload="initClock()">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
          <div class="row w-100 mx-0" style=" margin-top:1%">
            <div class="col-lg-4" style="background-color:rgba(25, 35, 60,0.6);border-radius:1%;">

              <div>
                <img src="../image/Armoirie_CUA.png" style="width:20%; margin-top:5%;margin-left:39%;" alt="" srcset="">
                <h2 style="color:#abd5bd;margin-left:18%;">Commune Urbaine</h2>
                <h2 style="color:#abd5bd; margin-left:30%;"> Ambalavao</h2>
              </div>
                <form action="Logging.php" method="POST">
                  <div>
                    <?php   include("Erreur.php"); ?>
                  </div>
                  
                  <div class="form-group" style="margin-top:6%;">
                    <label for="email" class="label">Nom:</label>
                    <div class="custom-select" style="border-radius:10px; padding: bottom 2px;">
                      <select class ="form-control" name="name">
                        <?php
                          $select="SELECT nom_admin,prenom_admin,id_service, sexe from user";
                          $answer=mysql_query($select) or die(mysql_error());
                        ?>
                        <?php while ($etu=mysql_fetch_assoc($answer)) {?>
                          <?php if (($etu['id_service']=='Maire')){
                            if($etu['sexe']=='homme'){
                              $prenom = 'Monsieur le Maire';
                            }else{
                              $prenom = 'Madame le Maire';
                            }
                          }else{
                            $prenom=$etu['prenom_admin'];
                          }
                            
                          ?>
                          <option  value="<?php echo $etu['nom_admin']; ?>"> <?php echo utf8_encode($prenom); ?></option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="pwd" class="label" style="margin-top:6%;">Mot de passe:</label>
                    <input type="password" class="form-control" id="pwd" placeholder="Entrer votre mot de passe" name="mdp">
                  </div>
                  <button type="submit" class="btn btn-primary" name="logger" style="margin-left:35%; margin-top:20%; margin-bottom:10%;">Se connecter</button>
                </form>
                
              </div>
            </div>    
          </div>
          <div class="row mt--2">
						<div class="col-md-3">
              
            </div>
            <div class="col-md-3">
              
            </div>
            <div class="col-md-3">
              
            </div>
            <div class="col-md-3">
              <div class="row">
                <aside class="col">
                  <div class="row align-items-end">
                        <div class="datetime" >
                            <div class="time"style="color:rgb(255,255,255); font-family:verdana; font-size:400%; padding-top:0%;">
                                <span id="hour">00</span>:
                                <span id="minutes">00</span>
                              
                            </div>
                            <div class="date"style="color:rgb(255,255,255); font-family:verdana; font-size:125%; padding-top:0%;">
                                <span id="dayname">Date</span>
                                <span id="daynum">00</span>
                                <span id="month">Mois</span>
                              
                                <span id="year">Year </span>
                            </div>
                    
                        </div>
                  </div>
                </aside>
              </div>
            </div>
          </div>
      </div>      
    </div>
  </div>

</body>

</html>