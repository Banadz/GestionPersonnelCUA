<?php
include("Database.php");
?>
<?php
include("include/Head_Code.php");
?>

<head>
<title>Acceuil</title>
</head>
<body>
	<div class="wrapper">
		<?php
			include("include/Topbar.php");
		?>		

		<!-- Sidebar -->
		<?php
			include("include/Sidebar.php");
		?>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="content" style="background-image: url('../image/Ambalavao2.jpg');">
				<div class="panel-header bg-primary-gradient">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold" >
									<?php
										$mr=$_SESSION['name'];
										$forma="SELECT user.sexe, user.prenom_admin, user.id_service, service.label_service from user, service 
										where (user.id_service=service.id_service) and (user.nom_admin='$mr')";
										$form=mysql_query($forma) or die(mysql_error());
										$formal=mysql_fetch_assoc($form);
										$formalite=$formal['sexe'];
										$boss=$formal['prenom_admin'];
										$service=$formal['label_service'];
										
										if($formalite=="homme"){
											echo("Monsieur le ");
											echo utf8_encode($service);
										}else{
											echo("Madame la ");
											echo utf8_encode($service);
										}
										
									?>,<br> Bienvenue
								</h2>
								<h5 class="text-white op-7 mb-2" >Mise au point du bon déroulement de gestion</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row mt--2">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">En terme d'effectif</div>
									<div class="card-category">Effectif du personnel actuellement</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<h6 class="fw-bold mt-3 mb-0">Fonctionnaires</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-2"></div>
											<h6 class="fw-bold mt-3 mb-0">EFA</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-3"></div>
											<h6 class="fw-bold mt-3 mb-0">ECD</h6>
										</div>
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-4"></div>
											<h6 class="fw-bold mt-3 mb-0">EMO</h6>
										</div>
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
	<!--   Core JS Files   -->
		<?php	include("include/Foot_code.php");	?>
		<?php
            $effectifTot="SELECT * from personnel";
            $answers=mysql_query($effectifTot) or die(mysql_error());
			$total=mysql_num_rows($answers);
			
			// Fonctionnaire
			$effectiffonct="SELECT * from personnel where (statut='Fonct.')";
            $ans_fonct=mysql_query($effectiffonct) or die(mysql_error());
			$nbr_fonct=mysql_num_rows($ans_fonct);

			// EFA
			$effectifEFA="SELECT * from personnel where (statut='EFA')";
            $ans_EFA=mysql_query($effectifEFA) or die(mysql_error());
			$nbr_EFA=mysql_num_rows($ans_EFA);

			// ECD
			$effectifECD="SELECT * from personnel where (statut='ECD')";
            $ans_ECD=mysql_query($effectifECD) or die(mysql_error());
			$nbr_ECD=mysql_num_rows($ans_ECD);

			// EMO
			$effectifEMO="SELECT * from personnel where (statut='EMO')";
            $ans_EMO=mysql_query($effectifEMO) or die(mysql_error());
			$nbr_EMO=mysql_num_rows($ans_EMO);
        ?>
	<script>
		Circles.create({
			id:'circles-1',
			radius:45,
			value:<?php	echo($nbr_fonct);	?>,
			maxValue:<?php	echo($total);	?>,
			width:7,
			text: <?php	echo($nbr_fonct);	?>,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:<?php	echo($nbr_EFA);	?>,
			maxValue:<?php	echo($total);	?>,
			width:7,
			text: <?php	echo($nbr_EFA);	?>,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:<?php	echo($nbr_ECD);	?>,
			maxValue:<?php	echo($total);	?>,
			width:7,
			text: <?php	echo($nbr_ECD);	?>,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})
		Circles.create({
			id:'circles-4',
			radius:45,
			value:<?php	echo($nbr_EMO);	?>,
			maxValue:<?php	echo($total);	?>,
			width:7,
			text: <?php	echo($nbr_EMO);	?>,
			colors:['#f1f1f1', '#3f48cc'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets : [{
					label: "Total Income",
					backgroundColor: '#ff9e27',
					borderColor: 'rgb(23, 125, 255)',
					data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
				}],
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				legend: {
					display: false,
				},
				scales: {
					yAxes: [{
						ticks: {
							display: false //this will remove only the label
						},
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
</body>
</html>