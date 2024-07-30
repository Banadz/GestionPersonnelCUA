<?php
    session_start();
?>
<?php
    require_once("Database.php");
    
?>
<?php
    include("include/Head_Code.php");
?>
<head>
<title>Utilisateur%Main</title>
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
										<h4 class="card-title">Les Utilisateurs</h4>
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
															Utilisateur
														</span>
													</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<p class="small">Ajouter un Utilisateur en validant les champs</p>
													<form action="AjouterUser.php" method="POST" enctype="multipart/form-data">
														<div class="row">
															<div class="col-md-8 pr-0">
																<select class ="form-group form-group-default" name="type">
																	<?php
																		$selected="SELECT * from service";
																		$answers=mysql_query($selected) or die(mysql_error());
																	?>
																		<?php while ($use=mysql_fetch_assoc($answers)) {?>
																			<option  value="<?php  echo utf8_encode($use['id_service'])	; ?>" checked><?php echo utf8_encode($use['label_service'])	; ?> </option>
																		<?php }?>
																</select>
															</div>
															<div class="col-md-6">
																<div class="form-group form-group-default">
																	<label>Nom</label>
																	<input name="name" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-6 pr-0">
																<div class="form-group form-group-default">
																	<label>Prénom</label>
																	<input name="prenom" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-8 pr-0">
																<label class="form-radio-label">
																	<input class="form-radio-input" type="radio" name="sexe" value="homme"  checked="">
																	<span class="form-radio-sign">Homme</span>
																</label>
																<label class="form-radio-label ml-3">
																	<input class="form-radio-input" type="radio" name="sexe" value="femme">
																	<span class="form-radio-sign">Femme</span>
																</label>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Mail</label>
																	<input name="mail" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Telephone</label>
																	<input name="telephone" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Adresse</label>
																	<input name="adresse" type="text" class="form-control" placeholder="">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Mode de passe</label>
																	<input name="mpd" type="password" class="form-control" placeholder="**********">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Code</label>
																	<input name="code" type="password" class="form-control" placeholder="****">
																</div>
															</div>
															<div class="col-md-12">
																<div class="form-group form-group-default">
																	<label>Photo</label>
																	<input name="photo" type="file" class="form-control">
																</div>
															</div>
														</div>
														<div class="modal-footer no-bd">
															<button type="submit" id="addRowButton" class="btn btn-primary">Ajouter</button>
															<button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
									<!-- End modal -->

									<!-- request -->

									<?php
										$afficher2="SELECT user.id,	user.nom_admin,	user.prenom_admin,	user.mail_admin,	user.tel_admin,	user.adresse_admin
										,service.label_service FROM service,user where (user.id_service=service.id_service) and (user.id_service != 'Maire')";
										$execut2=mysql_query($afficher2) or die(mysql_error());
									?>

									<!-- End request -->

									<div class="table-responsive">
                                        <table id="basic-datatables" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Numéro</th>
													<th>Nom et Prénom</th>
													<th>Fonction</th>
													<th>Mail</th>
													<th>Téléphone</th>
													<th>Adresse</th>
													<th>Opération</th>
												</tr>
											</thead>
											<tbody>

										<!-- boucle -->
											<?php while ($user=mysql_fetch_assoc($execut2)) { ?>
												<tr>
													<td><?php echo( $user["id"] ); ?></td>
													<td><?php echo( $user["nom_admin"] ); ?> <?php echo( $user["prenom_admin"] ); ?></td>
													<td><?php echo utf8_encode( $user["label_service"] ); ?></td>
													<td><?php echo( $user["mail_admin"] ); ?></td>
													<td><?php echo( $user["tel_admin"] ); ?></td>
													<td><?php echo( $user["adresse_admin"] ); ?></td>
                                                    <td>
														<div class="form-button-action">
															<a href="RemoveUser.php?matri=<?php echo( $user["id"] ); ?>">
																<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer">
																	<i class="fa fa-times"></i>
																</button>
															</a>
														</div>
													</td>
													
												</tr>
											<?php } ?>
										<!-- End boucle -->

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