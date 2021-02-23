

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

                        <h1>Ajouter un voyage organisé</h1>
                        <form action="voyagesOrganise.php"><button type="submit" class="btn btn-success">Gestion de voyages organisés</button></form>









                        <?php

                        if(isset($_POST['nom']) && isset($_POST['desc']) && isset($_POST['hotel']) && isset($_POST['vol']) ){


                            if(!empty($_POST['nom']) && !empty($_POST['desc']) && !empty($_POST['hotel']) && !empty($_POST['vol']) ){


                                $nom=$_POST['nom'];
                                $desc=$_POST['desc'];

                                $hotel=$_POST['hotel'];
                                $vol=$_POST['vol'];

                                    require_once("../config/connexion.php");
                                    $result=$db->query("INSERT INTO  voyages (nom,description,id_hotel,id_vol) VALUES('$nom','$desc','$hotel','$vol')");


                                    if($result){
                                        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Voyage ajouté avec success</div>';
                                    }else{
                                        echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Voyage n'a pas ete ajoutee</div>";

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

























                        <form method="POST" action="addVoyage.php" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nmH">Nom:</label>

                                <input id="nom" type="text" name="nom" placeholder="Nom:" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="nmH">Description:</label>

                                <textarea placeholder="Description" class="form-control" name="desc" id="desc"></textarea>
                            </div>



                            <div class="form-group">
                                <label for="vH">Hotel</label>
                                <select id="hotel" class="form-control" name="hotel">
                                    <?php

                                    require_once("../config/connexion.php");

                                    $sql = "SELECT * FROM hotel ";
                                    $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                                    foreach($result as $v){
                                        echo "<option value='".$v['id']."'>".$v['nom'] ."</option>";

                                    }


                                    ?>




                                </select>
                            </div>

                            <div class="form-group">
                                <label for="dispo">Vol :</label>


                                <select id="vol" class="form-control" name="vol">
                                    <?php

                                    require_once("../config/connexion.php");

                                    $sql = "SELECT ville.nom as Nom,ville.pays as Pays,vol.id as idVol,vol.id_ville,vol.nbrBilleDispo as dispo FROM vol,ville where ville.id = vol.id_ville ";
                                    $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
                                    foreach($result as $v){
                                        echo "<option value='".$v['idVol']."'>".

                                            $v['Nom'].", ".$v['Pays'] ." reste: ".$v['dispo']

                                            ."</option>";

                                    }


                                    ?>




                                </select>

                            </div>


                            <div class="form-group">
                                <input type="submit" value="Ajouter" class="btn btn-md btn-success">
                            </div>
                        </form>

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


