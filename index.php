<?php 

	require_once "autoload.php"; 

	if (isset($_GET['setup']) &&  $_GET['setup'] == true) {
		$setup = new Setup($db);
		$messages = $setup->createTables();

		foreach ($messages as $message) {
			echo $message.'<br>';
		}
	}
	else{
		/*echo $functions->getPage();*/
		/*if (file_exists('pages'.$page.'.php')) {
			include('pages'.$page.'.php');
		}
		else{
			http_response_code(404);
		}*/
		// exit();
		http_response_code(404);
	}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link rel="icon" type="image/x-icon" href="img/lovers.png">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script type="text/javascript" src="login.js"></script>
</head>
<body class="login">
	<div class="container" style="text-align: center; margin-top: 15%;">
		<h2 class="text-center">Login</h2><br>
		<form action="dashboard.php" class="loginForm"> <!-- dashboard.php -->
			<div class="error-message-all">
				
			</div>
			<div class="input-group">
				<label class="label" for="username">Username</label>
				<input type="text" placeholder="username" id="username" class="input">
				<span class="error-message"></span>
			</div>
			<div class="input-group">
				<label class="label" for="password">Password</label>
				<input type="password" placeholder="*****" id="password" class="password">
				<span class="error-message"></span>
			</div><br>
			<button class="button" type="submit">Login</button>
		</form>
	</div>
</body>
</html>