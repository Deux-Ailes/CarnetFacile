<?php
    session_start();
    if(!isset($_SESSION['loggedIN'])){
        header('Location: login.php');
    }
    if(isset($_POST['login'])) {
	  $connection = new mysqli('localhost','root','', 'site');
	  $id = $_SESSION["id"];
	  $result= mysqli_query($connection, "SELECT * FROM Vehicules WHERE idUSER='$id'");
        //! Fin du check de connection de l'user
    }
?>
 <style type="text/css">
        :root {
          font-size: 16px;
          font-family: 'Open Sans';
          --text-primary: #b6b6b6;
          --text-secondary: #ececec;
          --bg-primary: #23232e;
          --bg-secondary: #141418;
          --transition-speed: 600ms;

        }

        body {
          color: black;
          background-color: white;
          margin: 0;
          font-family: 'Poppins', sans-serif;
          padding: 0;
        }

        main {
          margin-left: 6rem;
          padding: 1rem;
        }

        .navbar {
          position: fixed;
          background-color: var(--bg-primary);
          transition: width 600ms ease;
          overflow: hidden;
        }

        .navbar-nav {
          list-style: none;
          padding: 0;
          margin: 0;
          display: flex;
          flex-direction: column;
          align-items: center;
          height: 100%;
        }

        .nav-item {
         width: 100%;
        }

        .nav-item:last-child {
          margin-top: auto;
        }

        .nav-link {
          display: flex;
          align-items: center;
          height: 5rem;
          color: var(--text-primary);
          text-decoration: none;
          filter: grayscale(100%) opacity(0.7);
          transition: var(--transition-speed);
        }

        .nav-link:hover {
          filter: grayscale(0%) opacity(1);
          background: var(--bg-secondary);
          color: var(--text-secondary);
        }

        .link-text {
          display: none;
          margin-left: 3.25rem;
        }

        .nav-link svg {
          width: 2rem;
          min-width: 2rem;
          margin: 0 1.5rem;
        }

        .fa-primary {
          color: #42C0FB;
        }

        .fa-secondary {
          color: #00688B;
        }

        .fa-primary,
        .fa-secondary {
          transition: var(--transition-speed);
        }

        .logo {
          font-weight: bold;
          text-transform: uppercase;
          margin-bottom: 1rem;
          text-align: center;
          color: var(--text-secondary);
          background: var(--bg-secondary);
          font-size: 1.5rem;
          letter-spacing: 0.3ch;
          width: 100%;
        }

        .logo svg {
          transform: rotate(0deg);
          transition: var(--transition-speed);
        }

        .logo-text {
          display: inline;
          position: absolute;
          left: -999px;
          transition: var(--transition-speed);
        }

        .navbar:hover .logo svg {
          transform: rotate(-180deg);
        }

        .fa-stack{
         margin-left:1.25rem;
        }

        /* Small screens */
        @media only screen and (max-width: 600px) {
          .navbar {
              bottom: 0;
              width: 100vw;
              height: 5rem;
          }

          .logo{
              display:none;
          }
          
          .fa-stack{
              margin-left:auto;
              margin-right:auto;
          }
          .navbar-nav {
              flex-direction: row;
          }

          .nav-link {
              justify-content: center;
          }

          main {
              margin: 0;
          }
        }

        /* Large screens */
        @media only screen and (min-width: 600px) {
          .navbar {
              top: 0;
              width: 5rem;
              height: 100vh;
          }

          .navbar:hover {
              width: 16rem;
          }

          .navbar:hover .link-text {
              display: inline;
          }

          .navbar:hover .logo svg
          {
              margin-left: 11rem;
          }

          .navbar:hover .logo-text
          {
              left: 0px;
          }
        }

		.display_vehicule{
			display: flex;
			justify-content : space-around;
		}
    </style>
<html>
    <head>
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Main font -->
        <script src="https://kit.fontawesome.com/a81368914c.js"></script> <!-- Get the different set of icons -->
        <script src="https://kit.fontawesome.com/37366ba499.js" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
      	<nav class="navbar">
			<ul class="navbar-nav">
			<li class="logo">
				<a href="#" class="nav-link">
				<span class="link-text logo-text">Garage</span>
				<svg
					aria-hidden="true"
					focusable="false"
					data-prefix="fad"
					data-icon="angle-double-right"
					role="img"
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 448 512"
					class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x"
				>
					<g class="fa-group">
					<path
						fill="currentColor"
						d="M224 273L88.37 409a23.78 23.78 0 0 1-33.8 0L32 386.36a23.94 23.94 0 0 1 0-33.89l96.13-96.37L32 159.73a23.94 23.94 0 0 1 0-33.89l22.44-22.79a23.78 23.78 0 0 1 33.8 0L223.88 239a23.94 23.94 0 0 1 .1 34z"
						class="fa-secondary"
					></path>
					<path
						fill="currentColor"
						d="M415.89 273L280.34 409a23.77 23.77 0 0 1-33.79 0L224 386.26a23.94 23.94 0 0 1 0-33.89L320.11 256l-96-96.47a23.94 23.94 0 0 1 0-33.89l22.52-22.59a23.77 23.77 0 0 1 33.79 0L416 239a24 24 0 0 1-.11 34z"
						class="fa-primary"
					></path>
					</g>
				</svg>
				</a>
			</li>
		
			<li class="nav-item">
				<a href="add.php" class="nav-link">
					<g class="fa-group">
					<span  class="fa-stack">
					<div fill="currentColor" class="fa-primary">
						<i class="fas fa-plus fa-stack-2x"></i>               
						</div>
						
					</span>
					</g>
				<span class="link-text">Ajout</span>
				</a>
			</li>
		
			<li class="nav-item">
				<a href="#" class="nav-link">
					<g class="fa-group">
					<span  class="fa-stack">
						<div fill="currentColor" class="fa-primary">
						<i class="fas fa-user fa-stack-2x"></i>               
						</div>
					</span>
					</g>
				</svg>
				<span class="link-text">Compte</span>
				</a>
			</li>
		
			<li class="nav-item">
				<a href="../WebsitePages/logout.php" class="nav-link">
					<g class="fa-group">
					<span  class="fa-stack">
						<div fill="currentColor" class="fa-primary">
						<i class="fas fa-sign-out-alt fa-stack-2x"></i>
						</div>
					</span>
					</g>
				
				<span class="link-text">D&eacute;connexion</span>
				</a>
			</li>
		
			<li class="nav-item">
				<a href="#" class="nav-link">
					<g class="fa-group">
					<span  class="fa-stack">
						<div fill="currentColor" class="fa-primary">
						<i class="fas fa-moon fa-stack-2x"></i>
						</div>
					</span>
					</g>
				</svg>
				<span class="link-text">Th&ecirc;me sombre</span>
				</a>
			</li>
			</ul>
      	</nav>
		<main>
			<div class="display_garage">
				<?
					while($row = mysqli_fetch_array($result)){
				?>
				<div class='display_vehicule'>
				<div class='display_marquemodele'>
				<?= echo $row['MarqueVE']; echo $row['ModeleVE']; ?>
				</div>	//Fin div marque modele
				<div class='display_annee'>
				<?= echo $row['AnneeVE'];	?>
				</div>	//Fin div annee						
				</div>	//Fin div vehicule
				<? 
					}
				?>
				
			</div>
		</main>
    </body>
</html>
