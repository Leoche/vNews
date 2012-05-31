<?php
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['pseudo']) && !empty($_POST['pass']) && !empty($_POST['rang']) && !empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
                addUser($_POST['pseudo'],$_POST['pass'],$_POST['rang']);
                header("Location:index.php?page=admin_users_liste");
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour ajouter un Utilisateur.";}
    }
}
?>
<h1>Ajouter un Utilisateur</h1>
<form action="" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/><br />
    <label for="titre">Pseudo de l'Utilisateur :</label><br />
    <input type="text" name="pseudo"/><br />
    <label for="pass">Mot de passe de l'Utilisateur :</label><br />
    <input type="text" name="pass"/><br />
      <label for="rang">Rang de l'Utilisateur :</label><br />
    <select name="rang">
        <optgroup label="Rang">
		<option value="1">Utilisateur</option>
		<option value="2">Journaliste</option>
        </optgroup>
</select><br /><br />
    <input type="submit" value="Ajouter cet Utilisateur"/>
</form>