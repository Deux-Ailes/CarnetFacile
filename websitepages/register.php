<?php
session_start();
if(isset($_SESSION['loggedIN'])){
	header('Location: garage.php');
	exit();
}

if(isset($_POST['login'])) {
	$connection = new mysqli('localhost','root','', 'site');

	$username = $connection->real_escape_string($_POST['usernamePHP']);
	$password = $connection->real_escape_string($_POST['passwordPHP']);
	$email = $_POST['emailPHP'];


	$data = $connection->query ("SELECT id FROM users WHERE username='$username'");
	if($data->num_rows > 0){
		exit("Nom d'utilisateur déjà existant");
	}
	else{
		$data = $connection->query ("SELECT id FROM users WHERE email='$email'");
		if($data->num_rows > 0){
			exit("Email déjà utilisé");
		}
		else{
			$sql = "INSERT INTO users (username,password,email) VALUES (?, ?, ?)";
			if($stmt= mysqli_prepare($connection, $sql)){
				mysqli_stmt_bind_param($stmt, "sss", $usernamestmt, $passwordstmt, $emailstmt);
				$usernamestmt = $username;
				$passwordstmt = $password;
				$emailstmt = $email;

				if(mysqli_stmt_execute($stmt)){
					$_SESSION['loggedIN'] = '1';
					$_SESSION['username'] = $username;
					$data = $connection->query ("SELECT id FROM users WHERE username='$username'");
					if($data->num_rows > 0){						
						while ($row = mysqli_fetch_row($data)) {
							$id = $row[0];
							$_SESSION["id"]=$id;
						}
					}
					exit("Inscription réussie, vous allez être redirigé dans 3 secondes");
				} else{
					exit("ERROR: Could not execute query: $sql. " . mysqli_error($connection));
				}
				mysqli_stmt_close($stmt);			
			}
		}
	exit($username . "=" . $password . "=" . $email);
	}
}
?>
<html>
<head>
	<title>Inscription</title>
	<link rel="stylesheet" type="text/css" href="../css/styleconnectregister.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Main font -->
	<script src="https://kit.fontawesome.com/a81368914c.js"></script> <!-- Get the different set of icons -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<div class="container">
		<div class="img">
			<img src="../img/sign.svg">
		</div>
		<div class="login-content">
			<form action="register.php" method="POST" name="myForm">
				<img src="../img/welcome.svg">
				<h2 class="title">Inscription</h2>
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
           		   <div class="div">
           		    	<h5>Mot de passe</h5>
           		    	<input type="password" class="input" name="password" id="password">
            	   </div>
				</div>
				<div class="input-div validpass">
					<div class="i"> 
						 <i class="fas fa-lock"></i> <!-- Lock icon -->
					</div>
					<div class="div">
						 <h5>Confirmation</h5>
						 <input type="password" class="input" name="checkpassword" id="checkpassword">
				 </div>
			  </div>
				<div class="input-div email">
					<div class="i"> 
						 <i class="fas fa-envelope"></i> <!-- Lock icon -->
					</div>
					<div class="div">
						 <h5>Email</h5>
						 <input type="email" class="input" name="email" id="email">
				 </div>
			  </div>
            	
				<input type="button" class="btn" value="M'inscrire" id="submit">
				<p id="resultlog"></p>
            </form>
        </div>
    </div>
	<script type="text/javascript" src="../js/main.js"></script>
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
	<script type="text/javascript">

		function emailIsValid (email) {
		return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)
		}

		function sleep(milliseconds) {
			const date = Date.now();
			let currentDate = null;
			do {
				currentDate = Date.now();
			} while (currentDate - date < milliseconds);
		}

		$(document).ready(function(){
			console.log('page ready');
			$("#submit").on('click',function(){
				var username = $("#username").val().trim();
				var password = $("#password").val().trim();
				var checkpassword = $("#checkpassword").val().trim();
				var email = $("#email").val().trim();
				

				if(username == "" || password == "" || checkpassword == "" || email==""){
					alert('Veuillez remplir les champs correctement');
				}
				else{
					if(password!=checkpassword){
						$("#resultlog").css({"color" : "red"});
						$("#resultlog").html("Mots de passes différents");
					}
					else
					{
						if(!emailIsValid(email)){
							console.log("Erreur dans l'adresse mail");
							$("#resultlog").css({"color" : "red"});
							$("#resultlog").html("Email incorrect");
						}
						else{
							$.ajax(
								{
								url: 'register.php',
								method : 'POST',
								data: {
									login: 1,
									usernamePHP: username,
									passwordPHP: password,
									checkpasswordPHP: checkpassword,
									emailPHP: email
								},
								success: function(response){
									$("#loading_icon").css({"display":"none"});
									console.log(response);
									if(response.indexOf('Inscription réussie, vous allez être redirigé dans 3 secondes') >=0)
									{
										$("#resultlog").css({"color" : "green"});
										$("#resultlog").html(response);
										
										window.location ='garage.php';
										sleep(3000);
									}
									else{
									$("#resultlog").css({"color" : "red"});
									$("#resultlog").html(response);
									}
								},
								dataType: 'text'
							}
						)
						}
							
					}
					//$("#loading_icon").css({"display":"flex"});
					
				}

			})
		})
	</script>

</body>
</html>
