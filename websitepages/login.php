<?php
session_start();

if (isset($_SESSION['loggedIN'])) {
	header('Location: garage.php');
	exit();
}

if (isset($_POST['login'])) {
	$connection = new mysqli('localhost', 'root', '', 'site');

	$username = $connection->real_escape_string($_POST['usernamePHP']);
	$password = $connection->real_escape_string($_POST['passwordPHP']);

	$data = $connection->query("SELECT id FROM users WHERE username='$username' AND password='$password'");
	if ($data->num_rows > 0) {
		$_SESSION['loggedIN'] = '1';
		$_SESSION['username'] = $username;
		while ($row = mysqli_fetch_row($data)) {
			$id = $row[0];
			$_SESSION["id"] = $id;
		}

		exit('Success');
	} else {
		exit('Failure');
	}
	exit($username . "=" . $password);
}

?>
<html>

<head>
	<title>Connexion</title>
	<link rel="stylesheet" type="text/css" href="../css/styleconnectregister.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Main font -->
	<script src="https://kit.fontawesome.com/a81368914c.js"></script> <!-- Get the different set of icons -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

	<div class="container">
		<div class="img">
			<img src="../img/bg.svg">
		</div>
		<div class="login-content">
			<form action="login.php" method="POST">
				<img class="avatar" src="../img/avatar.svg">
				<h2 class="title">Connexion</h2>
				<div class="input-div one">
					<div class="i">
						<i class="fas fa-user"></i> <!-- User icon -->
					</div>
					<div class="div">
						<h5>Nom d'utilisateur</h5>
						<input type="text" class="input" name="username" id="username">
					</div>
				</div>
				<div class="input-div pass">
					<div class="i">
						<i class="fas fa-lock"></i> <!-- Lock icon -->
					</div>
					<div class="div" id="resultat">
						<h5>Mot de passe</h5>
						<input type="password" class="input" name="password" id="password">
					</div>
				</div>
				<a href="#">Mot de passe oubli&eacute;?</a>
				<input type="button" class="btn" value="Me connecter" id="submit">
				<img class="loading_icon" id="loading_icon" src="../img/waiting.gif">
				<p id="resultlog"></p>
			</form>
		</div>

	</div>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			console.log('page ready');
			$("#submit").on('click', function() {
				var username = $("#username").val().trim();
				var password = $("#password").val().trim();

				if (username == "" || password == "") {
					alert('Veuillez remplir les champs');
				} else {
					$("#loading_icon").css({
						"display": "flex"
					});
					$.ajax({
						url: 'login.php',
						method: 'POST',
						data: {
							login: 1,
							usernamePHP: username,
							passwordPHP: password
						},
						success: function(response) {
							$("#loading_icon").css({
								"display": "none"
							});
							console.log(response);


							if (response.indexOf('Success') >= 0) {
								window.location = 'garage.php';
							} else {
								$("#resultlog").css({
									"color": "red"
								});
								$("#resultlog").html("Identifiants introuvables ou mot de passe incorrect");
							}
						},
						dataType: 'text'
					})
				}

			})
		})
	</script>


</body>

</html>