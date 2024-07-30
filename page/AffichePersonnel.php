<?php
    session_start();
?>
<?php
    require_once("Database.php");
    
?>
<?php
    include("include/Head_Code.php");
	
	
	$anarany=$_SESSION['name'];
    $getSary="SELECT * from user where (nom_admin='$anarany')";
    $answer=mysql_query($getSary) or die(mysql_error());
	$nombre=mysql_num_rows($answer);
	$sary=mysql_fetch_assoc($answer);

	$cat=$sary['titre'];
    
	
	if(($cat=='Secrétaire de la Mairie')){
		$afficher1="SELECT * FROM personnel where (cadre = 'CUA')";
		$execut=mysql_query($afficher1) or die(mysql_error());	
	}else{
		if(($cat=='Secrétaire de la Voirie')){
			$afficher1="SELECT * FROM personnel where (cadre = 'VOIRIE')";
			$execut=mysql_query($afficher1) or die(mysql_error());
		}else{
			$afficher1="SELECT * FROM personnel";
			$execut=mysql_query($afficher1) or die(mysql_error());
		}
	}
	

?>
<head>
<title>Personnel%List</title>
</head>

<body>	
	<div class="wrapper">
		<!-- include -->
		<?php
			include("include/Topbar.php");
		?>
		<?php
			include("include/Sidebar.php");
		?>
        <div class="main-panel">
            <div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Information personnel</h4>
										<button class="btn btn-primary btn-round ml-auto" data-toggle="modal" data-target="#addRowModal">
											<i class="fa fa-plus"></i>
											Ajouter nouveau
										</button>
									</div>
								</div>
								<div class="card-body">
									<!-- Modal -->
									<div class="modal fade" id="addRowModal" tabindex="-1" role="dialog" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header no-bd">
													<h5 class="modal-title">
														<span class="fw-mediumbold">
														Nouveau</span>
														<span class="fw-light">
															Personnel
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p class="small">Ajouter un personnel en validant les champs</p>
													<form method="POST" action="Inserer.php" enctype="multipart/form-data">
														<div class="row">
															<div class="col-sm-12">
																<div class="form-group form-group-default">
																	<label>Matricule</label>
																	<input name="matricule" type="text" class="form-control" placeholder="matricule">
																</div>
															</div>
															<div class="col-md-6 pr-0">
																<div class="form-group form-group-default">
																	<label>Nom</label>
																	<input name="name" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-6">
																<div class="form-group form-group-default">
																	<label>Prénom</label>
																	<input name="prenom" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="form-group">
																<label class="form-radio-label">
																	<input class="form-radio-input" type="radio" name="sx" value="Homme"  checked>	
																		<span class="form-radio-sign">Homme</span>
																</label>
																<label class="form-radio-label ml-3">
																	<input class="form-radio-input" type="radio" name="sx" value="Femme">
																		<span class="form-radio-sign">Femme</span>
																</label>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>CIN</label>
																	<input name="cin" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Fonction</label>
																	<input name="fonction" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="form-group">
																<label for="email2">Statut</label>
																<select class="form-control form-control" name="section">
																	<?php	
																		$avoir="SELECT * from categorie";
																		$e_avoir=mysql_query($avoir) or die(mysql_error());
																		while($r_avoir=mysql_fetch_assoc($e_avoir)){
																			$abreviation=$r_avoir['ab_statut'];
																			$designation=$r_avoir['design_statut'];
																	?>
																	<option value="<?php	echo($abreviation);	?>"> <?php	echo($abreviation);	?></option>
																	<?php	}	?>
																</select>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Indice</label>
																	<input name="indice" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group">
																	<label for="email2">Cadre</label>
																	<select class="form-control form-control" name="cadre">
																		<option value="CUA">Personnel de la Mairie</option>
																		<option value="VOIRIE">Personnel du Voirie</option>
																	</select>
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Date de Naissance</label>
																	<input name="daten" type="date" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Adresse</label>
																	<input name="adres" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Contact</label>
																	<input name="phone" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Nombre d'enfant</label>
																	<input name="nbr_enf" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Photo</label>
																	<input name="photo" type="file" class="form-control" placeholder="">
																</div>
															</div>
														</div>
														
														<div class="modal-footer no-bd">
															<button type="submit" name="sub" onclick="return confirm('Un personnel ajouté')" class="btn btn-primary">Ajouter</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>

									<div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover" >
										<thead>
												<tr>
													<th>Matricule</th>
													<th>Nom et Prénom</th>
													<th>Statut</th>
													<th>Fonction</th>
													<th>Opération</th>
												</tr>
											</thead>
											<tbody>

												<?php while ($result=mysql_fetch_assoc($execut)) { ?>
													<tr>
														<td><?php echo( $result["matricule"] ); ?></td>
														<td><?php echo( $result["nom_per"] ); ?> <?php echo( $result['prenom_per'] ); ?></td>
														<td><?php echo( $result["statut"] ); ?></td>
														<td><?php echo( $result["fonction"] ); ?></td>
														<td>
															<div class="form-button-action">
																<a href="Profile.php?matri=<?php echo( $result["matricule"] ); ?>">
																	<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Modifier">
																		<i class="fa fa-edit"></i>
																	</button>
																</a>
																<a href="Supprimer.php?matri=<?php echo( $result["matricule"] ); ?>">
																	<button type="button"  data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer">
																		<i class="fa fa-times"></i>
																	</button>
																</a>
															</div>
														</td>
														
													</tr>
												<?php } ?>

											</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php	include("include/Footbar.php");	?>
            </div>
        </div>
	</div>

		<?php	include("include/Foot_code.php");	?>
		<script>
            // Get the modal
            var modal = document.getElementById('id01');
        </script>
		<script>
            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            }
        </script>
	<script >
		$(document).ready(function() {
			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

		});
		$('#displayNotif').on('click', function(){
			var placementFrom = top;
			var placementAlign = right;
			var state = danger;
			var content = {};

			content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
			content.title = 'Bootstrap notify';
			
			content.icon = 'fa fa-bell';
			
			content.url = 'index.html';
			content.target = '_blank';

			$.notify(content,{
				type: state,
				placement: {
					from: placementFrom,
					align: placementAlign
				},
				time: 1000,
				delay: 0,
			});
		});
	</script>
</body>
</html>