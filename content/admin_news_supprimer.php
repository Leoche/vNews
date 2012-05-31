<?php
if(!isset($_GET)){
    header("Location:index.php?page=admin_news_liste");
}
elseif(empty($_GET['id']) && empty($_GET['token'])){
    header("Location:index.php?page=admin_news_liste");
}
else{
    if($_SESSION['Auth']['rang']==2){
	$news = readdata("dbnews",true,$_GET['id']);
	if($news['auteur']!=$_SESSION['Auth']['pseudo']){
    	header("Location:index.php?page=admin_news_liste");
    }}
    if($_GET['token'] != $_SESSION['Auth']['token']){header("Location:index.php?page=admin_news_liste");}
    deleteidfromdata("dbnews",$_GET['id']);
    deletealldatawithdata("dbcoms","news_id",$_GET['id']);
    header("Location:index.php?page=admin_news_liste");
}

?>