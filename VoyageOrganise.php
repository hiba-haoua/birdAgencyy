<!DOCTYPE html>
<html lang="en">
<head>
    <title>Voyages Organisés</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/styles.css" type="text/css" media="all">
    <link rel="stylesheet" type="text/css" href="css/jquery.simplebanner.css"/>

    <!--<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">-->

    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/jquery.simplebanner.js"></script>
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <link href="css/bootstrap.css" rel="stylesheet">

    <!--
    <link href="css/style.css" rel="stylesheet">

    -->

    <![endif]-->
    <link rel="stylesheet" href="css/styleModif.css" type="text/css" media="all">


</head>
<body id="page2">
<!-- START PAGE SOURCE -->
<div class="extra">
    <div class="main">
        <header>
            <?php

            include_once("headerClient.php");


            ?>

            <div id="rotating" class="simpleBanner img" style="width: 100%;margin-top: -235px;padding-left: 20px;padding-top: 30px;">
                <div class="bannerListWpr">
                    <ul class="bannerList">
                        <!-- LI list goes here -->
                        <li><img src="images/image1.jpg" class="mySlides" /></li>
                        <li><img src="images/image2.jpg" class="mySlides" /></li>
                        <li><img src="images/image3.jpg" class="mySlides" /></li>
                        <li><img src="images/image4.jpg" class="mySlides" /></li>
                        <li><img src="images/image5.jpg" class="mySlides" /></li>
                        <li><img src="images/image6.jpg" class="mySlides" /></li>
                    </ul>
                </div>
                <a class="w3-btn-floating w3-display-left" onclick="plusDivs(-1)"
                   style="margin-top: -17%;margin-left: 44px;text-decoration: none;">&#10094;</a>
                <a class="w3-btn-floating w3-display-right" onclick="plusDivs(1)" style="margin-top: -17%;text-decoration: none;">&#10095;</a>
            </div>

        </header>
        <section id="content">
            <article class="col1">
                <h3>Derniers Voyages</h3>
                <div class="pad">


                    <?php
                    require_once("config/connexion.php");



                    $sql="select hotel.nom as nomHotel, hotel.prix as prixHotel, voyages.description as descVoyage,voyages.nom as nomVoyage,vol.id as idVol, vol.date_depart  as dateDepart,vol.date_retour as dateRetour,vol.prix as prixVol,vol.nbrBilleDispo as dispo , vol.id_ville as idVilleVol,ville.id as idVille,ville.nom as nomVille, ville.pays as paysVille from voyages,hotel,vol,ville where voyages.id_vol = vol.id and voyages.id_hotel = hotel.id and ville.id = vol.id_ville order by vol.id desc limit 0,2";
                    $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                    foreach($result as $v) {
                        $tmpId=$v['idVol'];
                        echo '<div class="wrapper under">';
                        echo '<figure class="left marg_right1"><img style="height: 200px;width: 200px" src="images/aucuneVille.gif" alt=""></figure>';
                        echo '<br>';
                        echo '<p class="pad_bot2">  <strong>'.$v['nomVoyage'].'</strong><br>';
                        echo '<p class="pad_bot2"> Hotel: <b>'.$v['nomHotel'].'</b><br>';
                        echo '<p>'.$v['descVoyage'].'<br>';
                        echo '<p class="pad_bot2"> vers <strong>'.$v['nomVille'].', '. $v['paysVille'] .'<br>';
                        echo '</strong></p>';
                        echo '<b>'.$v['dispo'].'</b> billés disponibles encore.';
                        echo '<br>';
                        echo '<br>';
                        echo '<i>Date départ :</i><b> '.$v['dateDepart'].'</b>';
                        echo '<br>';
                        echo '<i>Date retour :</i><b> '.$v['dateRetour'].'</b>';
                        echo '<br>';
                        echo '<br>';
                        echo '<p class="pad_bot2"><i>Prix du vol: </i><b>'.$v['prixVol'].'dinars tunisien</b> </p>';
                        echo '<p class="pad_bot2"><i>Prix de l\'hotel: </i><b>'.$v['prixHotel'].'dinars tunisien</b> </p>';

                        echo '</div>';

                    }

                    ?>









                </div>
            </article>
            <article class="col2 pad_left1">
                <h2>Tous nos Voyages Organisés</h2>

                <?php
                require_once("config/connexion.php");



                $sql="select hotel.nom as nomHotel, hotel.prix as prixHotel, voyages.description as descVoyage,voyages.nom as nomVoyage,vol.id as idVol, vol.date_depart  as dateDepart,vol.date_retour as dateRetour,vol.prix as prixVol,vol.nbrBilleDispo as dispo , vol.id_ville as idVilleVol,ville.id as idVille,ville.nom as nomVille, ville.pays as paysVille from voyages,hotel,vol,ville where voyages.id_vol = vol.id and voyages.id_hotel = hotel.id and ville.id = vol.id_ville";

                $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                foreach($result as $v) {
                    $tmpId = $v['idVol'];

                    echo '<div class="wrapper under">';
                    echo '<figure class="left marg_right1"><img style="height: 350px;width: 350px" src="images/aucuneVille.gif" alt=""></figure>';

                    echo '<br>';
                    echo '<br>';
                    echo '<p class="pad_bot2">  <strong>'.$v['nomVoyage'].'</strong><br>';
                    echo '<p class="pad_bot2"> Hotel: <b>'.$v['nomHotel'].'</b><br>';

                    echo '<p>'.$v['descVoyage'].'<br>';
                    echo '<h2 style="font-size: 20px!important;" class="pad_bot2"> vers <strong>'.$v['nomVille'].', '. $v['paysVille'] .'<br>';
                    echo '</strong></h2>';
                    echo '<b style="color: orange">'.$v['dispo'].'</b> billés disponibles encore.';
                    echo '<br>';
                    echo '<br>';
                    echo '<i>Date départ :</i><b> '.$v['dateDepart'].'</b>';
                    echo '<br>';
                    echo '<i>Date retour :</i><b> '.$v['dateRetour'].'</b>';
                    echo '<br>';
                    echo '<br>';
                    echo '<p class="pad_bot2"><i>Prix du vol: </i><b style="color:green">'.$v['prixVol'].' dinars tunisien</b><hr>Prix Hotel: <b style="color:green">'.$v['prixHotel'].' dinars tunisien</b></p>';




                    echo '</div>';

                }



                ?>




            </article>
        </section>
    </div>
    <div class="block"></div>
</div>
<div class="body1">
    <div class="main">
        <footer>
            <div class="footerlink">
                <p class="lf">Copyright &copy; 2016 <a href="#">Bird Agency</a> - All Rights Reserved</p>
                <p class="rf">Design by <a target="_blank" href="https://www.facebook.com/profile.php?id=100014283612167">Elyes Benrhouma</a></p>
                <div style="clear:both;"></div>
            </div>
        </footer>
    </div>
</div>
<script type="text/javascript"> Cufon.now(); </script>
<script type="text/javascript">
    var slideIndex = 1;
    showDivs(slideIndex);

    function plusDivs(n) {
        showDivs(slideIndex += n);
    }

    function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        x[slideIndex-1].style.display = "block";
    }
</script>

<!-- END PAGE SOURCE -->
</body>
</html>