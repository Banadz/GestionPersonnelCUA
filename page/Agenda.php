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
<title>Personnel%List</title>
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
        <div class="main-panel">
            <div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="mt-3">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				<?php	include("include/Footbar.php");	?>
            </div>
        </div>
	</div>

		<?php	include("include/Foot_code.php");	?>
		<script>
            // Get the modal
            var modal = document.getElementById('id01');
        </script>
		<script>
            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
            }
        </script>
	<script >
		
	</script>
</body>
</html>