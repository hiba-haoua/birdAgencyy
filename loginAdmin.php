<html>
<head>

</head>

<body>

<?php

    if(isset($_GET['non'])){
        echo "login ou password incorrectes";


    }


    if(isset($_POST['login']) && isset($_POST['password'])){

        require_once("config/connexion.php");


        $login=$_POST['login'];
        $pass=$_POST['password'];
        $req="select * from user where login='$login'and password='$pass'";

        foreach ($db->query($req) as $row) {
            # code...
        }


        if(empty($row[1]))
        {

            header('location:loginAdmin.php?non=true');


        }
        else
        {
            session_start();

            unset($_SESSION['authClient']);
            unset($_SESSION['auth']);


            $_SESSION['auth']= $ss = array('login' =>$row[1] ,'pass' =>$row[2],'role'=>$row[3] );
            if($row[3]=="admin"){
                header('location:admin/administration.php');
            }else{
                header('location:index.php');
            }


            /*$_SESSION['auth']= $ss = array('login' =>$row[0] ,'pass' =>$row[1] );
            header('location:admin.php');*/
        }


    }else {

        ?>


        <form action="loginAdmin.php" method="POST">

            <table>
                <tr>
                    <td><label>Login</label></td>
                    <td><input type="text" name="login" placeholder="Login"></td>
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