<?php
    session_start();
?>
<?php
    require_once("Database.php");
    $id=$_GET["matri"];
    
?>
<?php
    include("include/Head_Code.php");
?>
<head>
<title>Personnel%Profil</title>
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
                                        
										$affiche="SELECT * FROM personnel where (matricule='$id');";
										$execut2=mysql_query($affiche) or die(mysql_error());
                                        $profile=mysql_fetch_assoc($execut2);
										$pict=$profile['photo'];
									?>

									<!-- End request -->
                                    <table class="col-md-6">
										<thead>
											<tr>
												<th rowspan="3">
													<div class="avatar avatar-xxl">	
														<?php	if(empty($pict)){	?>
															<img src="../profil/Standaperso.jpg" alt="..." class="avatar-img rounded-circle">
														<?php	}else{	?>
															<img src="../profil/<?php echo $profile['photo']; ?>" alt="..." class="avatar-img rounded-circle">
															
														<?php	}?>
													</div>
												</th>
												<th  align="left">
													<div style="font-family:candara;">
														<label><b style="font-size:180%;"><?php  echo ($profile["nom_per"]) ;?></b></label>
													
														<label><b style="font-size:180%;">  <?php  echo ($profile["prenom_per"]) ;?></b></label>
													</div>
												</th>
											</tr>
											<tr>
												<th>
													<?php  echo ($profile["fonction"]) ;?>
												</th>
											</tr>
											<tr>
												<th>
													<?php  echo ($profile["statut"]) ;?>
												</th>
											</tr>
										</thead>
									</table>
									<form action="Modification.php?matri=<?php 	echo ($_GET['matri']);	?>" method="POST" enctype="multipart/form-data">
											<table class="col-md-10">
												<thead align="center">
													<tr>
														<th>
															<input type="text" name="conge" class="col-md-4" style="border:none;color:rgba(10, 18, 139); font-size:200%;" value='<?php  echo ($profile["conge_restant"]) ;?>'>
														</th>
														<th>
															<input type="number" name="abs" class="col-md-4" style="border:none;color:red; font-size:200%;" value="<?php  echo ($profile['total_abs']) ;?>">
														</th>
													</tr>
												</thead>
												<tbody>
													<tr align="center">
														<td style="color:rgba(10, 18, 139);">Congé(s) restant(s)</td>
														<td style="color:red;">Total absence</td>
													</tr>
												</tbody>
											</table>
									
											<div class="form-group">
												<label for="email2">Nom</label>
												<input type="text" class="form-control" value="<?php  echo ($profile["nom_per"]) ;?>" name="nom" placeholder="votre nom">
											</div>
											<div class="form-group">
												<label for="email2">Prénom</label>
												<input type="text" class="form-control" value="<?php  echo($profile["prenom_per"]) ;?>" name="prenom" placeholder="votre prenom">
											</div>
											<div class="form-group">
												<label for="email2">Indice</label>
												<input type="text" class="form-control" value="<?php  echo ($profile["indice"]) ;?>" name="index" placeholder="">
											</div>
											<div class="form-group">
												<label for="email2">Fonction</label>
												<input type="text" class="form-control" value="<?php  echo ($profile["fonction"]) ;?>" name="fonct" placeholder="votre fonction">
											</div>
											<div class="form-group">
												<label for="email2">Statut</label>
												<input type="text" class="form-control" value="<?php  echo ($profile["statut"]) ;?>" name="sect" placeholder="votre categorie">
											</div>
											<div class="form-group">
												<label for="email2">Cadre</label>
												<select class="form-control form-control" name="cadre">
													<option value="CUA">Personnel de la Mairie</option>
													<option value="VOIRIE">Personnel de la Voirie</option>
												</select>
											</div>
											<div class="form-group">

											<?php if(($profile['sexe_per'])=='F'){	?>
												<label class="form-radio-label">
													<input class="form-radio-input" type="radio" name="sx" value="Homme"  >	
														<span class="form-radio-sign">Homme</span>
												</label>
												<label class="form-radio-label ml-3">
													<input class="form-radio-input" type="radio" name="sx" value="Femme"checked>
														<span class="form-radio-sign">Femme</span>
												</label>
											<?php  }else{	?>
												<label class="form-radio-label">
													<input class="form-radio-input" type="radio" name="sx" value="Homme"  checked>	
														<span class="form-radio-sign">Homme</span>
												</label>
												<label class="form-radio-label ml-3">
													<input class="form-radio-input" type="radio" name="sx" value="Femme">
														<span class="form-radio-sign">Femme</span>
												</label>
											<?php  }	?>

											</div>
											<div class="form-group">
												<label for="email2">CIN</label>
												<input type="text" class="form-control" value="<?php  echo ($profile["cin_per"]) ;?>" name="cin" placeholder="">
											</div>
											<div class="form-group">
												<label for="email2">Téléphone</label>
												<input type="text" class="form-control" value="<?php  echo ($profile["telephone"]) ;?>" name="tel" placeholder="numéro telephone">
											</div>
											<div class="form-group">
												<label for="email2">Adresse</label>
												<input type="text" class="form-control" value="<?php  echo ($profile["adresse"]) ;?>" name="adrs" placeholder="votre adresse">
											</div>
											<div class="form-group">
												<label for="">Photo</label>
												<input type="file" class="form-control" name="photo" placeholder="">
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