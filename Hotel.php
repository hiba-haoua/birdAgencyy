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
            <article class="col1" style="width: 470px;">
                <h3>Nos Hotels</h3>
                <div class="pad">

                    <?php
                    require_once("config/connexion.php");


                    $sql="select hotel.id as idHotel, hotel.nom  as nomHotel,hotel.nbrEtoiles as nbrEtoiles,hotel.pention as pentionHotel,
                        hotel.prix as prixHotel , hotel.idVille as idVilleHotels,hotel.nomImage as nomImage,hotel.typeImg, hotel.image as image ,ville.id as idVille,ville.nom as nomVille,
                         ville.pays as paysVille from hotel,ville where ville.id = hotel.idVille order by hotel.id DESC";
                    $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());


                    foreach($result as $v) {
                        $tmpId = $v['idHotel'];

                        echo '<div class="wrapper under">';

                        if($v['typeImg'] == ""){
                            echo '<figure class="left marg_right1"><img style="height: 150px!important;width: 150px!important;" src="images/aucuneVille.gif" alt="hotel"></figure>';
                        }else{
                            echo '<figure class="left marg_right1"><img style="height: 150px!important;width: 150px!important;" src="admin/showImage.php?contexte_id='.$tmpId.'&contexte=hotel" alt="hotel"></figure>';



                        }


                        echo '<p class="pad_bot2"><strong>Hotel '.$v['nomHotel'].'</strong></p>';

                        echo '<p class="pad_bot2">L\'hotel '.$v['nomHotel'].' est situé a '.$v['nomVille'].','.$v['paysVille'].' avec une pention '.$v['pentionHotel'].'</p>';

                        echo '<p>Prix de la nuité: '.$v['prixHotel'].' dinars</p>';


                        echo '</div>';

                    }



                    ?>









                </div>
            </article>
            <article class="col2 pad_left1" style="width: 460px;padding-left: 25px;">
                <h3>Villes où se trouvent</h3>
                <div class="pad">

                    <?php
                    require_once("config/connexion.php");



                    $sql = "SELECT * FROM ville ";
                    $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                    foreach($result as $v) {
                        $tmpId = $v['id'];

                        echo '<div class="wrapper under">';

                        if($v['typeImg'] == ""){
                            echo '<figure class="left marg_right1"><img src="images/aucuneVille.gif" style="height: 150px!important;width: 150px!important;"></figure>';
                        }else{
                            echo '<figure class="left marg_right1"><img src="admin/showImage.php?contexte_id='.$v['id'].'&contexte=ville" style="max-height: 150px!important;max-width: 150px!important;"></figure>';
                        }


                        echo '<p class="pad_bot2"><strong>'.$v['nom'].'</strong></p>';
                        echo '<p class="pad_bot2"><strong>'.$v['pays'].'</strong></p>';

                        $sqlCount="select count(*) from hotel where idVille=".$v['id'];
                        $resultCount = $db->query($sqlCount) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                    foreach($resultCount as $c) {

                        $nbrHot=$c['count(*)'];

                    }


                        echo "<h5>On a ".$nbrHot." hotels dans cette ville</h5>";



                        echo '</div>';

                    }


                    ?>




                    <!--


                    <div class="wrapper under">
                        <figure class="left marg_right1"><img src="images/hotel.png" alt="hotel"></figure>
                        <p class="pad_bot2"><strong>Résidence Corail</strong></p>
                        <p class="pad_bot2">La Résidence Corail jouit d'un superbe emplacement en face du port
                            Yasmine de Hammamet et propose un héberge</p>
                        <a href="#" class="marker_1"></a>
                        <p style="background-color: rgba(67, 157, 235, 0.19);
                        text-align: center;
                        margin-left: 370px;
                        margin-top: -17px;
                        padding-bottom: 0px;"
                        >69.000DT</p>
                    </div>

                    -->
                </div>
            </article>
        </section>
    </div>
    <div class="block"></div>
</div>
<div class="body1">
    <div class="main">
        <footer>
            <div class="footerlink">
                <p class="lf">Copyright &copy; 2020 <a href="#">Bird Agency</a> - All Rights Reserved</p>
                <p class="rf">Design by <a target="_blank" href="https://www.facebook.com/hibahaoua">Hiba Haouari</a></p>
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