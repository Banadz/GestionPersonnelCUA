<?php
    require_once("Database.php");
    $name=$_SESSION["name"];
    
?>
<?php
    include("include/Head_Code.php");
?>
<head>
<title>Utilisateur%Profil</title>
</head>
<body>
	<div class="wrapper">

    <?php include("include/Topbar.php");    ?>

    <?php include("include/Sidebar.php");   ?>

    <?php	include("include/Foot_code.php");	?>

    	<div class="main-panel">
            <div class="content">
				<div class="page-inner">
					
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Profiles</h4>
										<button class="btn btn-danger btn-round ml-auto">
											<i class="fas fa-angle-double-right"></i>
											<a href="AffichePersonnel.php" style="text-decoration:none; color:white;">Retour</a>
										</button>
									</div>
								</div>
								<div class="card-body">
									

									<!-- request -->

                                    <?php
                                        $anarany=$_SESSION['name'];
                                        $getSary="SELECT * from user where (nom_admin='$anarany')";
                                        $answer=mysql_query($getSary) or die(mysql_error());
                                        $nombre=mysql_num_rows($answer);
                                        $sary=mysql_fetch_assoc($answer);
                                        $number=$sary['id'];
										$pic=$sary['photo_admin'];
                                    ?>

									<!-- End request -->
                                    <div class="d-inline">
                                        <div class="avatar avatar-xxl">	
											<?php	if (empty($pic)){	?>
												<img src="../profil/Standard.jpg" alt="..." class="avatar-img rounded-circle">
											<?php	}else{	?>
                                            	<img src="../profil/<?php echo $sary['photo_admin']; ?>" alt="..." class="avatar-img rounded-circle">
											<?php	}?>
										</div>
									</div>
									<div class="d-inline" style="font-size:180%; font-family:candara;">
										<?php  echo ($sary["nom_admin"]) ;?>
										<label><b  style="font-size:180%;"><?php  echo ($sary["prenom_admin"]) ;?></b></label>
									</div>
									<form action="ModifUser.php?matri=<?php 	echo ($number);	?>" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label for="email2">Nom</label>
												<input type="text" class="form-control" value="<?php  echo ($sary['nom_admin']) ;?>" name="nom" placeholder="votre nom">
											</div>
											<div class="form-group">
												<label for="email2">Prénom</label>
												<input type="text" class="form-control" value="<?php  echo ($sary['prenom_admin']) ;?>" name="prenom" placeholder="votre prenom">
											</div>
											<div class="form-group">
												<label for="email2">Tel</label>
												<input type="text" class="form-control" value="<?php  echo ($sary['tel_admin']) ;?>" name="phone" placeholder="034*******">
											</div>
											<div class="form-group">
												<label for="email2">Mail</label>
												<input type="text" class="form-control" value="<?php  echo ($sary['mail_admin']) ;?>" name="mail" placeholder="@gmail.com">
											</div>
											<div class="form-group">
												<label for="email2">Adresse</label>
												<input type="text" class="form-control" value="<?php  echo ($sary['adresse_admin']) ;?>" name="adrs" placeholder="votre adresse">
											</div>
											<div class="form-group">
												<label for="email2">Mot de passe</label>
												<input type="password" class="form-control" value="<?php  echo ($sary['motdepasse']) ;?>" name="mdp" placeholder="********">
											</div>
											<div class="form-group">
												<label for="">Photo</label>
												<input type="file" class="form-control-file"  id="exampleFormControlFile1">
												
											</div>
											<div class="card-action">
												<button class="btn btn-primary" type="submit">Valider les modifications</button>
												<a href="Home.php" class="btn btn-danger">Annuler</a>
											</div>
									</form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
					
				<?php	include("include/Footbar.php");	?>
            </div>
        </div>
	</div>
        <script >
		$(document).ready(function() {
			$('#basic-datatables').DataTable({
			});

			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

			$('#addRowButton').click(function() {
				$('#add-row').dataTable().fnAddData([
					$("#addName").val(),
					$("#addPosition").val(),
					$("#addOffice").val(),
					action
					]);
				$('#addRowModal').modal('hide');

			});
        });
        </script>
        

    
</body>

</html>