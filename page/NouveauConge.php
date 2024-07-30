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
<title>Conge%Nouveau</title>
</head>
<body>
	<div class="wrapper">
	<?php
		include("include/Topbar.php");
	?>
	<?php
		include("include/Sidebar.php");
	?>

		<div class="main-panel">
            <div class="content">
				<div class="page-inner">
					
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Gestion du conge</h4>
										<a href="Home.php" class="btn-round ml-auto" style="text-decoration:none; color:white;">
											<button class="btn btn-danger btn-lg">
												<i class="fas fa-angle-double-right"></i>
												Retour
											</button>
										</a>
									</div>
								</div>
								<div class="card-body">

									<!-- request -->
									<?php
										$cat=$_SESSION['cat'];
										if(($cat=='Secretaire')){
											$affich_perso="SELECT matricule,nom_per,prenom_per,fonction,statut,conge_restant FROM personnel where (cadre='CUA')";	
										}else{
											if(($cat=='VOIRIE')){
												$affich_perso="SELECT matricule,nom_per,prenom_per,fonction,statut,conge_restant FROM personnel where (cadre='VOIRIE')";
											}else{
												$affich_perso="SELECT matricule,nom_per,prenom_per,fonction,statut,conge_restant FROM personnel";
											}
										}
										$perso=mysql_query($affich_perso) or die(mysql_error());
									?>

									<!-- End request -->

									<div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover" >
										<thead>
												<tr>
													<th>N*</th>
													<th>Nom et Prénom</th>
													<th>Fonction</th>
													<th>Statut</th>
													<th>Conge restant</th>
													<th>Opération</th>
												</tr>
											</thead>
											<tbody>

												<?php while ($result_perso=mysql_fetch_assoc($perso)) { ?>
													<tr>
														<td><?php echo( $result_perso["matricule"] ); ?></td>
														<td><?php echo( $result_perso["nom_per"] ); ?> <?php echo utf8_encode( $result_perso['prenom_per'] ); ?></td>
														<td><?php echo utf8_encode( $result_perso["fonction"] ); ?></td>
														<td><?php echo( $result_perso["statut"] ); ?></td>
														<td><?php echo( $result_perso["conge_restant"] ); ?></td>
														<td>
															<div class="form-button-action">
																<?php
																	$titre=$_GET['titre']; 
																	if ($titre=='CG'){
																?>
																	<a href="FormNouveauConge.php?matricule=<?php echo( $result_perso["matricule"] ); ?>&&prenom=<?php echo( $result_perso["prenom_per"] ); ?>">
																		<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Selectionner">
																			<i class="fas fa-paper-plane"></i>
																		</button>
																	</a>
																<?php }else{?>
																	<a href="FormDemandeE.php?matricule=<?php echo( $result_perso["matricule"] ); ?>&&prenom=<?php echo( $result_perso["prenom_per"] ); ?>">
																		<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Selectionner">
																			<i class="fas fa-paper-plane"></i>
																		</button>
																	</a>
																<?php }?>
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

    <!-- include -->

    <?php	include("include/Foot_code.php");	?>
	<script >
		$(document).ready(function() {
			// Add Row
			$('#add-row').DataTable({
				"pageLength": 5,
			});

			var action = '<td> <div class="form-button-action"> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary btn-lg" data-original-title="Edit Task"> <i class="fa fa-edit"></i> </button> <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove"> <i class="fa fa-times"></i> </button> </div> </td>';

		});
	</script>
</body>

</html>