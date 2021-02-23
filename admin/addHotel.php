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

                    <h1>Ajouter un hotel</h1>
                    <form action="hotels.php"><button type="submit" class="btn btn-success">Gestion d'hotels</button></form>



                    <!---------------------------------------->







                    <?php

                    if(isset($_POST['nomHotel']) && isset($_POST['nbrEtoile']) && isset($_POST['pention']) && isset($_POST['prixH']) && isset($_POST['villeH']) ){


                        $nom=$_POST['nomHotel'];


                        $nbrEtoile=$_POST['nbrEtoile'];
                        $pention=$_POST['pention'];
                        $prix=$_POST['prixH'];
                        $ville=$_POST['villeH'];
                        require_once("../config/connexion.php");

                        $nb=0;


                        foreach($db->query("select count(id) from hotel where nom='$nom' and idVille='$ville'") as $a){
                            foreach ($a as $x=>$y){

                            } $nb+=$y;
                        }


                        if($nb == 0){
                            //ajout



                            if(count($_FILES) > 0){
                                if(is_uploaded_file($_FILES['imageHotel']['tmp_name'])) {



                                    $imageName=addslashes($_FILES['imageHotel']['name']);
                                    $imageData = addslashes(file_get_contents($_FILES['imageHotel']['tmp_name'] ));
                                    $imageType= $_FILES['imageHotel']['type'];

                                    if(substr($imageType,0,5) == "image"){
                                        $result=$db->query("INSERT INTO hotel(nom,nbrEtoiles,prix,pention,idVille,nomImage,image,typeImg) VALUES('$nom','$nbrEtoile','$prix','$pention','$ville','$imageName','$imageData','$imageType')");


                                        if($result){
                                            echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Hotel ajouté avec success</div>';
                                        }else{
                                            echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Hotel n'a pas ete ajoutee</div>";

                                        }

                                    }else{
                                        echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Vous pouvez ajouter que des images</div>";

                                    }

                                    /*$sql = "INSERT INTO ville(nom,ville,imageType ,imageData)
                                    VALUES('{$imageProperties['mime']}', '{$imgData}')";
                                    $current_id = mysql_query($sql) or die("<b>Error:</b> Problem on Image Insert<br/>" . mysql_error());
                                    if(isset($current_id)) {
                                        header("Location: listImages.php");
                                    }*/


                                }else{
                                    $result=$db->query("INSERT INTO hotel(nom,nbrEtoiles,prix,pention,idVille,nomImage) VALUES('$nom','$nbrEtoile','$prix','$pention','$ville','aucune')");
                                    if($result){
                                        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Hotel ajouté avec success</div>';
                                    }else{
                                        echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Hotel n'a pas ete ajoutee</div>";

                                    }
                                }





                            }else{

                                $result=$db->query("INSERT INTO hotel(nom,nbrEtoiles,prix,pention,idVille,nomImage) VALUES('$nom','$nbrEtoile','$prix','$pention','$ville','aucune')");
                                if($result){
                                    echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Hotel ajouté avec success</div>';
                                }else{
                                    echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Hotel n'a pas ete ajoutee</div>";

                                }


                            }










                        }else{
                            //msg erreur existe deja
                            echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Hotel existe deja dans cette ville</div>";


                        }



                        //echo "<script> alert('". $nb . "')</script>";



                    }

                    ?>












                    <!---------------------------------------->












                    <div class="formulaire">

                        <h3>Ajout d'un hotel </h3>
                        <form method="POST" action="addHotel.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nmH">Nom d'hotel</label>

                                <input id="nmH" type="text" name="nomHotel" placeholder="Nom :" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="etH">Nombre des Etoiles</label>
                                <select id="etH" name="nbrEtoile" class="form-control">
                                    <option value="1">* </option>
                                    <option value="2">* *</option>
                                    <option value="3">* * *</option>
                                    <option value="4">* * * *</option>
                                    <option value="5">* * * * *</option>
                                </select>
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
                                <label for="pH">Prix Par nuit</label>

                                <input id="pH" type="number" placeholder="Prix" name="prixH" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="pH">Pention</label>
                                <br>
                                <input type="radio" value="complete" name="pention" id="cmp" checked> <label for="cmp"> Complete </label>
                                <br>
                                <input type="radio" value="demi" name="pention" id="dmi"> <label for="dmi"> Demi pention </label>
                            </div>


                            <div id="image-preview">
                                <label for="image-upload" id="image-label">Choisir une <span style="color:black!important;">image</span></label>
                                <input type="file" name="imageHotel" id="image-upload" />
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
