<h1>Création du compte administrateur 2/3</h1>
<div class="spacer" ></div>
<?php
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['rang'])){
                if(addUser($_POST['pseudo'],$_POST['pass'],$_POST['rang'])){
                header("Location:index.php?page=install_3");
            	}
        }else{$error = "Veuillez remplir tous les champs pour ajouter un administrateur.";}
    }
}
?>
<form action="" method="POST">
    <label for="titre">Pseudo de l'Administrateur :</label><br /><div class="spacer" ></div>
    <input type="text" name="pseudo"/><br /><div class="spacer" ></div>
    <label for="pass">Mot de passe de l'Administrateur :</label><br /><div class="spacer" ></div>
    <input type="password" name="pass"/><br /><div class="spacer" ></div><div class="spacer" ></div>
    <input type="hidden" name="rang" value="1" />
    <input type="submit" value="Créer mon compte"/>
</form>