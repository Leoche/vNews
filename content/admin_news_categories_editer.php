<?php
if(!isset($_GET)){header("Location:index.php?page=admin_news_categories_liste");}
else{
    if(!isset($_GET['id'])){header("Location:index.php?page=admin_news_categories_liste");}
    else{if($_GET['id']==0){header("Location:index.php?page=admin_news_categories_liste");}}
    $r = readdata("dbnewscategories",true,$_GET['id']);
    if(isset($_POST)){
        if(!empty($_POST)){
            if(!empty($_POST['titre'])  && !empty($_POST['token']) ){
                if($_POST['token']==$_SESSION['Auth']['token']){
                    $z = array();
                    $z["titre"] = $_POST['titre'];
                    $z["slug"] = slug($_POST['titre']);
                    replacedatawithdatafromid("dbnewscategories",$z,$_GET['id']);
                    header("Location:index.php?page=admin_news_categories_liste");
                }else{$error = "Votre session n'est pas valide reconnectez vous.";}
            }else{$error = "Veuillez remplir tous les champs pour éditer une catégorie d'article.";}
        }
    }
}
?>
<h1>Éditer une categorie d'article</h1>
<form action="index.php?page=admin_news_categories_editer&id=<?php echo $_GET['id']; ?>" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/><br />
    <label for="titre">Titre de la Catégorie de News :</label><br />
    <input type="text" name="titre" value="<?php echo $r[0]['titre']; ?>"/><br />
    <div class="spacer"></div>
    <input type="submit" value="Éditer cette catégorie de News"/>
</form>