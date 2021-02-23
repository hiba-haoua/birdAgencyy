<html>
<head>

</head>

<body>

<?php

if(isset($_GET['non'])){
    echo "ncin ou password incorrectes";


}

if(isset($_GET['Inscription'])){

    if($_GET['Inscription'] == true){

        echo '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>Inscription Effectué avec succes<br>Veuillez se connecter</div>';

    }

}


if(isset($_POST['ncin']) && isset($_POST['password'])){

    require_once("config/connexion.php");


    $ncin=$_POST['ncin'];
    $pass=$_POST['password'];
    $req="select * from client where ncin='$ncin'and password='$pass'";

    foreach ($db->query($req) as $row) {
        # code...
    }


    if(empty($row[1]))
    {

        header('location:loginclient.php?non=true');


    }
    else
    {
        session_start();
        unset($_SESSION['authClient']);
        unset($_SESSION['auth']);


        $_SESSION['authClient']= $ss = array('nom' =>$row[1] ,'prenom' =>$row[2],'pass'=>$row[3] );

        header('location:index.php');


        /*$_SESSION['auth']= $ss = array('login' =>$row[0] ,'pass' =>$row[1] );
        header('location:admin.php');*/
    }


}else {

    ?>


    <form action="loginclient.php" method="POST">

        <table>
            <tr>
                <td><label>Ncin</label></td>
                <td><input type="text" name="ncin" placeholder="ncin"></td>
            </tr>
            <tr>
                <td><label>Password</label></td>
                <td><input type="password" name="password" placeholder="password"></td>
            </tr>
            <tr>
                <td><input type="submit" value="connexion"></td>
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