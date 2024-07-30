<?php
    session_start();
?>
<?php
    require_once("Database.php");
    
?>
<?php
    include("include/Head_Code.php");

	$cat=$_SESSION['id_cat'];
	$afficher1="SELECT * FROM personnel";
	$execut=mysql_query($afficher1) or die(mysql_error());

?>
<head>
<title>Pointage%Main</title>
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

		<?php	include("include/Foot_code.php");	?>

		<div class="main-panel">
				<div class="content">
					<div class="page-inner">
						<div class="row">
							<div class="col-md-12">
								<div class="card">
									<div class="card-header">
										<div class="d-flex align-items-center">
											<?php
												include('include/Horloge.php');
											?>
											<h4 class="card-title">Pointage du <?php echo( $aujourdhui);?> 
												<?php echo( $j); ?> 
												<?php echo( $mois); ?>
												<?php echo( $anne); ?>
												(<?php echo( $after); ?>)
											</h4>
											<a href="Home.php" class="btn-round ml-auto" style="text-decoration:none; color:white;">
												<button class="btn btn-danger btn-lg">
													<i class="fas fa-angle-double-right"></i>
													Retour
												</button>
											</a>
										</div>
									</div>
									<div class="card-body">
										<div class="table-responsive">
											<form action="Absence.php?matri=<?php echo( $result["matricule"] ); ?>" method="POST">
												<table id="add-row" class="display table table-striped table-hover" >
												<thead>
														<tr>
															<th>Matricule</th>
															<th>Nom et Prénom</th>
															<th>Fonction</th>
															<th>Statut</th>
															<th>Opération</th>
														</tr>
													</thead>
													<tbody>

														<?php while ($result=mysql_fetch_assoc($execut)) { ?>
															<tr>
																<td><?php echo( $result["matricule"] ); ?></td>
																<td><?php echo( $result["nom_per"] ); ?> <?php echo utf8_encode( $result["prenom_per"] ); ?></td>
																<td><?php echo( $result["fonction"] ); ?></td>
																<td><?php echo( $result["statut"] ); ?></td>
																<td>
																	<?php  
																		$sex= $result["sexe_per"] ;
																		if($sex=="F"){
																	?>
																		<label class="form-checkbox-label">
																			<input class="form-checkbox-input" type="checkbox" name="prs<?php echo( $result["matricule"] ); ?>" value="Presente"  checked="">	
																			<span class="form-checkbox-sign">Présente</span>
																		</label>
																		<label class="form-checkbox-label ml-3">
																			<input class="form-checkbox-input" type="checkbox" name="abs<?php echo( $result["matricule"] ); ?>" value="Absente">
																			<span class="form-checkbox-sign">Absente</span>
																		</label>
																	<?php }else{ ?>
																		<label class="form-checkbox-label">
																			<input class="form-checkbox-input" type="checkbox" name="prs<?php echo( $result["matricule"] ); ?>" value="Presente"  checked="">	
																			<span class="form-checkbox-sign">Présent</span>
																		</label>
																		<label class="form-checkbox-label ml-3">
																			<input class="form-checkbox-input" type="checkbox" name="abs<?php echo( $result["matricule"] ); ?>" value="Absente">
																			<span class="form-checkbox-sign">Absent</span>
																		</label>
																	<?php } ?>
																	
																</td>
															</tr>
														<?php } ?>

													</tbody>
												</table>
												<button type="submit" data-toggle="tooltip" title="" class="btn btn-success" data-original-title="Valider le pointage">
													<i class="far fa-check-circle"></i>  Terminer
												</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php	include("include/Footbar.php");	?>
        </div>
	</div>
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