<?php
if(!isset($_GET)){
    header("Location:index.php?page=admin_news_liste");
}
elseif(empty($_GET['id']) && empty($_GET['token'])){
    header("Location:index.php?page=admin_news_liste");
}
else{
    if($_SESSION['Auth']['rang']==2){
    	header("Location:index.php?page=admin_news_liste");
    }
    if($_GET['token'] != $_SESSION['Auth']['token']){header("Location:index.php?page=admin_news_liste");}
    $_GET['id'] = substr($_GET["id"],0 , strlen($_GET["id"])-1);
    $ids = explode(";", $_GET["id"]);
    foreach($ids as $s){
    	deleteidfromdata("dbcoms",$s);
    }
    header("Location:index.php?page=admin_news_liste");
}

?>