
<?php
/**
 * Created by PhpStorm.
 * User: Hiba
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


    <style type="text/css">
        #image-preview {
            width: 400px;
            height: 400px;
            position: relative;
            overflow: hidden;
            background-color: #ffffff;
            color: #ecf0f1;
        }
        #image-preview input {
            line-height: 200px;
            font-size: 200px;
            position: absolute;
            opacity: 0;
            z-index: 10;
        }
        #image-preview label {
            position: absolute;
            z-index: 5;
            opacity: 0.8;
            cursor: pointer;
            background-color: #bdc3c7;
            width: 200px;
            height: 50px;
            font-size: 20px;
            line-height: 50px;
            text-transform: uppercase;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            text-align: center;
        }
    </style>

    <script type="text/javascript">
        $(document).ready(function() {
            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label"
            });
        });
    </script>


</head>

<body>






<?php
require_once('headerAdmin.php');
?>


<div class="container-fluid">
    <div class="row">
        <!--hne include sidebar-->
        <?php include_once('adminSideBar.php'); ?>

        <div class="col-sm-12 col-md-12 main">
            <!--Contenu de la page-->
            <div class="row">
                <div class="col-lg-8 col-sm-offset-3" >

                    <h1>Ajouter un vol</h1>
                    <form action="vols.php"><button type="submit" class="btn btn-success">Gestion de vols</button></form>



                    <!---------------------------------------->







                    <?php

                    if(isset($_POST['dateDepart']) && isset($_POST['dateRetour']) && isset($_POST['dispo']) && isset($_POST['prixH']) && isset($_POST['villeH']) ){


                        if(!empty($_POST['dateDepart']) && !empty($_POST['dateRetour']) && !empty($_POST['dispo']) && !empty($_POST['prixH']) && !empty($_POST['villeH']) ){


                            $dateDepart=$_POST['dateDepart'];
                            $dateRetour=$_POST['dateRetour'];

                            $dispo=$_POST['dispo'];
                            $prix=$_POST['prixH'];
                            $ville=$_POST['villeH'];


                            if(strtotime($dateDepart )> strtotime($dateRetour)){
                                echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Date retour peut pas préceder la date de depart</div>";

                            }else{
                                require_once("../config/connexion.php");
                                $result=$db->query("INSERT INTO vol(date_depart,date_retour,nbrBilleDispo,prix,id_ville) VALUES('$dateDepart','$dateRetour','$dispo','$prix','$ville')");


                                if($result){
                                    echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Vol ajouté avec success</div>';
                                }else{
                                    echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Vol n'a pas ete ajoutee</div>";

                                }

                            }



                        }else{
                            echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Veuillez entrez tous les champs SVP</div>";

                        }




                        /*
                        $nom=$_POST['nomHotel'];


                        $nbrEtoile=$_POST['nbrEtoile'];
                        $pention=$_POST['pention'];
                        $prix=$_POST['prixH'];
                        $ville=$_POST['villeH'];
                        require_once("../config/connexion.php");
                        */




                        //echo "<script> alert('". $nb . "')</script>";



                    }

                    ?>












                    <!---------------------------------------->












                    <div class="formulaire">

                        <h3>Ajout d'un vol </h3>
                        <form method="POST" action="addVol.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nmH">Date Depart</label>

                                <input id="dateDepart" type="date" name="dateDepart" placeholder="date Depart" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="nmH">Date Retour</label>

                                <input id="dateRetour" type="date" name="dateRetour" placeholder="date Retour" class="form-control">
                            </div>



                            <div class="form-group">
                                <label for="vH">Ville</label>
                                <select id="vH" class="form-control" name="villeH">
                                    <?php

                                    require_once("../config/connexion.php");

                                    $sql = "SELECT * FROM ville ";
                                    $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                                    foreach($result as $v){
                                        echo "<option value='".$v['id']."'>".$v['nom'] . ',' . $v['pays']." </option>";


                                    }


                                    ?>




                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pH">Prix Vol</label>

                                <input id="pH" type="number" placeholder="Prix" name="prixH" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="dispo">Nombre Bille disponibles</label>
                               <input type="number" placeholder="Disponible" name="dispo" id="dispo" class="form-control">
                            </div>


                            <div class="form-group">
                                <input type="submit" value="Ajouter" class="btn btn-md btn-primary">
                            </div>
                        </form>



                    </div>

                </div>

            </div>
        </div>
    </div>







    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.uploadPreview.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.uploadPreview({
                input_field: "#image-upload",   // Default: .image-upload
                preview_box: "#image-preview",  // Default: .image-preview
                label_field: "#image-label",    // Default: .image-label
                label_default: "Choose File",   // Default: Choose File
                label_selected: "Change File",  // Default: Change File
                no_label: false                 // Default: false
            });
        });
    </script>

</body>


</html>






