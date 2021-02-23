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
                    <?php

                    if(isset($_POST['nom']) && isset($_POST['pays'])){
                        $nom=$_POST['nom'];
                        $pays=$_POST['pays'];
                        require_once("../config/connexion.php");

                        $nb=0;


                        foreach($db->query("select count(id) from ville where nom='$nom' and pays='$pays'") as $a){
                            foreach ($a as $x=>$y){

                            } $nb+=$y;
                        }


                        if($nb == 0){


                            if(count($_FILES) > 0){
                                if(is_uploaded_file($_FILES['imageVille']['tmp_name'])) {



                                    $imageName=addslashes($_FILES['imageVille']['name']);
                                    $imageData = addslashes(file_get_contents($_FILES['imageVille']['tmp_name'] ));
                                    $imageType= $_FILES['imageVille']['type'];

                                    if(substr($imageType,0,5) == "image"){
                                        $result=$db->query("INSERT INTO ville(nom,pays,nomImage,image,typeImg) VALUES('$nom','$pays','$imageName','$imageData','$imageType')");


                                        if($result){
                                            echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>ville ajouté avec success</div>';
                                        }else{
                                            echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>ville n'a pas ete ajoutee</div>";

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
                                    $result=$db->query("INSERT INTO ville(nom,pays,nomImage) VALUES('$nom','$pays','aucune')");
                                    if($result){
                                        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>ville ajouté avec success</div>';
                                    }else{
                                        echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>ville n'a pas ete ajoutee</div>";

                                    }
                                }



                            }else{
                                $result=$db->query("INSERT INTO ville(nom,pays,nomImage) VALUES('$nom','$pays','aucune')");
                                if($result){
                                    echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>ville ajouté avec success</div>';
                                }else{
                                    echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>ville n'a pas ete ajoutee</div>";

                                }
                            }

                        }else{
                            echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Ville existe deja</div>";


                        }





                    }
                    ?>
                    <form action="villes.php"><button type="submit" class="btn btn-success">Gestion Villes</button></form>

                    <div class="formulaire">

                        <h3>Ajouter une ville</h3>
                        <form method="POST" action="addVille.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" name="nom" placeholder="Nom :" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="text" name="pays" placeholder="Pays :" class="form-control">
                            </div>
                            <div id="image-preview">
                                <label for="image-upload" id="image-label">Choisir une image</label>
                                <input type="file" name="imageVille" id="image-upload" />
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


