<?php
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['titre']) && !empty($_POST['contenu']) && !empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
                $z = array();
                $z["titre"] = $_POST['titre'];
                $z["auteur"] = $_SESSION['Auth']['pseudo'];
                $z["date"] = time();
                $z["slug"] = slug($_POST['titre']);
                $z["contenu"] = converttohtml($_POST['contenu']);
                savedatawithdata("dbpages",$z);
                header("Location:index.php?page=admin_pages_liste");
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour ajouter une page.";}
    }
}
?>
<h1>Ajouter une page</h1>
<form action="" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/><br />
    <label for="titre">Titre de la Page :</label><br /><div class="spacer"></div>
    <input type="text" name="titre"/><br />
    <div class="spacer"></div>
    <div class="spacer"></div>
    <label for="contenu">Contenu de la Page :</label><br /><div class="spacer"></div>
    <textarea class="markItUp" name="contenu"></textarea><br />
    <div class="spacer"></div>
    <div class="spacer"></div>
    <input type="submit" value="Ajouter cette Page"/>
</form>