<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">

<head>
    <title>vNews</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/mobile.css" />
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/markitup/jquery.markitup.js"></script>
    <script type="text/javascript" src="js/markitup/sets/bbcode/set.js"></script>
    <link rel="stylesheet" type="text/css" href="js/markitup/skins/simple/style.css" />
	<link rel="stylesheet" type="text/css" href="js/markitup/sets/bbcode/style.css" />
	<script type="text/javascript" >$(document).ready(function() {$(".markItUp").markItUp(mySettings);});</script>
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
	<meta name="apple-touch-fullscreen" content="YES" />
	<link href="css/apple-touch-icon.png" rel="apple-touch-icon" /> 
	<link rel="apple-touch-icon-precomposed" href="css/apple-touch-icon.png"/> 
	<meta name="apple-mobile-web-app-status-bar-style" content="black" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<link rel="apple-touch-startup-image" href="css/apple-touch-startup.png" />
</head>
<body>
	<script type="text/javascript">window.scrollTo(0, 1);</script>
<div class="light"></div>
<div id="main">
	<div id="logo"></div>
	<?php
	if($installed && $_GET['page']!="login"){
	?>
	<?php if(is_connected() || is_connected(2)){ ?>
	<div id="menu">
		<ul>
			<li><a href="index.php<?php if(is_connected() || is_connected(2)){echo "?page=admin_home";} ?>" >Accueil</a></li>
			<li><a href="index.php?page=admin_news_liste" >News</a></li>
			<?php if(is_connected()){ ?>
			<li><a href="index.php?page=admin_pages_liste" >Pages</a></li>
			<li><a href="index.php?page=admin_users_liste" >Utilisateurs</a></li>
			<li><a href="index.php?page=admin_options" >Options</a></li>
			<?php } ?>
			<li><a href="index.php?page=admin_propos" >À propos</a></li>
			<li><a href="index.php?page=deconnexion" >Déconnexion</a></li>
		</ul>
	</div>
	<?php } ?>
	<?php } ?>
	<div class="clear" style="height:5px;width:100%;"></div>
	<div id="block-m">
	<?php if(!empty($error)){echo '<span class="errorflash">'.$error.'</span>';} ?>
	<?php if(!empty($message)){echo '<span class="messageflash">'.$message.'</span>';} ?>
	<?php echo $content_for_layout; ?>
	</div>
	<center>vNews <?php echo $version_for_layout; ?></center>
</div>
</body>
</html>
