<?php
if(!isset($_GET)){header("Location:index.php?page=admin_pages_liste");}
else{
if(!isset($_GET['id'])){header("Location:index.php?page=admin_pages_liste");}
$r = readdata("dbpages",true,$_GET['id']);
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
                $z = array();
                $z["titre"] = $_POST['titre'];
                $z["slug"] = slug($_POST['titre']);
                $z["auteur"] = $r[0]['auteur'];
                $z["date"] = $r[0]['date'];
                $z["contenu"] = converttohtml($_POST['contenu']);
                replacedatawithdatafromid("dbpages",$z,$_GET['id']);
                header("Location:index.php?page=admin_pages_liste");
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour éditer une page.";}
    }
}

}
$c = readdata("dbpagescategories");
?>
<h1>Editer une page</h1>
<form action="index.php?page=admin_pages_editer&id=<?php echo $_GET['id']; ?>" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/><br />
    <label for="titre">Titre de la Page :</label><br />
    <div class="spacer"></div>
    <input type="text" name="titre" value="<?php echo $r[0]['titre']; ?>"/><br />
    <div class="spacer"></div>
    <div class="spacer"></div>
    <label for="titre">Contenu de la Page :</label><br />
    <div class="spacer"></div>
    <textarea class="markItUp" name="contenu"><?php echo converttobbcode($r[0]['contenu']); ?></textarea>
    <div class="spacer"></div>
    <input type="submit" value="Éditer cette Page"/>
</form>