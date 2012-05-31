<h1>Que voulez-vous faire ?</h1>
<br>
<a href="index.php?page=admin_news_ajouter">
<div class="boutton-block">
    <div class="boutton" id="addnews"></div>
    <span>Écrire un article</span>
</div>
</a>
<?php if(is_connected()){ ?>
<a href="index.php?page=admin_users_ajouter">
<div class="boutton-block">
    <div class="boutton" id="addusers"></div>
    <span>Ajouter un utilisateur</span>
</div>
</a>
<a href="index.php?page=admin_miseajour">
<div class="boutton-block">
    <div class="boutton" id="maj"></div>
    <span>Mise à jour</span>
</div>
</a>
<a href="index.php?page=admin_options">
<div class="boutton-block">
    <div class="boutton" id="changetheme"></div>
    <span>Changer le thème</span>
</div>
</a>
<?php } ?>
<div class="clear"></div>