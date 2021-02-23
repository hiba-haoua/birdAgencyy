<div class="wrapper">
    <!--<h1><a href="index.html" id="logo">Bird Agency</a></h1>-->
    <h1>
        <img src="./images/logo2.jpg" id="logo" />
    </h1>
    <div class="right" >
        <div id="link">

            <?php
            session_start();

            if(isset($_GET["action"])){
                if($_GET["action"] == "logoutAdmin"){
                    if(isset($_SESSION['auth'])){
                        unset($_SESSION['auth']);

                    }

                }


                if($_GET["action"] == "logoutClient"){
                    if(isset($_SESSION['authClient'])){
                        unset($_SESSION['authClient']);
                    }
                }


            }


            if(isset($_SESSION['auth'])){
                echo "Connecté en tant que ".$_SESSION['auth']['login'];
                echo "<a href='index.php?action=logoutAdmin'>Déconnexion</a>";
            }else {

                if(isset($_SESSION['authClient'])){


                    echo "Connecté en tant que Client : ".$_SESSION['authClient']['nom']." ".$_SESSION['authClient']['prenom'];
                    echo "<a href='index.php?action=logoutClient'>Déconnexion</a>";

                }else{

                    echo "<a href=\"loginclient.php\">Connexion</a>";

                }

            }
            ?>



        </div>

    </div>
</div>
<nav>
    <ul id="menu">
        <li><a href="index.php" class="nav1" id="acceuil">Acceuil</a></li>
        <li><a href="Hotel.php" class="nav1" id="hotel">Hotel</a></li>
        <li><a href="Vols.php" class="nav1" id="vols">Vols</a></li>
        <li><a href="VoyageOrganise.php" class="nav1" id="event">Evenement</a></li>
        <li><a href="VoyageOrganise.php" class="nav1" id="voyage">Voyage organisé</a></li>
        <li ><a href="contacts.php" class="nav1" id="contact">Contacts</a></li>

    </ul>
</nav>