<?php
session_start();
include "variables.php";
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
	if(!is_auth($_GET['page'])){
		$_SESSION["error"] = "Vous n'avez pas accès à cette page.";
	    if(is_connected()){header("Location:index.php?page=admin_home");die();}
	    else{header("Location:index.php?page=home");die();}
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
if(is_auth("admin_verifVersion")){
if(verifVersion()!=1){$_SESSION["message"] = verifVersion();}
}
 ob_start();
 $filetoinclude = "content/".$_GET['page'].".php";
 if(file_exists($filetoinclude)){
include $filetoinclude;
}
else{ $_SESSION['error']="Votre installation manque de fichier, vNews n'arrive pas à trouver le fichier ".$_GET['page'].".php";}
$content_for_layout = ob_get_contents();
ob_end_clean();
if(is_mobile()){include "mobile.php";}else{include "template.php";}
?>