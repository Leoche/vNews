<?php
if(!isset($_GET)){header("Location:index.php?page=admin_news_liste");}
else{
if(!isset($_GET['id'])){header("Location:index.php?page=admin_news_liste");}
$r = readdata("dbnews",true,$_GET['id'],"date",null,false,null,1,10000000000,10000000000,true);
if($_SESSION['Auth']['rang']==2){
if($r[0]['auteur'] != $_SESSION['Auth']['pseudo']){$_SESSION['error'] = "Vous n'avez pas le droit d'éditer ce post.";header("Location:index.php?page=admin_news_liste");die();}
}
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
                $z = array();
                $z["titre"] = $_POST['titre'];
                $z["auteur"] = $r[0]['auteur'];
                $z["categorie"] = $_POST['categorie'];
                $z["date"] = $r[0]['date'];
                $z["online"] = (isset($_POST['publier']))?1:0;
                $z["contenu"] = converttohtml($_POST['contenu']);
                replacedatawithdatafromid("dbnews",$z,$_GET['id']);
                header("Location:index.php?page=admin_news_liste");
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour éditer un article.";}
    }
}

}
$c = readdata("dbnewscategories");
?>
<h1>Editer un article</h1>
<form action="index.php?page=admin_news_editer&id=<?php echo $_GET['id']; ?>" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/><br />
    <label for="titre">Titre de la News :</label><br />
    <div class="spacer"></div>
    <input type="text" name="titre" value="<?php echo $r[0]['titre']; ?>"/><br />
    <div class="spacer"></div>
    <div class="spacer"></div>
    <label for="titre">Contenu de la News :</label><br />
    <div class="spacer"></div>
    <textarea class="markItUp" name="contenu"><?php echo converttobbcode($r[0]['contenu']); ?></textarea>
    <div class="spacer"></div>
    <span class="left" >
    <label for="categorie">Catégorie de la News : </label>
    <select style="margin-left:5px" name="categorie">
    <?php
foreach($c as $id => $h){
    $y = "";
    if($r[0]['categorie'] == $id){$y = " selected='selected'";}
    echo "<option".$y." value ='".$id."'>".$h['titre']."</option>";
}
    ?>
    </select>
    </span>
    <input class="right checkbox" type="checkbox" <?php if($r[0]['online']==1) echo 'checked="checked"'; ?> name="publier" id="publier" value="1"/>
    <label for="publier" class="right">Publier cette news</label>
    <div class="clear"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <input type="submit" value="Éditer cette News"/>
</form>