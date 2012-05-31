
<?php
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['titre']) && !empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
                $z = array();
                $z["titre"] = $_POST['titre'];
                $z["slug"] = slug($_POST['titre']);
                savedatawithdata("dbnewscategories",$z);
                header("Location:index.php?page=admin_news_categories_liste");
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour ajouter une catégorie d'article";}
    }
}
?>
<h1>Ajouter une categorie d'article</h1>
<form action="" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/><br />
    <label for="titre">Titre de la Catégorie de News :</label><br /><div class="spacer"></div>
    <input type="text" name="titre"/><br />
    <div class="spacer"></div>
    <div class="spacer"></div>
    <input type="submit" value="Ajouter cette catégorie d'article"/>
</form>