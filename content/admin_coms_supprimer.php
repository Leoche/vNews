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
    deleteidfromdata("dbcoms",$_GET['id']);
    header("Location:index.php?page=admin_news_liste");
}

?>