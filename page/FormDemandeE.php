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
<title>Attribution%DE</title>
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
										<h4 class="card-title">Attribuer une DE</h4>
											<a href="NouveauConge.php?titre=DE" class="btn-round ml-auto" style="text-decoration:none; color:white;">
												<button class="btn btn-danger btn-lg">
													<i class="fas fa-angle-double-right"></i>
													Retour
												</button>
											</a>
									</div>
								</div>
								<div class="card-body">
                                    <?php   
                                        $matricule=$_GET['matricule'];
                                        $prenom=$_GET['prenom'];
                                        $info=$_GET['info'];
                                    ?>
									<form action="DemandeE.php?matris=<?php   echo($matricule);    ?>" method="POST">
										
										<div class="col-md-12">
											<div class="form-group">
												<input name="info" type="text" class="form-control" style="border:none;" value="<?php   echo($info);  ?>">
											</div>
										</div>		
										
										<div class="col-md-12">
											<div class="form-group form-group-default">
										    	<label>A</label>
											    <input name="prenom" type="text" class="form-control" value="<?php   echo($prenom);    ?>"disabled>
											</div>
										</div>
                                        <div class="col-md-12">
											<div class="form-group">
										    	<label>Motif</label>
											    <input name="motif" type="textbox" class="form-control" value="absence">
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label>Date</label>
												<input name="date" type="date" class="form-control" placeholder="">
											</div>
										</div>
										<div class="form-group">
											<label for="email2">Journée</label>
											<select class="form-control form-control" name="journe">
												<option value="Matin">Maraina</option>
												<option value="Après-midi">Tolakandro</option>
											</select>
										</div>
											
										<div class="card-action">
											<button class="btn btn-primary" type="submit">Valider</button>
											<a href="NouveauConge.php?titre=DE.php" class="btn btn-danger">Annuler</a>
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