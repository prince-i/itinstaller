
<?php
	define("title","IT SYSTEM INSTALLER");
	require "function/server.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo title;?></title>
	<link rel="icon" href="assets/favicon.jpg" type="image/gif" sizes="16x16">
	<link rel="stylesheet" type="text/css" href="node_modules/materialize-css/dist/css/materialize.min.css">
	<link rel="stylesheet" type="text/css" href="node_modules/material-design-icons/iconfont/material-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
	
	<style type="text/css">
	
	</style>
</head>
<body>
	<div class="row" id="main">
		<h3 class="center">IT SYSTEM INSTALLER</h3>
		<div class="col l12 s12 m12" >
			<div class="input-field">
			<a data-target="modal_admin" class="btn green modal-trigger">ADMIN</a>
			</div>
			<div class="input-field">
				<!-- search -->
				<input type="text" id="Searchtxt"><label>Search</label>
				
			</div>
		
			<table class="container" id="shortcuts"></table>
		
		</div>

	</div>

		<!-- modal login -->
		<div class="modal" id="modal_admin" style="width:400px;">
			<div class="modal-content">
				<h3 class="center">Login</h3>
					<div class="row">
						<form method="POST">
						<div class="input-field">
							<input type="text" name="username"><label id="label_user" for="username">Username</label>
						</div>

						<div class="input-field">
							<input type="password"name="pwd"><label id="label_pass">Password</label>
						</div>

						<div class="input-field">
							<input class="btn green" type="submit" name="login_btn" value="Login">
						</div>
						</form>
					</div>
			</div>
		</div>

	<script type="text/javascript" src="node_modules/materialize-css/dist/js/jquery.min.js"></script>
	<script type="text/javascript" src="node_modules/materialize-css/dist/js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.modal').modal();
			
		});

		load_shortcuts();
		function load_shortcuts(){
			var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  var response = this.responseText;
                  document.getElementById("shortcuts").innerHTML = response;
                 
                }
              };
              xhttp.open("GET", "function/process.php?process=load_shortcuts", true);
              xhttp.send();
		}
		
		 // search list
		 $(document).ready(function(){
		$("#Searchtxt").on("keyup", function() {
			var value = $(this).val().toLowerCase();
			$("#shortcuts tr").filter(function() {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
			});
		});
		});

		
	</script>
</body>
</html>