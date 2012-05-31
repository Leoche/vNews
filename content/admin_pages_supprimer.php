<?php
if(!isset($_GET)){
    header("Location:index.php?page=admin_pages_liste");
}
elseif(empty($_GET['id']) && empty($_GET['token'])){
    header("Location:index.php?page=admin_pages_liste");
}
else{
    if($_SESSION['Auth']['rang']==2){
	$pages = readdata("dbpages",true,$_GET['id']);
	if($pages['auteur']!=$_SESSION['Auth']['pseudo']){
    	header("Location:index.php?page=admin_pages_liste");
    }}
    if($_GET['token'] != $_SESSION['Auth']['token']){header("Location:index.php?page=admin_pages_liste");}
    deleteidfromdata("dbpages",$_GET['id']);
    header("Location:index.php?page=admin_pages_liste");
}

?>