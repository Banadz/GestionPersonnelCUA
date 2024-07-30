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
<title>Conge%Main</title>
</head>
<body>
	<div class="wrapper">
	<?php
		include("include/Topbar.php");
	?>
	<?php
		include("include/Sidebar.php");
		include("include/Horloge.php");
	?>

		<div class="main-panel">
            <div class="content">
				<div class="page-inner">
					
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Gestion du conge</h4>
									</div>
								</div>
								<div class="card-body">
									

									<!-- request -->

									<?php
										$affich_conge="SELECT personnel.nom_per,DAY(conge.date_conge) as jour, MONTH(conge.date_conge) as mois, YEAR(conge.date_conge) as anne ,personnel.prenom_per,personnel.fonction, conge.etat_conge,
										personnel.statut, conge.motif, conge.numerotation,(DATEDIFF(conge.date_fin,conge.date_debut)+1) as nbr_jour, DAY(conge.date_debut) as jourd, MONTH(conge.date_debut) as moisd, DAY(conge.date_fin) as jourf, MONTH(conge.date_fin) as moisf
										FROM personnel, Conge where (personnel.matricule=conge.matricule)";
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
													<th>Operation</th>
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
														<td>
															<?php
																$dayd=$result_conge["jourd"];
																$monthd=$result_conge["moisd"];
																$l_monthd=$month2[$monthd];
																$ledated="$dayd $l_monthd";
																echo( $ledated); 
															?>
														</td>
														<td>
															<?php
																$dayf=$result_conge["jourf"];
																$monthf=$result_conge["moisf"];
																$l_monthf=$month2[$monthf];
																$ledatef="$dayf $l_monthf";
																echo( $ledatef); 
															?>
														</td>
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
															<div class="form-button-action">


																<?php if(( $result_conge["etat_conge"]=="en attente")){ ?>
																	<a href="ModifConge.php?numero=<?php echo( $result_conge['numerotation'] ); ?>&&prenom=<?php echo( $result_conge['prenom_per'] ); ?>">
																		<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-primary" data-original-title="Modifier">
																			<i class="fa fa-edit"></i>
																		</button>
																	<a href="SupprimerConge.php?num=<?php echo( $result_conge["numerotation"] ); ?>">
																		<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer">
																			<i class="fa fa-times"></i>
																		</button>
																	</a>
                                                                <?php }else{ ?>
																	<a href="SupprimerConge.php?num=<?php echo( $result_conge["numerotation"] ); ?>">
																		<button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Supprimer">
																			<i class="fa fa-times"></i>
																		</button>
																	</a>
																<?php } ?>


																
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