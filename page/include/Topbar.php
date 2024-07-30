
<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="blue">
				
				<a href="Home.php" class="logo">
					<img src="../image/Armoirie_CUA.png" style="width:10%;">
					<h5 style="color:white;" class="d-inline" class="navbar-brand">Gestion du Personnel</h5>
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- ENTÊTE-->

			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Rechercher..." class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
							<?php
								include('include/Horloge.php');

								$affich_conge="SELECT * FROM Conge where (etat_conge='en attente')";
								$conge=mysql_query($affich_conge) or die(mysql_error());
								$nombre=mysql_num_rows($conge);
								if(($nombre!=0)){
									$nbconge=1;
								}else{
									$nbconge=0;
								}

								$daty=date('Y-m-d');
								
								$pointage="SELECT absence.numero,DAY( absence.date_pointage) as jour, MONTH( absence.date_pointage) as mois,
								YEAR( absence.date_pointage) as anne, personnel.prenom_per,absence.matricule, personnel.cadre, absence.journe
								,absence.etat_pointage from personnel,absence
								where (absence.matricule=personnel.matricule)and (absence.etat_pointage ='absent')and (absence.journe='$after')
								and (absence.date_pointage='$daty') and (personnel.cadre='CUA')
								or (absence.matricule=personnel.matricule)and (absence.etat_pointage ='absente')and (absence.journe='$after')and (absence.date_pointage='$daty')
								and (absence.journe='$after')and (absence.date_pointage='$daty') and personnel.cadre='CUA'";

								$daty=date('Y-m-d');
																
								$pointage2="SELECT absence.numero from personnel,absence
								where (absence.matricule=personnel.matricule)and (absence.etat_pointage ='absent')and (absence.journe='$after')
								and (absence.date_pointage='$daty') and (personnel.cadre='VOIRIE')
								or (absence.matricule=personnel.matricule)and (absence.etat_pointage ='absente')and (absence.journe='$after')and (absence.date_pointage='$daty')
								and (absence.journe='$after')and (absence.date_pointage='$daty') and (personnel.cadre='VOIRIE')";

								$pointage4="SELECT user.prenom_admin, information.imma, information.ref, information.section,DAY(information.date_info) as jour, 
								MONTH(information.date_info) as mois, YEAR(information.date_info) as anne
								from information, user where (user.id=information.id) and (ref != '') and (information.section='pointage')";

								$point=mysql_query($pointage) or die(mysql_error());
								$effectif=mysql_num_rows($point);

								$point2=mysql_query($pointage2) or die(mysql_error());
								$effectif2=mysql_num_rows($point2);

								$point4=mysql_query($pointage4) or die(mysql_error());
								$effectif4=mysql_num_rows($point4);
								// $raisina=mysql_fetch_assoc($point4);
								// $raisina_nom=$_SESSION['name'];
								// $vondrona=$raisina['section'];
								// $ref=$raisina['ref'];
								// $hamafana=$raisina['imma'];

								// $day=$raisina["jour"];
								// $month=$raisina["mois"];
								// $l_month=$month2[$month];
								// $anne=$raisina["anne"];
								// $calendar="$day $l_month $anne";

								if(($effectif !=0)){
									$nbr=1;
								}else{
									$nbr=0;
								}

								if(($effectif2 !=0)){
									$nbr2=1;
								}else{
									$nbr2=0;
								}
								if(($effectif4 !=0)){
									$nbr4=$effectif4;
								}else{
									$nbr4=0;
								}
								$notif= ($nbr + $nbconge + $nbr2 + $nbr4) ;
								$id_ser=$_SESSION['id_cat'];
							?>
						<?php	if(($id_ser=="SCUA")||($id_ser=="SVOIRIE")){	?>
						<?php	}else{	?>
							<li class="nav-item dropdown hidden-caret">
								<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-bell"></i>
									<?php	if(($notif != 0)){	?>
										<span class="notification">
											<?php	echo($notif);	?>
										</span>
									<?php	}else{?>
									<?php }	?>

								</a>
								<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
									<li>
										<div class="dropdown-title">
										<?php if(($notif != 0)){	?>
													Vous avez 
													<?php	if(($notif != 0)){	?>

																<?php	if(($notif == 1))	{?>
																	<?php	echo($notif);	?> notification
																<?php	}	?>

																<?php	if(($notif > 1))	{?>

																<?php	echo($notif);	?> notifications
															<?php	}	?>

													<?php	}	?>
												</div>
											</li>
											<?php	if(($nombre != 0)){	?>
											<li>
												<div class="notif-center">
													<a href="ValidationConge.php">
														<div class="notif-icon notif-primary"> <i class="fa fa-user-plus"></i> </div>
														<div class="notif-content">
															<span class="block">

															<?php	if(($nombre == 1))	{?>
																	un nouveau congé en enttente
																<?php	}	?>

																<?php	if(($nombre > 1))	{?>

																<?php	echo($nombre);	?> nouveaux congés en attentes
															<?php	}	?>

															
															
															</span>
															<span class="time">
																<?php echo($aujourdhui); ?> <?php echo(date('d')); ?> <?php echo($mois); ?>
															</span> 
														</div>
													</a>
												</div>
											</li>
											<?php	}	?>
											<?php	if(($effectif != 0)){	?>
											<li>
												<div class="notif-center">
													<a href="ListAbs.php?cadre=CUA">
														<div class="notif-icon notif-warning"> <i class="fas fa-edit"></i> </div>
														<div class="notif-content">
															<span class="block">

															<?php	if(($effectif == 1))	{?>
																	un absent pour la Mairie
																<?php	}	?>

																<?php	if(($effectif > 1))	{?>

																<?php	echo($effectif);	?> absents pour la Mairie
															<?php	}	?>


															</span>
															<span class="time">
																<?php echo($aujourdhui); ?> <?php echo(date('d')); ?> <?php echo($mois); ?>
															</span> 
														</div>
													</a>
													
												</div>
											</li>
											<?php	}	?>
											<?php	if(($effectif2 != 0)){	?>
											<li>
												<div class="notif-center">
													<a href="ListAbs.php?cadre=VOIRIE">
														<div class="notif-icon notif-danger"> <i class="fas fa-edit"></i> </div>
														<div class="notif-content">
															<span class="block">

																<?php	if(($effectif2 == 1))	{?>
																		un absent pour la Voirie
																	<?php	}	?>

																	<?php	if(($effectif2 > 1))	{?>

																	<?php	echo($effectif2);	?> absents pour la Voirie
																<?php	}	?>
															
															</span>
															<span class="time">
																<?php echo($aujourdhui); ?> <?php echo(date('d')); ?> <?php echo($mois); ?>
															</span> 
														</div>
													</a>
													
												</div>
											</li>
											<?php	}	?>
											<?php while($raisina=mysql_fetch_assoc($point4)){
												$raisina_nom=$_SESSION['name'];
												$vondrona=$raisina['section'];
												$ref=$raisina['ref'];
												$hamafana=$raisina['imma'];

												$day=$raisina["jour"];
												$month=$raisina["mois"];
												$l_month=$month2[$month];
												$anne=$raisina["anne"];
												$calendar="$day $l_month $anne";
											?>
											<li>
												<div class="notif-center">
													<a href="Demarquer.php?iteration=<?php echo ($hamafana);?>&&ref=<?php echo ($ref);?>">
														<div class="notif-icon notif-link"> <i class="icon-pencil"></i> </div>
														<div class="notif-content">
															<span class="block">
																<?php	echo ($raisina_nom);	?> a changé un pointage
															</span>
															<span class="block">
																<?php
																	if($vondrona=="pointage"){
																		$au_nom="SELECT absence.numero, personnel.prenom_per from personnel,absence where (personnel.matricule=absence.matricule)
																		and (absence.numero='$ref')";
																	}
																	$queries=mysql_query($au_nom) or die(mysql_error());
																	$results=mysql_fetch_assoc($queries);
																	$surname=$results['prenom_per'];
																?>
																au nom de <?php	echo ($surname);	?>
															</span>
															<span class="time">
																<?php echo($calendar); ?>
															</span>
														</div>
													</a>
												</div>
											</li>
											
											<?php	}	?>
									<?php	}else{?>
										Il n'y a pas de notification
									<?php }	?>
										
								</ul>
							</li>
						<?php	}	?>
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
								<i class="fas fa-layer-group"></i>
							</a>
							<div class="dropdown-menu quick-actions quick-actions-info animated fadeIn">
								<div class="quick-actions-header">
									<span class="title mb-1">Opération courante</span>
									<span class="subtitle op-8">Racourcis</span>
								</div>
								<div class="quick-actions-scroll scrollbar-outer">
									<div class="quick-actions-items">
										<div class="row m-0">
											<?php if(($id_ser=="SCUA")||($id_ser=="SVOIRIE")){ ?>
												<a class="col-6 col-md-4 p-0" href="AffichePersonnel.php">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text">Liste du personnel</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="NouveauPersonnel.php">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Nouveau personnel</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="VerificationPointage.php">
												<div class="quick-actions-item">
													<i class="flaticon-list"></i>
													<span class="text">Voir pointage</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="NouveauConge.php">
												<div class="quick-actions-item">
													<i class="flaticon-message"></i>
													<span class="text">Nouveau congé</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="Echiquier.php">
												<div class="quick-actions-item">
													<i class="flaticon-agenda-1"></i>
													<span class="text">Echiquier de l'absence par semaine</span>
												</div>
											</a>

											<?php }else{ ?>
											
											<a class="col-6 col-md-4 p-0" href="NouveauPersonnel.php?titre=CG">
												<div class="quick-actions-item">
													<i class="flaticon-pen"></i>
													<span class="text">Nouveau personnel</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="VerificationPointage.php">
												<div class="quick-actions-item">
													<i class="flaticon-list"></i>
													<span class="text">Voir pointage</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="NouveauConge.php?titre=CG">
												<div class="quick-actions-item">
													<i class="flaticon-message"></i>
													<span class="text">Nouveau congé</span>
												</div>
											</a>
												<a class="col-6 col-md-4 p-0" href="GestionUser.php">
													<div class="quick-actions-item">
														<i class="flaticon-user-5"></i>
														<span class="text">Gérer les Utilisateurs</span>
													</div>
												</a>
											<a class="col-6 col-md-4 p-0" href="Echiquier.php">
												<div class="quick-actions-item">
													<i class="flaticon-agenda-1"></i>
													<span class="text">Echiquier de l'absence par semaine</span>
												</div>
											</a>
											<a class="col-6 col-md-4 p-0" href="Agenda.php">
												<div class="quick-actions-item">
													<i class="flaticon-file-1"></i>
													<span class="text">Agenda</span>
												</div>
											</a>
											<?php	} ?>
										</div>
									</div>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                <?php
                                    $anarany=$_SESSION['name'];
                                    $getSary="SELECT photo_admin from user where (nom_admin='$anarany')";
                                    $answer=mysql_query($getSary) or die(mysql_error());
                                    $nombre=mysql_num_rows($answer);
                                    $sary=mysql_fetch_assoc($answer);
                                ?>
                                <?php
                                    $anarany=$_SESSION['name'];
                                    $getSary="SELECT photo_admin, mail_admin from user where (nom_admin='$anarany')";
                                    $answer=mysql_query($getSary) or die(mysql_error());
                                    $nombre=mysql_num_rows($answer);
                                    $sary=mysql_fetch_assoc($answer);
									$pic=$sary['photo_admin'];
                                ?>
                                <?php if (empty($pic)) {?>
                                    <div class="avatar-sm float-left mr-2">
                                        <img src="../profil/Standard.jpg" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                <?php }else{?>
                                    <div class="avatar-sm float-left mr-2">
                                        <img src="../profil/<?php echo $sary['photo_admin']; ?>" alt="..." class="avatar-img rounded-circle">
                                    </div>
                                <?php }?>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
                                        
                                        <?php if (empty($pic)) {?>
                                            <div class="avatar-lg">
                                                <img src="../profil/Standard.jpg" alt="image profile" class="avatar-img rounded">
                                            </div>
                                        <?php }else{?>
                                            <div class="avatar-sm float-left mr-2">
                                                <img src="../profil/<?php echo $sary['photo_admin']; ?>" alt="image profile" class="avatar-img rounded">
                                            </div>
                                        <?php }?>
											<div class="u-text">
												<h4><?php   echo $_SESSION['name'];    ?></h4>
												<p class="text-muted"><?php echo $sary['mail_admin']; ?></p>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="ProfilUser.php">Profile</a>
										<a class="dropdown-item" href="Logout.php">Se deconnecter</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>

			<!-- FIN ENTÊTE -->
		</div>