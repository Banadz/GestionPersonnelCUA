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
<title>Statistique%Main</title>
</head>
<body>
    <div class="wrapper">
	

        <!-- include -->
        <?php
            include("include/Topbar.php");
            include("include/Sidebar.php");
			include("include/Horloge.php");
        	include("include/Foot_code.php");
		?>

        <div class="main-panel">
			<div class="content">
				<div class="panel-header">
					<div class="page-inner py-5">
                        <div class="card-header">
						    <div class="d-flex align-items-center">
							    <h4 class="card-title">Statistique</h4>
							</div>
					    </div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row">
						<div class="col-md-6">
							<div class="card full-height">
								<div class="card-body">
									<div class="card-title">En terme d'effectif</div>
									<div class="card-category">Effectif des personnels actuellement</div>
									<div class="d-flex flex-wrap justify-content-around pb-2 pt-4">
										<div class="px-2 pb-2 pb-md-0 text-center">
											<div id="circles-1"></div>
											<h6 class="fw-bold mt-3 mb-0">Fonctionnaire</h6>
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
					<div class="col-md-12">
						<div class="card">
							<div class="card-header">
								<div class="card-title">Vue globale des absences</div>
							</div>
							<div class="card-body">
								<div class="chart-container">
									<canvas id="multipleLineChart"></canvas>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php	include("include/Footbar.php");	?>
		</div>
    </div>
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
    </script>
    <script>
		multipleLineChart = document.getElementById('multipleLineChart').getContext('2d');
		var myMultipleLineChart = new Chart(multipleLineChart, {
			type: 'line',
			data: {
				labels: [
					<?php
						
						$linepointage="SELECT DAY(daty) as jour, MONTH(daty) as mois from stock GROUP BY daty,journe";
						$answersy=mysql_query($linepointage) or die(mysql_error());

						while($pointage=mysql_fetch_assoc($answersy)){
							
							$day=$pointage["jour"];
							$month=$pointage["mois"];
							$l_month=$month2[$month];
							$ledate="$day $l_month";
						?>

					
						"<?php echo($ledate);?>",
					<?php	}	?>
				],
				datasets: [{
					label: "absents",
					borderColor: "#59d05d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#59d05d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [
						<?php
							$linepointage="SELECT * from stock where (titre='absence')";
							$answersy=mysql_query($linepointage) or die(mysql_error());
							while($pointage=mysql_fetch_assoc($answersy)){
								
								echo($pointage['valeur']);	?>,
						<?php	}	?>
						
					]
				},{
					label: "Congé",
					borderColor: "#f3545d",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#f3545d",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [
						<?php
						
							// $effectifTot="SELECT * from personnel";
							// $answers=mysql_query($effectifTot) or die(mysql_error());
							// $total=mysql_num_rows($answers);

							$linepointage2="SELECT valeur from stock where (titre='enconge')";
							$answersy2=mysql_query($linepointage2) or die(mysql_error());
							while($pointage2=mysql_fetch_assoc($answersy2)){
								
								echo($pointage2['valeur']);	?>,
						<?php	}	?>
						
					]
				},{
					label: "présent",
					borderColor: "#1d7af3",
					pointBorderColor: "#FFF",
					pointBackgroundColor: "#1d7af3",
					pointBorderWidth: 2,
					pointHoverRadius: 4,
					pointHoverBorderWidth: 1,
					pointRadius: 4,
					backgroundColor: 'transparent',
					fill: true,
					borderWidth: 2,
					data: [
						<?php
						
							$effectifTot="SELECT * from personnel";
							$answers=mysql_query($effectifTot) or die(mysql_error());
							$total=mysql_num_rows($answers);

							$linepointage3="SELECT ('$total'-valeur) as prez from stock where (titre='enconge') or (titre='absence')";
							$answersy3=mysql_query($linepointage3) or die(mysql_error());
							while($pointage3=mysql_fetch_assoc($answersy3)){
								
								echo($pointage3['prez']);	?>,
						<?php	}	?>
						
					]
				}]
			},
			options : {
				responsive: true, 
				maintainAspectRatio: false,
				legend: {
					position: 'top',
				},
				tooltips: {
					bodySpacing: 4,
					mode:"nearest",
					intersect: 0,
					position:"nearest",
					xPadding:10,
					yPadding:10,
					caretPadding:10
				},
				layout:{
					padding:{left:15,right:15,top:15,bottom:15}
				}
			}
		});


		var myLegendContainer = document.getElementById("myChartLegend");

		// generate HTML legend
		myLegendContainer.innerHTML = myHtmlLegendsChart.generateLegend();

		// bind onClick event to all LI-tags of the legend
		var legendItems = myLegendContainer.getElementsByTagName('li');
		for (var i = 0; i < legendItems.length; i += 1) {
			legendItems[i].addEventListener("click", legendClickCallback, false);
		}

	</script>

</body>

</html>