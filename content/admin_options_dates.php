<?php
$z = readdata("config");
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
                if($_POST["datetype"] == "defaut")
                    $z["date_format"] = "defaut";
                else
                    $z["date_format"] = $_POST["customdate"];
                savedata("config",$z);
                header("Location:index.php?page=admin_options");
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour éditer les options.";}
    }
}
?>
<script type="text/javascript" src="js/vNews.js"></script>
<h1>Formats de dates</h1>
<form action="" method="POST">
    <input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/>
    <table>
        <tr>
            <td><input type="radio" value="defaut" name="datetype" <?php if($z["date_format"]=="defaut") echo "checked='checked'"; ?>/></td>
            <td>Format par défaut</td>
            <td>Exemple: <i>Il y a 2 jours.</i></td>
        </tr>
        <tr>
            <td><input type="radio" value="custom" name="datetype" <?php if($z["date_format"]!="defaut") echo "checked='checked'"; ?>/></td>
            <td>Format personnalisé</td>
            <td><input type="text" name="customdate" <?php if($z["date_format"]!="defaut") echo "value='".$z['date_format']."'"; ?>/></td>
        </tr>
    </table>
        <span class='spoiler'>Aide pour le format personnalisé.</span>
        <div class="hide">
            <div class="spacer"></div>
            <table>
                <thead>
                    <td colspan="2">Jours</td>
                    <td colspan="2">Années</td>
                </thead>
                <tr>
                    <td>d</td>
                    <td>01-31</td>
                    <td>y</td>
                    <td>1990, 2004</td>
                </tr>
                <tr><td>D</td>
                    <td>Lundi-Dimanche</td>
                    <td>Y</td>
                    <td>90, 04</td>
                </tr>
                <thead>
                    <td colspan="2">Mois</td>
                    <td colspan="2">Heures</td>
                </thead>
                <tr><td>m</td>
                    <td>01-12</td>
                    <td>H</td>
                    <td>Heures: 0-23</td>
                </tr>
                <tr><td>M</td>
                    <td>Janvier-Décembre</td>
                    <td>i</td>
                    <td>Minutes: 00-59</td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td>s</td>
                    <td>Secondes: 00-59</td>
                </tr>
            </table>
        <pre>Exemples :

«le d/m/Y à Hhi» donnera «le 21/12/12 à 12h21»
«le D d M y» donnera «le Vendredi 21 Décembre 2012»</pre>
        </div>
<div class="spacer"></div>
<input type="submit" value="Enregistrer le format de dates"/>
</form>
</form>
