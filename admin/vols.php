
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


                    <h1>Gestion de vols</h1>
                    <form action="addVol.php"><button type="submit" class="btn btn-success">Ajouter Vols</button></form>



                    <?php

                    if(isset($_POST['action']) && isset($_POST['idToDel'])){
                        if( $_POST['action'] =="delete" ){


                            require_once("../config/connexion.php");

                            $idVolDel=$_POST['idToDel'];

                            $result=$db->query("DELETE FROM vol WHERE id='$idVolDel'");



                            if($result){
                                echo "<div class='alert alert-success' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Vol Supprime avec Succees !</div>";

                            }else{

                                echo "<div class='alert alert-danger' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Vol n a pas ete supprimé !</div>";

                            }


                        }



                    }







                    if(isset($_POST['actionM']) && isset($_POST['dateDepart']) && isset($_POST['dateRetour']) && isset($_POST['dispo']) && isset($_POST['prixH']) && isset($_POST['villeH']) && isset($_POST['idM'])){
                        if( $_POST['actionM'] =="modification" ){


                            $idv=$_POST['idM'];


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
                                    $sql="UPDATE vol set date_depart='$dateDepart',date_retour='$dateRetour',nbrBilleDispo='$dispo',prix='$prix',id_ville='$ville' where id='$idv'";

                                    //echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$sql.'</div>';

                                    $result=$db->query($sql);


                                    if($result){
                                        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Vol modifié avec success</div>';
                                    }else{
                                        echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Vol n'a pas ete modifié</div>";

                                    }

                                }



                            }else{
                                echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Veuillez entrez tous les champs SVP</div>";

                            }





                        }



                    }





                    ?>




                    <input type="text" class="form-control input-sm m-b-xs" id="filter"
                           placeholder="Chercher un vol">



                    <table class="footable table table-stripped" data-page-size="8" data-filter=#filter>
                        <thead>
                        <tr>
                            <th>date Depart</th>
                            <th>date Retour</th>
                            <th>Disponible</th>
                            <th>Prix</th>
                            <th>Ville</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        require_once("../config/connexion.php");



                        $sql="select vol.id as idVol, vol.date_depart  as dateDepart,vol.date_retour as dateRetour,vol.prix as prix,
                        vol.nbrBilleDispo as dispo , vol.id_ville as idVilleVol,ville.id as idVille,ville.nom as nomVille,
                         ville.pays as paysVille from vol,ville where ville.id = vol.id_ville";
                        $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                        foreach($result as $v){
                            $tmpId=$v['idVol'];

                            echo '<tr class="gradeX">';

                            echo "<td class='center'>".$v['dateDepart']."</td>";
                            echo "<td class='center'>".$v['dateRetour']."</td>";
                            echo "<td class='center'>".$v['dispo']."</td>";
                            echo "<td class='center'>".$v['prix']."</td>";
                            echo "<td class='center'>".$v['nomVille'].', '. $v['paysVille'] ."</td>";


                            echo "<td><span class='glyphicon glyphicon-trash' data-toggle='modal' data-target='#delV".$v['idVol']."'></span><br><br><span class='glyphicon glyphicon-pencil' data-toggle='modal' data-target='#editV".$tmpId."' ></span></td>";

                            echo "</tr>";
                            echo '<div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" id="delV'.$tmpId.'" aria-labelledby="mySmallModalLabel">';
                            echo '
                                <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="mdlDelV'.$tmpId.'">Suppression du vol vers '.$v['nomVille'].', '. $v['paysVille'].' du '.$v['dateDepart'].' de la base</h4>
                                    </div>';
                            echo '<div class="modal-body">Voulez vous vraiment supprimer le vol vers '.$v['nomVille'].', '. $v['paysVille'].' du '.$v['dateDepart'].' de la base ? </div>';
                            echo '
                                    <div class="modal-footer">
                                        ';
                            echo '
                                <form method="POST" action="vols.php">
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
                                        <h4 class="modal-title" id="mdlDelV'.$tmpId.'">Modification du vol vers '.$v['nomVille'].', '. $v['paysVille'].' du '.$v['dateDepart'].' de la base</h4>
                                    </div>';
                            echo '<div class="modal-body">'; ?>


                            <div class="formulaire">

                                <h3>Entrez les nouvelles valeurs</h3>
                                <form method="POST" action="vols.php" enctype="multipart/form-data">
                                    <input type="hidden" value="modification" name="actionM">
                                    <input type="hidden" value="<?php echo $tmpId; ?>" name="idM">
                                    <div class="form-group">
                                        <label for="nmH">Date Depart</label>

                                        <input id="dateDepart" type="date" name="dateDepart" placeholder="date Depart" value="<?php echo $v['dateDepart'] ; ?>" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="nmH">Date Retour</label>

                                        <input id="dateRetour" type="date" name="dateRetour" placeholder="date Retour"  value="<?php echo $v['dateRetour'] ; ?>" class="form-control">
                                    </div>



                                    <div class="form-group">
                                        <label for="vH">Ville</label>
                                        <select id="vH" class="form-control" name="villeH">
                                            <?php

                                            require_once("../config/connexion.php");

                                            $sql = "SELECT * FROM ville ";
                                            $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                                            foreach($result as $c){
                                                if($v['idVilleVol']==$c['id']){
                                                    echo "<option selected value='".$c['id']."'>".$c['nom'] . ',' . $c['pays']." </option>";

                                                }else{
                                                    echo "<option value='".$c['id']."'>".$c['nom'] . ',' . $c['pays']." </option>";

                                                }



                                            }


                                            ?>




                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="pH">Prix Vol</label>

                                        <input id="pH" type="number" value="<?php echo $v['prix']; ?>" placeholder="Prix" name="prixH" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label for="dispo">Nombre Bille disponibles</label>
                                        <input type="number" placeholder="Disponible" value="<?php echo $v['dispo']; ?>" name="dispo" id="dispo" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" value="Modifier" class="btn btn-md btn-primary">
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



