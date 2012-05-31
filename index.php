<?php
session_start();
include "functions.php";
$version_for_layout = "";
$installed=true;
if(is_install()){
$version_for_layout = getVersion();
if(!isset($_GET['page']) || empty($_GET['page'])){
    if(is_connected()){
        $_GET['page']="admin_home";  
    }
    else{ $_GET['page']="home";  }
}
if(!file_exists("content/".htmlspecialchars($_GET['page']).".php")){ $_GET['page']="404"; }
if(substr($_GET['page'],0,5)=="admin"){
		if(substr($_GET['page'],0,10)=="admin_news" || substr($_GET['page'],0,10)=="admin_home"){
		    if(!is_connected() && !is_connected(2)){
		        $error = "Vous n'avez pas acces ? cette page, veuillez vous connecter.";
		        header("Location:index.php?page=home");
		    }
		}
		else{
		    if(!is_connected()){
		        if(is_connected(2)){header("Location:index.php?page=admin_home");}
		        else{header("Location:index.php?page=home");}
			}
		}
}
}
else{
	$installed=false;
	if(!isset($_GET['page']) || empty($_GET['page'])){
    $_GET['page']="install";
	}
	else{
		if(substr($_GET['page'],0,7)!="install"){
			$_GET['page']="install";
		}
	}
}
if(is_connected() && !is_connected(2)){
if(verifVersion()!=1){$message = verifVersion();}
}
 ob_start();
 $filetoinclude = "content/".$_GET['page'].".php";
 if(file_exists($filetoinclude)){
include $filetoinclude;
}
else{ $error="Votre installation manque de fichier, vNews n'arrive pas à trouver le fichier ".$_GET['page'].".php";}
$content_for_layout = ob_get_contents();
ob_end_clean();
include "template.php";
?>