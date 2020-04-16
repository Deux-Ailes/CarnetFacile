    <?php 
        session_start();
        if(!isset($_SESSION['loggedIN'])){
            header('Location: login.php');
        }

        if(isset($_POST['submitted'])){
            $connection = new mysqli('localhost','root','', 'site'); 
            if(isset($_SESSION['username'])){
                $username=$_SESSION['username'];
                $data = $connection->query ("SELECT id FROM users WHERE username='$username'");
                if($data->num_rows > 0){
                    $row= $data->fetch_assoc();
                    $_SESSION['id']=$row.["id"];  
                }
                else{}
                else{
                    exit("Erreur d'username les bros")
                }
            }
            //?Récupération des valeurs
            
            $marque = $connection->real_escape_string($_POST['marquePHP']);
            $modele = $connection->real_escape_string($_POST['modelePHP']);
            $type = $_POST['typePHP'];
            $annee = $_POST['anneePHP'];
            $ct = $_POST['ctPHP'];
            $entretien = $_POST['entretienPHP'];
            $km = $_POST['kmPHP'];

            $sql = "INSERT INTO vehicles (TypeVE,MarqueVE,ModeleVE,AnneeVE,DateCTVE,DateEntretienVE,KilometresVE,idUSER) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			if($stmt= mysqli_prepare($connection, $sql)){
				mysqli_stmt_bind_param($stmt, "sssssssdd", $typestmt, $marquestmt, $modelestmt, $anneestmt, $ctstmt, $entretienstmt, $kmstmt, $idstmt);
				$usernamestmt = $username;
				$passwordstmt = $password;
				$emailstmt = $email;

				if(mysqli_stmt_execute($stmt)){
					$_SESSION['loggedIN'] = '1';
					$_SESSION['username'] = $username;
					
					exit("Inscription réussie, vous allez être redirigé dans 3 secondes");
				}

            exit("On est arrivé au bout, c'est déjà bien");
            //!FIN DE LA CONNEXION & TEST SOUMISSION DU FORM
        }



        //$query_date = "INSERT INTO tablename (col_name, col_date) VALUES ('DATE: Manual Date', '2008-7-04')”

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
            z-index: 10;
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

        .logo-text{
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

            
        #Formulaire{
              width: 60vw;
              height: 60vh;
              display: block;
              left: 0px;
              border-radius: 3px;
              border-color: black;
        }

        #Form_Vehi{
                width: 600px;
                margin: 50px auto;                
                position: relative;
                font-family: 'Poppins', sans-serif;
        }

        #Form_Vehi fieldset{
                background: white;
                border: 0 none;
                border-radius: 3px;
                padding: 20px 30px;
                box-sizing: border-box;
                width: 60vw;
                margin: 0 10%;
                
                /* Pour pouvoir les stacks les uns sur les autres*/
                position: relative;
        }
                /* Pour cacher les fieldsets sauf le premier*/
        #Form_Vehi fieldset:not(:first-of-type){
                display: none;
        }

        #d_Fieldset{
                text-align: left;
                padding: 1rem; 
        }


            /* Inputs */

        #Form_Vehi input{
                padding: 1rem;
                border: 1px solid #ccc;  
                border-radius: 3px;
                margin-bottom: 10px;
        }

        #Form_Vehi #Replaced_Autre{
                display: none;
                text-align: center;
        }

        #Form_Vehi .action-button{
                width: 100px;
                background: blue;
                font-weight: bold;
                color: white;
                border: 0 none;
                border-radius: 1px;
                padding: 10px 5px;
                margin: 10px 5px;
        }

        #Form_Vehi .action-button:hover, #Form_Vehi .action-button:focus{
               box-shadow: 0 0 0 2px white, 0 0 0 3px silver; 
        }

        .fs-title{
                font-size: 15px;
                text-transform: uppercase;
                margin-bottom: 0.8rem;
        }

        .fs-subtitle{
                font-weight: normal;
                margin-bottom: 20px;
        }

        #progressbar {
                text-align: center;
                margin-bottom: 30px;
                overflow: hidden;
                /*CSS counters to number the steps*/
                counter-reset: step;
        }
            
        #progressbar li {
                list-style-type: none;
                color: black;
                text-transform: uppercase;
                font-size: 12px;
                width: 33.33%;
                float: left;
                position: relative;
        }
        
        #progressbar li:before {
                content: counter(step);
                counter-increment: step;
                width: 20px;
                line-height: 20px;
                display: block;
                font-size: 10px;
                color: #333;
                background: grey;
                border-radius: 3px;
                margin: 0 auto 5px auto;
        }
            /*progressbar connectors*/
        #progressbar li:after {
                content: '';
                width: 100%;
                height: 2px;
                background: black;
                position: absolute;
                left: -50%;
                top: 9px;
                z-index: -1; 
        }
        #progressbar li:first-child:after {
            content: none; 
        }

        #progressbar li.active:before,  #progressbar li.active:after{
            background: #27AE60;
            color: white;
        }
    </style>
    <html>
    <head>
       
        <link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet"> <!-- Main font -->
        <script src="https://kit.fontawesome.com/a81368914c.js"></script> <!-- Get the different set of icons -->
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
                <a href="#" class="nav-link">
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
            <div id="Formulaire">
                <form id="Form_Vehi">
                    <!--Grid -->

                    <!--ProgressBar -->
                    <ul id="progressbar">
                        <li class="active" class="progbar">G&eacute;n&eacute;ral</li>
                        <li class="progbar">Informations primordiales</li>
                        <li class="progbar">Informations secondaires</li>
                    </ul>
                    <div id="d_Fieldset">
                    <!--Fieldsets-->
                    <fieldset>
                        <h2 class="fs-title">Type de v&eacute;hicule</h2>
                        <h3 class="fs-subtitle">Step 1</h3>
                        <div id="d_voiture">
                            <input type="radio" id="Voiture" name="type" value="Voiture" />
                            <label for="Voiture">Voiture</label>
                        </div>
                        <div id="d_moto">
                            <input type="radio" id="Moto" name="type" value="Moto" />
                            <label for="Moto">Moto</label>
                        </div>
                        <div id="d_autre">
                            <input type="radio" id="Autre" name="type" value="Autre" />
                            <label for="Autre">Autre</label>
                        </div>
                        <input type="text" id="Replaced_Autre" placeholder="Quel type de v&eacute;hicule?">
                        <input type="button" name="Suivant" class="next action-button" value="Next" />
                    </fieldset>                    
                    <fieldset>
                        <h2 class="fs-title">Informations g&eacute;n&eacute;rales</h2>
                        <h3 class="fs-subtitle">Step 2</h3>
                        <!-- ! Des trucs funs-->
                        <input type="text" id="marque" placeholder="Marque du v&eacute;hicule?">
                        <br>
                        <input type="text" id="modele" placeholder="Mod&egrave;le de v&eacute;hicule?">
                        <br>
                        <div id="annee_vehi">
                            <label for="annee">Ann&eacute;e du v&eacute;hicule</label>
                            <br>
                            <input type="date" id="annee" value="" max="<?php echo date('Y-m-d'); ?>">                        
                        </div>
                        
                        <br>
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="button" name="Suivant" class="next action-button" value="Next" />

                    </fieldset>
                    <fieldset>
                        <h2 class="fs-title">Informations d&eacute;taill&eacute;es</h2>
                        <h3 class="fs-subtitle">Step 3</h3>

                        <input type="number" id="km" value="0" placeholder="Kilométrage du véhicule" required>
                        <div id="entretien_vehi">
                            <label for="entretien">Date du dernier entretien</label>
                            <br>
                            <input type="date" id="entretien" value="" max="<?php echo date('Y-m-d'); ?>">                        
                        </div>

                        <div id="ct_vehi">
                            <label for="ct">Date du dernier Controle technique</label>
                            <br>
                            <input type="date" id="ct" value="" max="<?php echo date('Y-m-d'); ?>">                        
                        </div>
                        
                        <input type="button" name="previous" class="previous action-button" value="Previous" />
                        <input type="button" class="submit action-button" value="Enregistrer" id="submit">
                    </fieldset>
                    <p id="resultlog"></p>
                    </div>
                </form>
            </div>
        </main>
        
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            var current_fs, next_fs, previous_fs; //Setup des fieldsets
            var left, opacity, scale; //propriétés qui vont être animées
            var animating; //Flag pour éviter que l'utilisateur ne puisse glitch en faisant de multiples clicks rapides
            var index_fs=0;
            // ! Code non optimal mais permet de gérer l'affichage d'un textField.
            // ! Sa valeur sera analysée par la suite selon l'état du radiobutton avec la fonction .checked qui renvoit 0 si non coché et 1 si coché.
            $("#Autre").on('click',function(){
                    $("#Replaced_Autre").css({"display" : "block"});
            })

            $("#Moto").on('click',function(){
                    $("#Replaced_Autre").css({"display" : "none"});
            })

            $("#Voiture").on('click',function(){
                    $("#Replaced_Autre").css({"display" : "none"});
            }) 

            $(".next").click(function(){
                if(animating){
                    return false;
                    
                }
                animating=true;
                current_fs=$(this).parent();
                next_fs=$(this).parent().next();
                index_fs=index_fs+1;
                $(".progbar").eq(index_fs-1).addClass("active");
                //$("progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
                next_fs.show();
                //On cache le fieldsetactuel
                current_fs.animate({opacity: 0}, {step: function(now, mx){
                        //L'opacité du fieldset actuel descend à 0 -> Stocké dans "now"
                        //On va réduire au fur et a mesure l'opacity du fieldset actuel et augmenter celle du futur au fur et à mesure
                        scale = 1 - (1-now)*0.2;
                        left= (now * 50)+"%";
                        opacity=1-now;
                        current_fs.css({
                            'transform':'scale('+scale+')',
                            'position': 'absolute'
                        });
                        next_fs.css({'left':left, 'opacity': opacity});
                    },
                    duration: 800,
                    complete: function(){
                    current_fs.hide();
                    animating=false;
                    },

                    easing: 'easeInOutBack'
                });


            });
            $(".previous").click(function(){
                if(animating) return false; 
                $(".progbar").eq(index_fs-1).removeClass("active");
                index_fs=index_fs-1;
                animating = true;            
                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();
            
                //$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
                previous_fs.show(); 
                current_fs.animate({opacity: 0}, {
                    step: function(now, mx) {
                        scale = 0.8 + (1 - now) * 0.2;
                        left = ((1-now) * 50)+"%";
                        opacity = 1 - now;
                        current_fs.css({'left': left});
                        previous_fs.css({'transform': 'scale('+scale+')', 'opacity': opacity});
                    }, 
                    duration: 800, 
                    complete: function(){
                        current_fs.hide();
                        animating = false;
                    }, 
                    easing: 'easeInOutBack'
                });
            });

            //TODO Effectuer une fonction qui permet d'initialiser un bool pour savoir si la personne a cliqué sur la date. Faire un onClick
            //TODO afin de pouvoir ensuite dire si oui ou non la date a été modifiée. (et comparer également à un blank pour les champs optionnels).
            //TODO Penser à mettre les required sur les champs
            
            //Création de toutes les variables qui seront à remplir pour l'envoi du formulaire avec Ajax
            var type, marque, modele, annee, ct, entretien, km;
            var error=0, msg_error; //!Sert pour annoncer qu'une erreur s'est produite dans la phase de checking des valeurs
            console.log('page ready');
			$("#submit").on('click',function(){

                //? Test Step 1
                    //var rb_voiture = document.getElementById("voiture").checked;
                    //var rb_moto = document.getElementById("moto").checked;
                    //var rb_autre = document.getElementById("autre").checked;

                    if(document.getElementById("Voiture").checked){
                        type="voiture";
                    }

                    if(document.getElementById("Moto").checked){
                        type="moto";
                    }

                    if(document.getElementById("Autre").checked){
                        if((type=$("#Replaced_Autre").val().trim())== ""){
                            msg_error= "Vous n'avez pas rempli le champ du type de véhicule correctement.";
                            error=1;
                        }
                    }

                //? Test Step 2
                    if((marque = $("#marque").val().trim())==""){
                        msg_error = msg_error+ "\n" + "Vous n'avez pas renseigné de marque.";
                        error=1;
                    }

                    if((modele = $("#modele").val().trim())==""){
                        msg_error = msg_error + "\n" + "Vous n'avez pas renseigné de modèle.";
                        error=1;
                    }
                    
                    //? Alternative pour obtenir la variable : var dateControl = document.querySelector("div#annee_vehi input[type='date']");                    
                    if((annee = $("#annee").val())==""){
                        msg_error = msg_error + "\n" + "Vous n'avez pas renseigné de date valide.";
                        error=1;
                    }

                //? Test Step 3

                    if((km= $("#km").val())=="0"){
                        msg_error = msg_error + "\n" + "Vous n'avez pas renseigné un kilométrage valide.";
                        error=1;
                    }

                    if((ct = $("#ct").val())==""){
                        msg_error = msg_error + "\n" + "Vous n'avez pas renseigné de date de contrôle technique valide.";
                        error=1;
                    }
                
                    if((entretien = $("#entretien").val())==""){
                        msg_error = msg_error + "\n" + "Vous n'avez pas renseigné de date d'entretien valide.";
                        error=1;
                    }
                    
                    //?Début de la grosse partie avec Ajax
                    if(error==0)
                    {
                        $.ajax(
						    {
							url: 'add.php',
							method : 'POST',
							data: {
								submitted: 1,
                                typePHP: type, 
                                marquePHP: marque,
                                modelePHP: modele, 
                                anneePHP: annee, 
                                ctPHP: ct, 
                                entretienPHP: entretien, 
                                kmPHP: entretien
							},
							success: function(response){
								$("#loading_icon").css({"display":"none"});
                                console.log(response);
                                
                                //?Plein de stuff là dedans
                                $("#resultlog").html(response);
                            },
                            dataType: 'text'
                            }
                        )
								
                    }

                //!FIN DU SUBMIT
            })
        </script>
    </body>
    </html>
