<?php


if(isset($_GET['contexte_id']) && isset($_GET['contexte'])) {
    $id=$_GET['contexte_id'];
    $contexte=$_GET['contexte'];
    //na7i el cnx pq deja ma7loula
    require_once("../config/connexion.php");

    $sql = "SELECT image,typeImg FROM ".$contexte." WHERE id=".$id;
    $result = $db->query($sql) or die("<b>Error:</b> Problem on Retrieving Image BLOB<br/>" . mysql_error());
    $image="";
    foreach($result as $im){
        $image=$im['image'];
        $type=$im['typeImg'];
    }

    header("Content-type: " . $type);

    echo $image;
}


?>