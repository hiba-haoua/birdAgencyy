<html>
<head>

</head>

<body>

<?php

if(isset($_GET['non'])){
    echo "ncin ou password incorrectes";


}


if(isset($_POST['ncin']) && isset($_POST['password']) && isset($_POST['nom']) && isset($_POST['prenom'])) {

    if (!empty($_POST['ncin']) && !empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['password'])){


    require_once("config/connexion.php");


    $ncin=$_POST['ncin'];
    $pass=$_POST['password'];
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];



            $nb=0;


            foreach( $db->query(" select count(ncin) from client where ncin='$ncin'") as $a){
                foreach ($a as $x=>$y){

                } $nb+=$y;
            }


            if($nb == 0){

                $result=$db->query("INSERT INTO client(ncin,nom,prenom,password) VALUES('$ncin','$nom','$prenom','$pass')");


                                        if($result){
                                            header('location:loginclient.php?Inscription=true');

                                            echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Inscription Effectué avec succes</div>';
                                        }else{
                                            echo "<div class='alert alert-warning' role='alert'><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button>Erreur d'inscription</div>";

                                        }







            }else{
                        header('location:inscription.php?existeDeja=true');

                //mawjoud b meme ncin message existe deja
            }

    }else{
                        header('location:inscription.php?incomplet=true');
    }


}else {

?>


<?php
    if(isset($_GET['existeDeja'])){
        if($_GET['existeDeja'] == true){
           echo "Utilisateur existe deja avec cet NCIN";
        }


    }

    if(isset($_GET['incomplet'])){
        if($_GET['incomplet'] == true){
           echo "Veuillez entrer vos coordonnées";
        }


    }


?>



<form action="inscription.php" method="POST">

<table>
<tr>
<td><label>Ncin</label></td>
<td><input type="text" name="ncin" placeholder="ncin"></td>
</tr>
<tr>
<td><label>Nom</label></td>
<td><input type="text" name="nom" placeholder="nom"></td>
</tr>
<tr>
<td><label>Prenom</label></td>
<td><input type="text" name="prenom" placeholder="prenom"></td>
</tr>
<tr>
<td><label>Password</label></td>
<td><input type="password" name="password" placeholder="password"></td>
</tr>
<tr>
<td><input type="submit" value="Inscription"></td>
</form>
<td><input type="button" value="Annuler" onclick="versAcceuil()"></td>
</tr>
</table>




<?php

}

?>


</body>
<script>

    function versAcceuil(){
        window.location="index.php";
    }


</script>

</html>