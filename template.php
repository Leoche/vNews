<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <title>vNews</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/markitup/jquery.markitup.js"></script>
    <script type="text/javascript" src="js/markitup/sets/bbcode/set.js"></script>
    <link rel="stylesheet" type="text/css" href="js/markitup/skins/simple/style.css" />
	<link rel="stylesheet" type="text/css" href="js/markitup/sets/bbcode/style.css" />
	<script type="text/javascript" >$(document).ready(function() {$(".errorflash,.messageflash").hide().slideDown().delay(3000).slideUp();$(".markItUp").markItUp(mySettings);});</script>
</head>
<body>
<div class="light"></div>
<div id="main">
<div id="logo"></div>
<?php
if($installed && $_GET['page']!="login"){
?>
<?php if(is_connected()){ ?>
<div id="menu">
	<ul>
		<li><a href="index.php<?php if(is_connected() || is_connected(2)){echo "?page=admin_home";} ?>" >Accueil</a></li>
		<?php if(is_auth("admin_news_liste")){ ?><li><a href="index.php?page=admin_news_liste" >News</a></li><?php } ?>
		<?php if(is_auth("admin_pages_liste")){ ?><li><a href="index.php?page=admin_pages_liste" >Pages</a></li><?php } ?>
		<?php if(is_auth("admin_users_liste")){ ?><li><a href="index.php?page=admin_users_liste" >Utilisateurs</a></li><?php } ?>
		<?php if(is_auth("admin_options")){ ?><li><a href="index.php?page=admin_options" >Options</a></li><?php } ?>
		<?php if(is_auth("admin_propos")){ ?><li><a href="index.php?page=admin_propos" >À propos</a></li><?php } ?>
		<li><a href="index.php?page=deconnexion" >Déconnexion</a></li>
	</ul>
</div>
<?php } ?>
<?php } ?>
<div class="clear" style="height:5px;width:100%;"></div>
<div id="block-h"></div>
<div id="block-m">
<?php 
if(isset($_SESSION["error"])){echo '<span class="errorflash">'.$_SESSION["error"].'</span>';unset($_SESSION['error']);} ?>
<?php if(isset($_SESSION["message"])){echo '<span class="messageflash">'.$_SESSION["message"].'</span>';unset($_SESSION['message']);};?>
<?php echo $content_for_layout;?>
</div>
<div id="block-b"></div>
<center>vNews <?php echo $version_for_layout; ?>
</center>
</div>
</body>
</html>
