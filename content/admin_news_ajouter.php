<?php
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
                $z = array();
                $z["titre"] = $_POST['titre'];
                $z["auteur"] = $_SESSION['Auth']['pseudo'];
                $z["categorie"] = $_POST['categorie'];
                $z["date"] = time();
                $z["online"] = (isset($_POST['publier']))?1:0;
                $z["contenu"] = converttohtml($_POST['contenu']);
                savedatawithdata("dbnews",$z);
                header("Location:index.php?page=admin_news_liste");
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour ajouter un article.";}
    }
}
$c = readdata("dbnewscategories");
?>
<h1>Ajouter un article</h1>
<form action="" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/><br />
    <label for="titre">Titre de la News :</label><br /><div class="spacer"></div>
    <input type="text" name="titre"/><br />
    <div class="spacer"></div>
    <div class="spacer"></div>
    <label for="contenu">Contenu de la News :</label><br /><div class="spacer"></div>
    <textarea class="markItUp" name="contenu"></textarea><br />
    <div class="spacer"></div>
    <span class="left" >
    <label for="categorie">Catégorie de la News : </label>
    <select style="margin-left:5px" name="categorie">
    <?php
foreach($c as $id => $h){
    echo "<option value ='".$id."'>".$h['titre']."</option>";
}
    ?>
    </select>
    </span>
    <input class="right checkbox" type="checkbox" name="publier" id="publier" value="1"/>
    <label for="publier" class="right">Publier cette news</label>
    <div class="clear"></div>
    <div class="spacer"></div>
    <div class="spacer"></div>
    <input type="submit" value="Ajouter cette News"/>
</form>