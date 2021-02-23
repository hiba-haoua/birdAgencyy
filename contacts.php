<!DOCTYPE html>
<html lang="en">
<head>
<title>Around the World</title>
<meta charset="utf-8">
  <link href="css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">
<link rel="stylesheet" href="css/styles.css" type="text/css" media="all">
<link rel="stylesheet" type="text/css" href="css/jquery.simplebanner.css"/>

<!--<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">-->

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/jquery.simplebanner.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>

  <!-- Bootstrap -->

  <link href="../style.css" rel="stylesheet">

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
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


      <article class="col2 pad_left1">
        <h2>FORMULAIRE DE CONTACT</h2>

        <?php


          if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['message'])){


            if(!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['message'])){
              $nom=$_POST['nom'];
              $prenom=$_POST['prenom'];
              $email=$_POST['email'];
              $message=$_POST['message'];
              require_once("config/connexion.php");

              $result=$db->query("INSERT INTO messages(nom,prenom,email,message) VALUES('$nom','$prenom','$email','$message')");


              if($result){
                echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Message envoyé avec succes</div>';
              }else{
                echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Erreur: Message n'a pas ete envoyé</div>";

              }




            }else{

                echo "<script> alert('Veuillez renseigner toutes les informations necessaire');</script>";



            }





          }





        ?>










        <form id="ContactForm" method="POST" action="contacts.php">
          <div>
            <div class="wrapper">
              <input name="nom" type="text" class="input" >
              Nom:
            </div>
            <div class="wrapper">
              <input name="prenom" type="text" class="input" >
              Prenom:
            </div>
            <div class="wrapper">
              <input name="email" type="email" class="input" >
              E-mail:
            </div>
            <div class="wrapper">
              <textarea name="message" cols="1" rows="1"></textarea>
              Message:
            </div>
            <button type="submit" class="button">Envoyer</button>
            <button type="reset"  class="button">annuler</button>
          </div>
        </form>
      </article>
    
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


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.uploadPreview.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>


<script type="text/javascript"> Cufon.now(); </script>
<!-- END PAGE SOURCE -->
</body>
</html>