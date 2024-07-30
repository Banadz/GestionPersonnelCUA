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
<title>Conge%validation</title>
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
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Validation du conge</h4>
											<a href="Home.php" class="btn-round ml-auto" style="text-decoration:none; color:white;">
												<button class="btn btn-danger btn-lg">
													<i class="fas fa-angle-double-right"></i>
													Retour
												</button>
											</a>
									</div>
								</div>
								<div class="card-body">
									<!-- Modal -->
									
									<!-- End modal -->

									<!-- request -->

									<?php
										$affich_conge="SELECT personnel.nom_per,DAY(conge.date_conge) as jour, MONTH(conge.date_conge) as mois, conge.numerotation,YEAR(conge.date_conge) 
										as anne ,personnel.prenom_per,personnel.fonction, conge.etat_conge,
										personnel.statut, conge.motif, (DATEDIFF(conge.date_fin,conge.date_debut)+1) 
										as nbr_jour, conge.date_debut, conge.date_fin FROM personnel, Conge 
										where (personnel.matricule=conge.matricule) and(conge.etat_conge='en attente')";
										$conge=mysql_query($affich_conge) or die(mysql_error());
									?>

									<!-- End request -->

									<div class="table-responsive">
                                        <table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Date</th>
													<th>Nom et Prénom</th>
													<th>Fonction</th>
													<th>Motif</th>
													<th>Nombre de jour</th>
													<th>Date du début</th>
													<th>Date de la fin</th>
													<th>Etat</th>
													<th></th>
												</tr>
											</thead>
											<tbody>

												<?php while ($result_conge=mysql_fetch_assoc($conge)) { ?>
													<tr>
														<td>
															<?php
																$day=$result_conge["jour"];
																$month=$result_conge["mois"];
																$l_month=$month2[$month];
																$anne=$result_conge["anne"];
																$ledate="$day $l_month $anne";
																echo( $ledate );
															?>
														</td>
														<td><?php echo( $result_conge["nom_per"] ); ?> <?php echo utf8_encode( $result_conge["prenom_per"] ); ?></td>
														<td><?php echo( $result_conge["fonction"] ); ?></td>
														<td><?php echo( $result_conge["motif"] ); ?></td>
														<td><?php echo( $result_conge["nbr_jour"] ); ?></td>
														<td><?php echo( $result_conge["date_debut"] ); ?></td>
														<td><?php echo( $result_conge["date_fin"] ); ?></td>
														<td>
																<?php if(( $result_conge["etat_conge"]=="accordé")){ ?>
                                                                    <div style="color:blue;">
                                                                        <b><?php echo( $result_conge["etat_conge"] ); ?></b>
                                                                    </div>
                                                                <?php }else{ ?>
																	<?php if(( $result_conge["etat_conge"]=="refusé")){ ?>

																		<div style="color:red;">
																			<b><?php echo( $result_conge["etat_conge"] ); ?></b>
																		</div>
																		<?php }else{ ?>
																		<div>
																			<?php echo( $result_conge["etat_conge"] ); ?>
																		</div>

                                                                	<?php } ?>
																<?php } ?>
														</td>
														<td>
															<?php if(( $result_conge["etat_conge"]=="en attente")){ ?>
																<div class="form-button-action">
																	<a href="AccordConge.php?matri=<?php echo( $result_conge["numerotation"] ); ?>">
																		<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Accepter">
																			<i class="fas fa-check-circle"></i>
																		</button>
																	</a>
																	<a href="AccordConge.php?cule=<?php echo( $result_conge["numerotation"] ); ?>">
																		<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Refuser">
																			<i class="fas fa-times-circle"></i>
																		</button>
																	</a>
																</div>
																<?php }else{ ?>
																<div>
																	<a href="AccordConge.php?cule=<?php echo( $result_conge["numerotation"] ); ?>">
																		<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Refuser">
																			<i class="fas fa-times-circle"></i>
																		</button>
																	</a>
																</div>

															<?php } ?>

															
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