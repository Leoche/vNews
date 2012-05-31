<?php
$z = readdata("config");
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
            	if(isset($_POST['newtheme'])){
	            	if($_POST['newtheme']!="null"){
	            		$name = slug($_POST['newtheme']);
	            		if(is_dir("themes/".$name)){
	                		$error = "Ce thème existe déjà, veuillez choisir un autre nom pour votre nouveau thème.";
	            		}
	            		else{
	            		mkdir("themes/".$name);
	            		fopen("themes/".$name."/news.html","w");
	            		fopen("themes/".$name."/commentaires.html","w");
	            		fopen("themes/".$name."/page.html","w");
	            		fopen("themes/".$name."/single.html","w");
	                	$message = "Le thème $name vient d'être créer.";
	            		}
	            	}
	            }
            	if(isset($_POST['suptheme'])){
	            	if($_POST['suptheme']!="null"){
	            		$name = slug($_POST['suptheme']);
	            		if(is_dir("themes/".$name) && $name=="defaut"){
	                		$error = "Ce thème n'existe pas.";
	            		}
	            		else{
	            		if(file_exists("themes/".$name."/news.html")){unlink("themes/".$name."/news.html");}
	            		if(file_exists("themes/".$name."/commentaires.html")){unlink("themes/".$name."/commentaires.html");}
	            		if(file_exists("themes/".$name."/page.html")){unlink("themes/".$name."/page.html");}
	            		if(file_exists("themes/".$name."/single.html")){unlink("themes/".$name."/single.html");}
	            		if(is_dir("themes/".$name)){rmdir("themes/".$name);}
	                	$message = "Le thème $name vient d'être effacé. ";
		                	if($name==$z['theme']){
		                		savedata("config",$z);
	                			$message .= "Le thème actuel est maintenant defaut";
		                	}
	            		}
	            	}
	            }
            	if(isset($_POST['validtheme'])){
	            	if($_POST['validtheme']!="null"){
		                $z["theme"] = $_POST['validtheme'];
		                savedata("config",$z);
		                $message = "Le thème vient d'être changé.";
	            	}
	            }
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour éditer un article.";}
    }
}
?>
<h1>Gerer les Themes</h1>

<div class="spacer"></div>
<a class="bouttona" onclick="javascript:var e = prompt('Nom du nouveau theme :');if(e){$('input[name=newtheme]').val(e);$('#changetheme').submit()}">Créer un nouveau thème</a><br/>
<div class="spacer"></div>


<form action="" method="post" id="changetheme">
<input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/>
<input type="hidden" name="newtheme" value="null"/>
<input type="hidden" name="suptheme" value="null"/>
<input type="hidden" name="validtheme" value="null"/>
</form>
		<?php
		$files = array();
		if($dossier = opendir('themes/'))
		{
			while(false !== ($fichier = readdir($dossier)))
			{
				if($fichier != '.' && $fichier != '..'){
					$files[] = $fichier;
				}
			}
		}
		?>
		<?php
		foreach($files as $r){
			$del = '<a href="javascript:$(\'input[name=suptheme]\').val(\''.$r.'\');$(\'#changetheme\').submit();" class="delete"></a>';
			$edi = '<a href="index.php?page=admin_themes_editer&theme='.$r.'" class="edit"></a>';
			if($r == "defaut"){$del = "";$edi = "";}
			if($r == $z['theme']){
			echo '<div class="boutton-block">
				      <div class="boutton valide" id="theme">
				       <div class="icon-action">'.$edi.$del.'</div>
				      </div>
				      <span>'.$r.'</span>
				  </div>';
				}
			else{
			echo '<div class="boutton-block">
				      <div class="boutton" id="theme">
				       <div class="icon-action"><a href="javascript:$(\'input[name=validtheme]\').val(\''.$r.'\');$(\'#changetheme\').submit();" class="valid"></a>'.$edi.$del.'</div>
				      </div>
				      <span>'.$r.'</span>
				  </div>';
		}
		}
		?>
<div class="clear"></div>

