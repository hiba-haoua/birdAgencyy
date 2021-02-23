<!--
<html>
    <head>

    </head>

    <body>


        <h1>ACCEUIL</h1>

    </body>


</html>

-->


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Around the World</title>
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
    <link rel="stylesheet" href="css/styleModif.css" type="text/css" media="all">

</head>
<body id="page1">
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

            <!--<div class="img"><img src="images/banner.jpg" style="width: 622px;" alt="banner"></div>-->
        </header>
        <section id="content">
            <article class="col1">
                <h3>Nos Hotels</h3>
                <div class="pad">

                    <?php
                    require_once("config/connexion.php");


                    $sql="select hotel.id as idHotel, hotel.nom  as nomHotel,hotel.nbrEtoiles as nbrEtoiles,hotel.pention as pentionHotel,
                        hotel.prix as prixHotel , hotel.idVille as idVilleHotels,hotel.nomImage as nomImage,hotel.typeImg, hotel.image as image ,ville.id as idVille,ville.nom as nomVille,
                         ville.pays as paysVille from hotel,ville where ville.id = hotel.idVille order by hotel.id DESC limit 0,3";
                    $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());


                    foreach($result as $v) {
                        $tmpId = $v['idHotel'];

                        echo '<div class="wrapper under">';
                        if($v['typeImg'] == ""){
                            echo '<figure class="left marg_right1"><img style="height: 200px!important;width: 200px!important;" src="images/aucuneVille.gif" alt="hotel"></figure>';
                        }else{
                            echo '<figure class="left marg_right1"><img style="height: 200px!important;width: 200px!important;" src="admin/showImage.php?contexte_id='.$tmpId.'&contexte=hotel" alt="hotel"></figure>';



                        }

                        echo '<b class="pad_bot2"><strong>Hotel '.$v['nomHotel'].' </strong></b>';
                        echo '<br>';
                        for($i=0;$i<$v['nbrEtoiles'];$i++){
                            echo '<span style="color:orange;font-size: 15px" class="glyphicon glyphicon-star"> </span> ';
                        }


                        echo '<p class="pad_bot2">L\'hotel '.$v['nomHotel'].' est situé a '.$v['nomVille'].','.$v['paysVille'].' avec une pention '.$v['pentionHotel'].'</p>';

                        echo '<p>Prix de la nuité: '.$v['prixHotel'].' dinars</p>';





                    }



                    ?>






                    </div>
                <a href="Hotel.php" ><span class="marker_1"></span>Voir plus d'hotels</a>

                </div>
            </article>
            <article class="col2 pad_left1">
                <h3>Voyage Organisé</h3>

                <?php

                $sql="select hotel.nom as nomHotel,hotel.nbrEtoiles as nbrEt, hotel.prix as prixHotel, voyages.description as descVoyage,voyages.nom as nomVoyage,vol.id as idVol, vol.date_depart  as dateDepart,vol.date_retour as dateRetour,vol.prix as prixVol,vol.nbrBilleDispo as dispo , vol.id_ville as idVilleVol,ville.id as idVille,ville.nom as nomVille, ville.pays as paysVille from voyages,hotel,vol,ville where voyages.id_vol = vol.id and voyages.id_hotel = hotel.id and ville.id = vol.id_ville";

                $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                foreach($result as $v) {
                    echo '<div class="wrapper under">';
                        echo '<figure class="left marg_right1"><img src="images/Istanbul.png" style="width: 198px;" alt="Istanbul"></figure>';
                            echo '<p class="pad_bot2"><strong>'.$v['nomVille'].', '. $v['paysVille'] .'- '.$v['nomHotel'].' '.$v['nbrEt'].'*</strong></p>';
                            echo '<p class="pad_bot2">'.$v['descVoyage'].'</p>';
                        echo '<a href="VoyageOrganise.php" class="marker_2"></a>';
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