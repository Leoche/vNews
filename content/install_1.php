<h1>Installation des fichiers de configuration 1/3</h1>
<div class="spacer" ></div>
<table><?php
$is_ok = true;
echo "<tr>";
	echo '<td>Le dossier "content/" est-il accessible en écriture<td/>';
if(is_writable("content/")){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Le dossier "content/private/" est-il accessible en écriture<td/>';
if(is_writable("content/private")){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Création du fichier "config.vnews"<td/>';
if(savedata("config","")){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Création du Hashcode dans "config.vnews"<td/>';
	$r = readdata("config");
$r["hashcode"] = genKey('8');
if(savedata("config",$r)){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Création du Thème dans "config.vnews"<td/>';
$r["theme"] = "defaut";
if(savedata("config",$r)){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Création des variables de configuration dans "config.vnews"<td/>';
$r["news_par_page"] = "8";
$r["version"] = "0.5";
$r["date_format"] = "defaut";
if(savedata("config",$r)){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";


echo "<tr>";
	echo '<td>Création du Nom de dossier d\'installation dans "config.vnews"<td/>';
$dossier = explode("/", $_SERVER['REQUEST_URI']);
$r["folder"] = $dossier[count($dossier)-2];
if(savedata("config",$r)){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";


echo "<tr>";
	echo '<td>Création du fichier "dbuser.vnews"<td/>';
if(savedata("dbuser","")){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Création du fichier "dbpages.vnews"<td/>';
if(savedata("dbpages","")){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Création du fichier "dbnews.vnews"<td/>';
if(savedata("dbnews","")){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Création du fichier "dbnewscategories.vnews"<td/>';
if(savedata("dbnewscategories",'a:1:{i:0;a:2:{s:5:"titre";s:10:"Inclassés";s:4:"slug";s:9:"inclasses";}}',false)){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

echo "<tr>";
	echo '<td>Création du fichier "dbcoms.vnews"<td/>';
if(savedata("dbcoms","")){
	echo '<td><img src="css/images/valid.png"/></td>';
}else{$is_ok = false;echo '<td><img src="css/images/delete.png"/></td>';}
echo "</tr>";

?>
</table>
<?php if($is_ok){ ?>
<div class="spacer"></div>
<a class="bouttona" href="index.php?page=install_2">Continuer</a>
<?php } ?>