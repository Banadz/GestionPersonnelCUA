		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<?php
							$anarany=$_SESSION['name'];
                        	$getSary="SELECT * from user where (nom_admin='$anarany')";
                        	$answer=mysql_query($getSary) or die(mysql_error());
							$nombre=mysql_num_rows($answer);
							$sary=mysql_fetch_assoc($answer);
							$fiantso=$sary['prenom_admin'];
							$pic=$sary['photo_admin'];
							$cat=$sary['id_service'];
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
						<?php
							$test2="SELECT * FROM service where (id_service='$cat')";
							$val=mysql_query($test2) or die(mysql_error());
							$service=mysql_fetch_assoc($val);
						?>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
								<?php   echo utf8_encode($fiantso);    ?>
									<span class="user-level"><?php	echo utf8_encode($_SESSION['cat']);	?></span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="ProfilUser.php">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<ul class="nav nav-primary">
						<li class="nav-item active">
							<a href="Home.php" class="collapsed" aria-expanded="false">
								<i class="fas fa-home"></i>
								<p>Acceuil</p>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Congé et Absence</h4>
						</li>
						<?php
							if(($cat=='SCUA')||($cat=='SVOIRIE')){
						?>
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-user-edit"></i>
								<p>Absence</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="Pointage.php">
											<i class="fas fa-check-square"></i>
											<p>Pointage</p>
										</a>
									
									</li>
									<li>
										<a href="Statistique.php">
											<i class="fas fa-chart-bar"></i>
											<p>Statistique</p>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse" href="#conge">
								<i class="fas fa-plane-departure"></i>
								<p>Congé</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="conge">
								<ul class="nav nav-collapse">
									<li>
										<a href="Conge.php">
											<i class="fas fa-bookmark"></i>
											<p>Congé</p>
										</a>
									</li>
									<li>
										<a href="NouveauConge.php">
											<i class="fas fa-paper-plane"></i>
											<p>Nouveau congé</p>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Autres</h4>
						</li>
						<li class="nav-item">
							<a href="AffichePersonnel.php">
								<i class="fas fa-clipboard-list"></i>
								<p>Liste du personnel</p>
							</a>
						</li>
						<?php }else{ ?>
						<li class="nav-item">
							<a data-toggle="collapse" href="#base">
								<i class="fas fa-pen-square"></i>
								<p>Congé et Absence</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="base">
								<ul class="nav nav-collapse">
									<li>
										<a href="Pointage.php">
											<i class="fas fa-check-square"></i>
											<p>Pointage</p>
										</a>
									
									</li>
									<li>
										<a href="Conge.php">
											<i class="fas fa-paper-plane"></i>
											<p>Congé</p>
										</a>
									</li>
									<li>
										<a href="Statistique.php">
											<i class="fas fa-chart-bar"></i>
											<p>Statistique</p>
										</a>
									</li>
									<li>
										<a href="NouveauConge.php?titre=DE">
											<i class="icon-paper-clip"></i>
											<p>Attribuer un D.E</p>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse disable" href="#sidebarLayouts">
								<i class="fas fa-donate"></i>
								<p>Solde et Paie</p>
								<span class="caret"></span>
							</a>
							<div class="collapse" id="sidebarLayouts">
								<ul class="nav nav-collapse">
									<li>
										<a href="sidebar-style-1.html">
											<span class="sub-item">Sidebar Style 1</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse  disable" href="#forms">
								<i class="fas fa-layer-group"></i>
								<p>Avancement</p>
								<span class="caret"></span>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse  disable" href="#charts">
								<i class="fas fa-suitcase-rolling"></i>
								<p>Retraite</p>
								<span class="caret"></span>
							</a>
						</li>
						<li class="nav-item">
							<a data-toggle="collapse  disable" href="#submenu">
								<i class="fas fa-bars"></i>
								<p>Affectation</p>
								<span class="caret"></span>
							</a>
						</li>
						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Autre</h4>
						</li>
						<li class="nav-item">
							<a href="AffichePersonnel.php">
								<i class="fas fa-clipboard-list"></i>
								<p>Liste du personnel</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="GestionUser.php">
								<i class="fas fa-user-circle"></i>
								<p>Gérer les utilisateurs</p>
							</a>
						</li>
							
						<?php	} ?>
					</ul>
					
				</div>
			</div>
		</div>