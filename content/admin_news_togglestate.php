<?php
if(!isset($_GET)){
    header("Location:index.php?page=admin_news_liste");
}
elseif(empty($_GET['id']) && empty($_GET['token'])){
    header("Location:index.php?page=admin_news_liste");
}
else{
	$news = readdata("dbnews",true,$_GET['id'],null,null,false,null,1,10000000000,10000000000,true);
	$news = $news[0];
    if($_SESSION['Auth']['rang']==2){
	if($news['auteur']!=$_SESSION['Auth']['pseudo']){
    	header("Location:index.php?page=admin_news_liste");
    }}
    if($_GET['token'] != $_SESSION['Auth']['token']){header("Location:index.php?page=admin_news_liste");}
    if(!isset($news['online']) || $news['online']==1)
    	$news['online'] = 0;
    else
    	$news['online'] = 1;
    replacedatawithdatafromid("dbnews",$news,$_GET['id'],true);
    header("Location:index.php?page=admin_news_liste");
}

?>