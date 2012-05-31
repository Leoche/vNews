<?php
    if(isset($_POST)){
            if(isset($_POST['pseudo']) && isset($_POST['motdepasse'])){
            if(!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])){
                if(connect($_POST['pseudo'],$_POST['motdepasse'])){
                    header("Location:index.php?page=admin_home");
                }
                else{
                    $error = "Identifiants incorrects";
                }
            }
            else{
            $error = "Veuillez remplir tous les champs pour vous connecter.";
            }
            }
    }


?>
<h1>Connectez vous</h1>
<div class="spacer"></div>
<form action="" method="POST">
<label for="pseudo">Pseudo :</label>
<div class="spacer"></div>
    <input type="text" name="pseudo"/>
<div class="spacer"></div>
<label for="motdepasse">Mot de Passe :</label>
<div class="spacer"></div>
    <input type="password" name="motdepasse"/>
<div class="spacer"></div>
    <input type="submit" value="Se connecter"/>
</form>