
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="../index.php">Bird Agency</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="testPage.php">TestPage</a></li>
                <li><a href="hotels.php">Hotels</a></li>
                <li><a href="vols.php">Vols</a></li>
                <li><a href="voyagesOrganise.php">Voyages organisés</a></li>
                <li><a href="reservation.php">Reservations</a></li>
                <li><a href="villes.php">Villes</a></li>
                <li><?php  echo "<a href='../index.php?action=logout'>Déconnexion</a>"; ?></li>
            </ul>
            <form class="navbar-form navbar-right">
                <?php
                    echo "<span style='color:white'>Connecté en tant que ".$_SESSION['auth']["login"]."</span>";
                ?>
            </form>
        </div>
    </div>
</nav>
<div style="padding: 30px"></div>
