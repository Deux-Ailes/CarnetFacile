<?php
session_start();

if (isset($_POST['modified'])) {
  $connection = new mysqli('localhost', 'root', '', 'site');
  //? Récupération des valeurs
  $type = $connection->real_escape_string($_POST['typePHP']);
  $marque = $connection->real_escape_string($_POST['marquePHP']);
  $modele = $connection->real_escape_string($_POST['modelePHP']);
  $annee = $_POST['anneePHP'];
  $km = $_POST['kmPHP'];


  //? Initialisation chaînes qui seront implémentées dans SQL

  //!Ce groupe n'est pas utilisé, en attendant de trouver 
  //!un moyen d'utiliser les vars de manière plus optimale
  //! 1 query vs 5
  $insertion = "";   //Du style TypeVE, MarqueVE etc...
  $classetype = "";  //Du style ?,?,?,?,?
  $chainetype = "";  //Du style "sssdsdss"
  $init = 0;

  $id = $_SESSION["id"];
  $idvehi = $_SESSION['idvehi'];

  //? Formatage des valeurs
  $type = strtolower($type);
  if ($km < 0) exit("Km non valide");
  //? Test des valeurs transmises
  if ($type != "") {
    $insertion .= "TypeVE";
    $init = 1;
    $classetype .= "?";
    $chainetype .= "s";
    $itype = 1;

    //? RequêteSQl
    $sql = "UPDATE vehicules SET TypeVE='$type' WHERE idUSER='$id' AND idVE='$idvehi'";
    mysqli_query($connection, $sql);
  }

  if ($marque != "") {
    if ($init) $insertion .= ",MarqueVE";
    else {
      $insertion .= "MarqueVE";
      $init = 1;
    }
    $classetype .= ",?";
    $chainetype .= "s";
    $imarque = 1;

    //? RequêteSQl
    $sql = "UPDATE vehicules SET MarqueVE='$marque' WHERE idUSER='$id' AND idVE='$idvehi'";
    mysqli_query($connection, $sql);
  }

  if ($modele != "") {
    if ($init) $insertion .= ",ModeleVE";
    else {
      $insertion .= "ModeleVE";
      $init = 1;
    }
    $classetype .= ",?";
    $chainetype .= "s";
    $imodele = 1;

    //? RequêteSQl
    $sql = "UPDATE vehicules SET ModeleVE='$modele' WHERE idUSER='$id' AND idVE='$idvehi'";
    mysqli_query($connection, $sql);
  }

  if ($annee > 0) {
    if ($init) $insertion .= ",AnneeVE";
    else {
      $insertion .= "AnneeVE";
      $init = 1;
    }
    $classetype .= ",?";
    $chainetype .= "d";
    $iannee = 1;

    //? RequêteSQl
    $sql = "UPDATE vehicules SET AnneeVE='$annee' WHERE idUSER='$id' AND idVE='$idvehi'";
    mysqli_query($connection, $sql);
  }

  if ($km > 0) {
    if ($init) $insertion .= ",KilometresVE";
    else {
      $insertion .= "KilometresVE";
      $init = 1;
    }
    $classetype .= ",?";
    $chainetype .= "d";
    $ikm = 1;

    //? RequêteSQl
    $sql = "UPDATE vehicules SET KilometresVE='$km' WHERE idUSER='$id' AND idVE='$idvehi'";
    mysqli_query($connection, $sql);
  }

  //? Test des valeurs avec filtre
  if (preg_match('[^A-Za-z0-9]', $type)) exit("Type non valide");
  if (preg_match('[^A-Za-z0-9]', $marque)) exit("Marque non valide");
  if (preg_match('[^A-Za-z0-9]', $modele)) exit("Modèle non valide");

  //! Le fun commence ici



}
?>
<style type="text/css">
  * {
    font-family: 'Poppins', sans-serif;
  }

  :root {
    font-size: 16px;
    font-family: 'Poppins', sans-serif;
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
    z-index: 4;
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

  .fa-stack {
    margin-left: 1.25rem;
  }

  /* Small screens */
  @media only screen and (max-width: 768px) {
    .navbar {
      bottom: 0;
      width: 100vw;
      height: 5rem;
    }

    .logo {
      display: none;
    }

    .fa-stack {
      margin-left: auto;
      margin-right: auto;
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
  @media only screen and (min-width: 768px) {
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

    .navbar:hover .logo svg {
      margin-left: 11rem;
    }

    .navbar:hover .logo-text {
      left: 0px;
    }
  }

  .content-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    min-width: 400px;
    border-radius: 5px 5px 0 0;
    overflow: hidden;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
  }

  .content-table thead tr {
    background-color: #3e8cea;
    color: white;
    text-align: left;
    font-weight: bold;
  }

  .content-table th,
  .content-table td {
    padding: 12px 15px;
  }

  .content-table tbody tr {
    border-bottom: 1px solid #3e8cea;
  }

  .content-table tbody tr:last-of-type {
    border-bottom: 2px solid #3e8cea;
  }

  /* Dropdown Button */
  .dropbtn {
    background-color: #3498DB;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
  }

  /* Dropdown button on hover & focus */
  .dropbtn:hover,
  .dropbtn:focus {
    background-color: #2980B9;
  }

  /* The container <div> - needed to position the dropdown content */
  .dropdown {
    position: relative;
    display: inline-block;
  }

  /* Dropdown Content (Hidden by Default) */
  .dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
    z-index: 1;
  }

  .dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
  }

  .dropdown-content a:hover {
    background-color: #ddd
  }


  .show {
    display: block;
  }

  #Typec,
  #Marquec,
  #Modelec,
  #Anneec,
  #Kmc,
  #Confirm {
    display: none;
    width: 400px;
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
        <a href="garage.php" class="nav-link">
          <span class="link-text logo-text">Garage</span>
          <svg aria-hidden="true" focusable="false" data-prefix="fad" data-icon="angle-double-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-angle-double-right fa-w-14 fa-5x">
            <g class="fa-group">
              <path fill="currentColor" d="M224 273L88.37 409a23.78 23.78 0 0 1-33.8 0L32 386.36a23.94 23.94 0 0 1 0-33.89l96.13-96.37L32 159.73a23.94 23.94 0 0 1 0-33.89l22.44-22.79a23.78 23.78 0 0 1 33.8 0L223.88 239a23.94 23.94 0 0 1 .1 34z" class="fa-secondary"></path>
              <path fill="currentColor" d="M415.89 273L280.34 409a23.77 23.77 0 0 1-33.79 0L224 386.26a23.94 23.94 0 0 1 0-33.89L320.11 256l-96-96.47a23.94 23.94 0 0 1 0-33.89l22.52-22.59a23.77 23.77 0 0 1 33.79 0L416 239a24 24 0 0 1-.11 34z" class="fa-primary"></path>
            </g>
          </svg>
        </a>
      </li>

      <li class="nav-item">
        <a href="add.php" class="nav-link">
          <g class="fa-group">
            <span class="fa-stack">
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
            <span class="fa-stack">
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
            <span class="fa-stack">
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
            <span class="fa-stack">
              <div fill="currentColor" class="fa-primary">
                <i class="fas fa-moon fa-stack-2x"></i>
              </div>
            </span>
          </g>
          </svg>
          <span class="link-text">Th&egrave;me<br>sombre</span>
        </a>
      </li>
    </ul>
  </nav>
  <main>
    <table class="content-table">
      <thead>
        <tr>
          <th> Type </th>
          <th> Marque </th>
          <th> Modele </th>
          <th> Annee </th>
          <th> Kilometres </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          $connection = new mysqli('localhost', 'root', '', 'site');
          $id = $_SESSION["id"];
          $idvehi = $_SESSION['idvehi'];
          $result = mysqli_query($connection, "SELECT TypeVE, MarqueVE, ModeleVE, AnneeVE, KilometresVE FROM vehicules WHERE idUSER='$id' AND idVE='$idvehi'");
          while ($row = mysqli_fetch_array($result)) {
            echo "<td>" . $row['TypeVE'] . "</td>";
            echo "<td>" . $row['MarqueVE'] . "</td>";
            echo "<td>" . $row['ModeleVE'] . "</td>";
            echo "<td>" . $row['AnneeVE'] . "</td>";
            echo "<td>" . $row['KilometresVE'] . "</td>";
          }
          ?>
        </tr>
      </tbody>
    </table>
    <!-- Ajout du bouton pour modifier un champ -->
    <div class="dropdown&champs">
      <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Modification d'une valeur</button>
        <div id="myDropdown" class="dropdown-content">
          <a id="Type" onclick="GetDisplayedField('Type')">Type</a>
          <a id="Marque" onclick="GetDisplayedField('Marque')">Marque</a>
          <a id="Modele" onclick="GetDisplayedField('Modele')">Modele</a>
          <a id="Annee" onclick="GetDisplayedField('Annee')">Annee</a>
          <a id="Km" onclick="GetDisplayedField('Km')">Kilometres</a>
        </div>
      </div>
      <div id="champs">
        <fieldset id="Typec">
          <input type="text" placeholder="Type" id="Typet">
        </fieldset>
        <fieldset id="Marquec">
          <input type="text" placeholder="Marque" id="Marquet">
        </fieldset>
        <fieldset id="Modelec">
          <input type="text" placeholder="Modele" id="Modelet">
        </fieldset>
        <fieldset id="Kmc">
          <input type="number" placeholder="Kilometres" id="Kmt">
        </fieldset>
        <fieldset id="Anneec">
          <input type="number" placeholder="Annee" id="Anneet">
        </fieldset>
        <button id="confirm" onclick="confirm()">Validation</button>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Ferme le menu si l'utilisateur clique à côté de celui-ci
    window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
          var openDropdown = dropdowns[i];
          if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
          }
        }
      }
    }

    function GetDisplayedField(a) {
      var field = a + "c";
      var element = document.getElementById(field);
      element.style.display = "block";
      var element2 = document.getElementById("confirm");
      if (element2.style.display != "block") element2.style.display = "block";
    }

    function confirm() {

      //? Disparition des champs lors du traitement
      var DivChamps = document.getElementById("champs");
      DivChamps.style.display = "none";

      //? Récupération de la data de tous les champs
      type = $("#Typet").val().trim()
      modele = $("#Modelet").val().trim()
      marque = $("#Marquet").val().trim();
      annee = $("#Anneet").val().trim();
      km = $("#Kmt").val().trim();

      //? Formatage des champs remplis
      //! La vérification se fera dans la partie PHP, plus rapide que sur le JS qui demandrait plus de lignes de code
      // type = type.val().trim();
      // modele = modele.val().trim();
      // marque = marque.val().trim();
      annee = parseInt(annee, 10);
      km = parseInt(km, 10);

      $.ajax({
        url: 'vehicule.php',
        method: 'POST',
        data: {
          modified: 1,
          typePHP: type,
          marquePHP: marque,
          modelePHP: modele,
          anneePHP: annee,
          kmPHP: km
        },
        success: function(response) {

          console.log(response);

          //?Plein de stuff là dedans

        },
        dataType: 'text'
      })
    }
  </script>
</body>

</html>