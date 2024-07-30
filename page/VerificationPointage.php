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
<title>Pointage%Verification</title>
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
											<h4 class="card-title">Verification du pointage</h4>
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
											<table id="add-row" class="display table table-striped table-hover" >
											<thead>
													<tr>
														<th>Date</th>
														<th>Journée</th>
														<th>Matricule</th>
														<th>Prénoms</th>
														<th>statut</th>
														<th>Opération</th>
													</tr>
												</thead>
												<tbody>
													<?php
													
														$cat=$_SESSION['cat'];
														$ref=$_GET['ref'];
														
														// if(($cat=='Secretaire')){
														// 	$voir_abs="SELECT absence.numero, absence.date_pointage, absence.matricule, personnel.cadre, absence.journe
														// 	, absence.etat_pointage from personnel,absence where (personnel.matricule=absence.matricule) and (personnel.cadre='CUA') 
														// 	and (absence.journe='$after')and (absence.date_pointage='$daty')";	
														// }else{
															if (!empty($ref)){
																$voir_abs="SELECT absence.numero, DAY( absence.date_pointage) as jour, MONTH( absence.date_pointage) as mois,
																YEAR( absence.date_pointage) as anne, personnel.prenom_per,absence.matricule, personnel.cadre, absence.journe
																,absence.etat_pointage from personnel,absence 
																where (personnel.matricule=absence.matricule) and (absence.numero='$ref')";
															}else{
																$voir_abs="SELECT absence.numero,DAY( absence.date_pointage) as jour, MONTH( absence.date_pointage) as mois,
																YEAR( absence.date_pointage) as anne, personnel.prenom_per,absence.matricule, personnel.cadre, absence.journe
																,absence.etat_pointage from personnel,absence
																where (absence.matricule=personnel.matricule) and (absence.journe='$after')
																and (absence.date_pointage='$daty')";
															}
																
															
														// }
														$trait=mysql_query($voir_abs) or die(mysql_error());	
													?>

													<?php while ($result=mysql_fetch_assoc($trait)) { ?>
														<tr>
															<td>
																<?php
																	$day=$result["jour"];
																	$month=$result["mois"];
																	$l_month=$month2[$month];
																	$anne=$result["anne"];
																	$ledate="$day $l_month $anne";
																	echo( $ledate );
																?>
															</td>
															<td><?php echo( $result["journe"] ); ?></td>
															<td><?php echo( $result["matricule"] ); ?></td>
															<td><?php echo utf8_encode( $result["prenom_per"] ); ?></td>
															<td>
                                                                <?php if(( $result["etat_pointage"] =="absent")||( $result["etat_pointage"] =="absente")){ ?>
                                                                    <div style="color:red;">
                                                                        <b><?php echo( $result["etat_pointage"] ); ?></b>
                                                                    </div>
                                                                <?php }else{
																		
																		if(($result["etat_pointage"])=="en congé"){ ?>
																			<div style="color:blue">
																				<?php echo( $result["etat_pointage"] ); ?>
																			</div>
																		<?php }else{ ?>
																			<div>
																				<?php echo( $result["etat_pointage"] ); ?>
																			</div>
																	<?php } ?>
																<?php } ?>
                                                            </td>
															<td>
                                                                <div class="form-button-action">
																	<?php if(($result["etat_pointage"])=="en congé"){ ?>	
																		<a href="Supprimerpointage.php?poid=<?php echo( $result["numero"] ); ?>">
																			<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer">
																				<i class="fa fa-times"></i>
																			</button>
																		</a>
																	<?php }else{ ?>
                                                                    <a href="ChangerPointage.php?num=<?php echo( $result["numero"] ); ?>&&matri=<?php echo( $result["matricule"] ); ?>">
                                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Changer">
                                                                            <i class="fas fa-sync-alt"></i>
                                                                        </button>
                                                                    </a>
                                                                    <a href="Supprimerpointage.php?poid=<?php echo( $result["numero"] ); ?>">
                                                                        <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer">
                                                                            <i class="fa fa-times"></i>
                                                                        </button>
                                                                    </a>
																	
																	<?php } ?>
                                                                </div>
															</td>
															
														</tr>
													<?php } ?>

												</tbody>
											</table>
											<a href="Imprimer_Pointage.php">
											
													<button type="submit" data-toggle="tooltip" title="" class="btn btn-primary" data-original-title="Imprimer">
														<i class="fas fa-print"></i>  Imprimer
													</button>
												</a>
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