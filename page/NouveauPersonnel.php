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
<title>Personnel%Nouveau</title>
</head>
<body>
	<div class="wrapper">
    <?php include("include/Topbar.php");    ?>

    <?php include("include/Sidebar.php");   ?>

    <?php	include("include/Foot_code.php");	?>

    	<div class="main-panel">
            <div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Ajouter un nouveau personnel</h4>
											<a href="Home.php" class="btn-round ml-auto" style="text-decoration:none; color:white;">
												<button class="btn btn-danger btn-lg">
													<i class="fas fa-angle-double-right"></i>
													Retour
												</button>
											</a>
									</div>
								</div>
								<div class="card-body">
									<form action="inserer.php" method="POST" enctype="multipart/form-data">
											<div class="form-group">
												<label for="email2">Nom</label>
												<input type="text" class="form-control" value="" name="name" placeholder="votre nom">
											</div>
											<div class="form-group">
												<label for="email2">Prénom</label>
												<input type="text" class="form-control" value="" name="prenom" placeholder="votre prenom">
											</div>
											<div class="form-group">
												<label class="form-radio-label">
													<input class="form-radio-input" type="radio" name="sx" value="Homme"  checked>	
														<span class="form-radio-sign">Homme</span>
												</label>
												<label class="form-radio-label ml-3">
													<input class="form-radio-input" type="radio" name="sx" value="Femme">
														<span class="form-radio-sign">Femme</span>
												</label>
											</div>
											<div class="form-group">
												<label for="email2">Indice</label>
												<input type="text" class="form-control" value="" name="indice">
											</div>
											<div class="form-group">
												<label for="email2">Fonction</label>
												<input type="text" class="form-control" value="" name="fonction" placeholder="votre fonction">
											</div>
											<div class="form-group">
												<label for="email2">Cadre</label>
												<select class="form-control form-control" name="cadre">
													<option value="CUA">Personnel de la Mairie</option>
													<option value="VOIRIE">Personnel du VOIRIE</option>
												</select>
											</div>
											<div class="form-group">
												<label for="email2">Statut</label>
												<select class="form-control form-control" name="section">
													<?php	
														$avoir="SELECT * from categorie";
														$e_avoir=mysql_query($avoir) or die(mysql_error());
														while($r_avoir=mysql_fetch_assoc($e_avoir)){
															$abreviation=$r_avoir['ab_statut'];
															$designation=$r_avoir['design_statut'];
													?>
													<option value="<?php	echo($abreviation);	?>"> <?php	echo($abreviation);	?></option>
													<?php	}	?>
												</select>
											</div>
											<div class="form-group">
												<label for="email2">CIN</label>
												<input type="text" class="form-control" value="" name="cin" placeholder="">
											</div>
											<div class="form-group">
												<label for="email2">Téléphone</label>
												<input type="text" class="form-control" value="" name="phone" placeholder="034*******">
											</div>
											<div class="form-group">
												<label for="email2">Adresse</label>
												<input type="text" class="form-control" value="" name="adres" placeholder="votre adresse">
											</div>
											<div class="form-group">
												<label for="smallSelect">Nomrbe d'enfant en charge</label>
												<select class="form-control form-control" name="nbr_enf">
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
												</select>
											</div>
											<div class="form-group">
												<label for="">Photo recente</label>
												<input type="file" class="form-control" value="" name="photo" placeholder="">
											</div>
											<div class="card-action">
												<button class="btn btn-primary" type="submit">Inserer</button>
												<a href="Home.php" class="btn btn-danger">Annuler</a>
											</div>
									</form>
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