<?php
/**
 * Created by PhpStorm.
 * User: User: Hiba
 * Date: 14/04/2020
 * Time: 11:20 AM
 */
session_start();
require('../config/auth.php');
if(Auth::isloggedAdmin()){

}else{

    header('location:../loginAdmin.php');

}

?>

<html>
<head>
<?php require_once('baliseHeadAdmin.php'); ?>

</head>

<body>






<?php
require_once('headerAdmin.php');
?>


<div class="container-fluid">
    <div class="row">
<!--hne include sidebar-->
<?php include_once('adminSideBar.php'); ?>

        <div class="col-sm-12 col-md-12 main" style="background-color: red">
            <!--Contenu de la page-->
            <div class="row">
               <div class="col-lg-8 col-sm-offset-3" >
                   <div class="formulaire">
                       <h3>Inscription</h3>
                       <form>
                           <div class="form-group">
                               <input type="text" placeholder="Nom :" class="form-control">
                           </div>
                           <div class="form-group">
                               <input type="text" placeholder="Email :" class="form-control">
                           </div>
                           <div class="form-group">
                               <input type="password" placeholder="Mot de passe :" class="form-control">
                           </div>
                           <div class="form-group">
                               <input type="text" placeholder="Adresse :" class="form-control">
                           </div>
                           <div class="form-group">
                               <input type="submit" value="S'inscrire" class="btn btn-md btn-primary">
                           </div>
                       </form>
                   </div>
               </div>
            </div>

        </div>
    </div>
</div>







<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>


</body>


</html>