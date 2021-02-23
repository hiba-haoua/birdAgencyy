

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

    <link href="../css/footable.core.css" rel="stylesheet">


    <style type="text/css">
        #image-preview {
            width: 400px;
            height: 400px;
            position: relative;
            overflow: hidden;
            background: #ffffff;
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



                    <h1>Gestion d'hotels</h1>

                    <form action="addHotel.php"><button type="submit" class="btn btn-success">Ajouter Hotel</button></form>

                    <?php

                    if(isset($_POST['action']) && isset($_POST['idToDel'])){
                        if( $_POST['action'] =="delete" ){


                            require_once("../config/connexion.php");

                            $idHotelDel=$_POST['idToDel'];

                            $result=$db->query("DELETE FROM hotel WHERE id='$idHotelDel'");



                            if($result){
                                echo "<div class='alert alert-success' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Hotel Supprime avec Succees !</div>";

                            }else{

                                echo "<div class='alert alert-danger' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Hotel n a pas ete supprimé !</div>";

                            }


                        }



                    }


                    ?>




                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="Chercher un hotel">



                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Etoiles</th>
                            <th>Pention</th>
                            <th>Ville</th>
                            <th data-hide="phone">Photo</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once("../config/connexion.php");



                        /*
                        $sql = "SELECT hotel.id as idHotel, hotel.nom  as nomHotel,hotel.nbrEtoiles as nbrEtoiles, hotel.pention as pentionHotel,
                        hotel.prix as prixHotel , hotel.idVille as idVilleHotel,hotel.nomImage as nomImage, hotel.image as image,hotel.typeImage as typeImage,
                        ville.id as idVille , ville.nom as nomVille, ville.pays as paysVille
                         FROM hotel,ville where idVille=idVilleHotel ";
                        */

                        $sql="select hotel.id as idHotel, hotel.nom  as nomHotel,hotel.nbrEtoiles as nbrEtoiles,hotel.pention as pentionHotel,
                        hotel.prix as prixHotel , hotel.idVille as idVilleHotels,hotel.nomImage as nomImage,hotel.typeImg, hotel.image as image ,ville.id as idVille,ville.nom as nomVille,
                         ville.pays as paysVille from hotel,ville where ville.id = hotel.idVille";
                        $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                        foreach($result as $v){
                            $tmpId=$v['idHotel'];

                            echo '<tr class="gradeX">';

                            echo "<td class='center'>".$v['nomHotel']."</td>";
                            echo "<td class='center'>".$v['prixHotel']."</td>";
                            echo "<td class='center'>";
                                for($i=0;$i<$v['nbrEtoiles'];$i++){
                                    echo '<span style="color:orange;font-size: 15px" class="glyphicon glyphicon-star"> </span> ';
                                }
                            echo "</td>";
                            echo "<td class='center'>".$v['pentionHotel']."</td>";
                            echo "<td class='center'>".$v['nomVille'].', '. $v['paysVille'] ."</td>";
                            echo "<td class='center'>";
                            if($v['typeImg'] == ""){
                                echo '<div class="img-responsive"><img src="../images/aucuneVille.gif" style="height: 200px!important;width: 200px!important;"></div>';
                            }else{
                                echo '<div class="img-responsive"><img src="showImage.php?contexte_id='.$v['idHotel'].'&contexte=hotel" style="max-height: 250px!important;max-width: 250px!important;"></div>';
                            }

                            echo "</td>";

                            echo "<td><span class='glyphicon glyphicon-trash' data-toggle='modal' data-target='#delV".$v['idHotel']."'></span><br><br><span class='glyphicon glyphicon-pencil' data-toggle='modal' data-target='#editV".$tmpId."' ></span></td>";



                            echo "</tr>";
                            echo '<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="delV'.$tmpId.'" aria-labelledby="mySmallModalLabel">';
                            echo '
                                <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="mdlDelV'.$tmpId.'">Suppression de '.$v['nomHotel'].' de la base</h4>
                                    </div>';
                            echo '<div class="modal-body">Voulez vous vraiment supprimer l\' hotel '.$v['nomHotel'].' '.$v['nomVille'].','.$v['paysVille'].' de la base ? </div>';
                            echo '
                                    <div class="modal-footer">
                                        ';
                            echo '
                                <form method="POST" action="hotels.php">
                                <input type="hidden" value="delete" name="action">
                                <input type="hidden" value="'.$tmpId.'" name="idToDel">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                <button type="submit" class="btn btn-warning">Supprimer</button></form>
                                ';

                            echo '</div></div></div></div>';



                            /********MODAL EL EDIT*********/


                            echo '<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="editV'.$tmpId.'">';
                            echo '
                                <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="mdlDelV'.$tmpId.'">Modification de '.$v['nomHotel'].' de la base</h4>
                                    </div>';
                            echo '<div class="modal-body">'; ?>


                            <div class="formulaire">

                                <h3>Entrez les nouvelles valeurs</h3>
                                <form method="POST" action="villes.php" enctype="multipart/form-data">
                                    <input type="hidden" value="modification" name="actionM">
                                    <input type="hidden" value="<?php echo $tmpId; ?>" name="idM">
                                    <div class="form-group">
                                        <input type="text" name="nomModif" placeholder="Nom :" value="<?php echo $v['nomHotel']; ?>" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Ajouter" class="btn btn-md btn-primary">
                                    </div>
                                </form>
                            </div>

                            <?php
                            echo '</div></div></div></div>';

                        }

                        ?>



                        </tbody>


                        <tfoot>
                        <tr>
                            <td colspan="5">
                                <ul class="pagination pull-right"></ul>
                            </td>
                        </tr>
                        </tfoot>
                    </table>

                    <!-- Small modal -->










                </div>

            </div>

        </div>
    </div>
</div>










<script src=../js/jquery-1.12.4.min.js></script>
<script src=../js/bootstrap.min.js></script>
<script src=../js/SmoothScroll.js></script>

<script src="../js/jquery.metisMenu.js"></script>
<script src="../js/jquery.slimscroll.min.js"></script>

<!-- FooTable -->
<script src="../js/footable.all.min.js"></script>
<script type="text/javascript" src="../js/jquery.uploadPreview.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
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

<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Page-Level Scripts -->
<script>
    $(document).ready(function() {

        $('.footable').footable();
        $('.footable2').footable();

    });

</script>


</body>


</html>



