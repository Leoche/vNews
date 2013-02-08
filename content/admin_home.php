<h1>Que voulez-vous faire ?</h1>
<br>
<div class="centered">
<?php $i=0; ?>

<?php if(is_auth("admin_news_ajouter")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_news_ajouter">
    <div class="boutton">
        <div class="icon big">E</div>
    </div>
    <span>Écrire un article</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_users_ajouter")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_users_ajouter">
    <div class="boutton">
        <div class="icon big">U</div>
    </div>
    <span>Ajouter un utilisateur</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_pages_ajouter")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_pages_ajouter">
    <div class="boutton">
        <div class="icon big">E</div>
    </div>
    <span>Rédiger une page</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_themes")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_themes">
    <div class="boutton">
        <div class="icon big">T</div>
    </div>
    <span>Changer le thème</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_miseajour")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_miseajour">
    <div class="boutton" id="maj">
        <div class="icon big">P</div>
    </div>
    <span>Mise à jour</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_propos")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_propos">
    <div class="boutton" id="maj">
        <div class="icon big">H</div>
    </div>
    <span>À Propos</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_propos")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_propos">
    <div class="boutton" id="maj">
        <div class="icon big">H</div>
    </div>
    <span>À Propos</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_coms_liste")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_news_liste">
    <div class="boutton" id="maj">
        <div class="icon big">E</div>
    </div>
    <span>Modérer</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_news_editer")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_news_liste">
    <div class="boutton" id="maj">
        <div class="icon big">E</div>
    </div>
    <span>Corriger les news</span>
</a>
</div>
<?php } ?>

<?php if(is_auth("admin_pages_editer")){ $i++; ?>
<div class="boutton-block <?php if($i>6) echo "hhhide"; elseif($i>4) echo 'hhide'; ?>" >
<a href="index.php?page=admin_pages_liste">
    <div class="boutton" id="maj">
        <div class="icon big">E</div>
    </div>
    <span>Corriger les pages</span>
</a>
</div>
<?php } ?>


</div>
<?php
/*
Pour la prochaine version de vNews ;) 0.6 :

echo '<br /><span style="float:left;">#vNews : </span><marquee scrollamount="3" direction="right" style="display:inline-block;float:right;width: 88%;">';
$ts = getvNewsTweets();
foreach ($ts as $k) {
    $text = $k->text;
    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a class="twitterLink" rel="nofollow" href="$1">$1</a>',$text);
    $text = preg_replace('/@(\w+)/','<a class="twitterUser" rel="nofollow" href="http://twitter.com/$1">@$1</a>',$text);
    echo $text."&nbsp;&nbsp;&nbsp;&nbsp;";
}
echo "</marquee>";"
*/
?>
<div class="clear"></div>