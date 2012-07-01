<?php
$z = readdata("config");
$sitename="";$sitelink="";$sitedesc="";
if(isset($z["sitename"])){$sitename=$z["sitename"];}
if(isset($z["sitelink"])){$sitelink=$z["sitelink"];}
if(isset($z["sitedesc"])){$sitedesc=$z["sitedesc"];}
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['sitename']) && !empty($_POST['sitelink']) && !empty($_POST['token']) ){
            if(preg_match('|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(.[a-z])?$|i', $_POST['sitelink'])){
            if($_POST['token']==$_SESSION['Auth']['token']){
                $z["sitelink"] = $_POST['sitelink'];
                $z["sitename"] = $_POST['sitename'];
                $z["sitedesc"] = $_POST['sitedesc'];
                $sitename=$_POST['sitename'];
                $sitelink=$_POST['sitelink'];
                $sitedesc=$_POST['sitedesc'];
                savedata("config",$z);
                $_SESSION['message'] = "Le flux RSS viennent d'être configuré.";
            }else{$_SESSION['error'] = "Votre session n'est pas valide reconnectez vous.";}
            }else{$_SESSION['error'] = "Votre lien de site est invalide.";}
        }else{$_SESSION['error'] = "Veuillez remplir tous les champs pour configurer le flux RSS.";}
    }
}
?>

<h1>Configuration du flux RSS</h1>
<?php
if(!empty($sitelink)){
?>
<div class="spacer"></div>
Vous pouvez consulter votre flux RSS <a href="rss.php" target="_blank">ici</a>.
<?php
}
?>

<form action="" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/><br />
    <label for="sitename">Nom de votre site :</label><br /><div class="spacer"></div>
    <input type="text" name="sitename" value="<?php echo $sitename; ?>"/><br />
    <div class="spacer"></div>
    <label for="sitedesc">Description de votre site :</label><br /><div class="spacer"></div>
    <input type="text" name="sitedesc" value="<?php echo $sitedesc; ?>"/><br />
    <div class="spacer"></div>
    <label for="sitelink">Lien de votre site (Ex: http://www.votresite.fr):</label><br /><div class="spacer"></div>
    <input type="text" name="sitelink" value="<?php echo $sitelink; ?>"/><br />
    <div class="spacer"></div>
    <div class="spacer"></div>
    <input type="submit" value="Configurer le flux RSS"/>
</form>