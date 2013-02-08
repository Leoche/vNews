<h1>Fini, vous étiez parfait! 3/3</h1>
<div class="spacer"></div>
<?php
    $r = readdata("config");
    $r["install"] = 1;
    savedata("config",$r);
?>
Votre installation est maintenant terminé, vous allez maintenant être redirigée sur la page de connection dans quelques secondes...
<script language="JavaScript"> 
window.setTimeout("location=('index.php');",4000);
</script> 