<?php


class Auth{
    static function isloggedAdmin(){
        if(isset($_SESSION['auth']) && isset($_SESSION['auth']['login']) && isset($_SESSION['auth']['pass']) && $_SESSION['auth']['role'] == "admin"){
            return true;
        }else{
            return false;
        }

    }


}



?>