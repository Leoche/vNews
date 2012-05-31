<?php
$z = readdata("config");
if(isset($_POST)){
    if(!empty($_POST)){
        if(!empty($_POST['news_par_page']) && !empty($_POST['token']) ){
            if($_POST['token']==$_SESSION['Auth']['token']){
                $z["news_par_page"] = $_POST['news_par_page'];
                savedata("config",$z);
                $message = "Les options viennent d'être changées.";
            }else{$error = "Votre session n'est pas valide reconnectez vous.";}
        }else{$error = "Veuillez remplir tous les champs pour éditer les options.";}
    }
}
?>
<h1>Options</h1>


<!-- ////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////// -->
<!-- ////////////////////////////////////////////////// -->



<div class="spacer"></div>
<form action="" method="post">
<input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/>
<table>
<!-- ////////////////////////////////////////////////// -->
<tr class="altrow">
<td>
<strong>Thèmes</strong>
</td><td>
<a href="index.php?page=admin_themes">Gerer les thèmes</a>
</td>
</tr>
<!-- ////////////////////////////////////////////////// -->

<tr>
<td>
<input type="hidden" name="token" value="<?php echo $_SESSION['Auth']['token']; ?>"/>
<strong>Nombre d'articles par pages</strong>
</td><td>

<select name="news_par_page">
<?php
for($i=1;$i<25;$i++){
    if($i == $z['news_par_page']){echo "<option selected='selected' value='".$i."'>".$i."</option>";}
    else{echo "<option value='".$i."'>".$i."</option>";}
}
?>
</select>
</td>
</tr>
<!-- ////////////////////////////////////////////////// -->
</table>
<div class="spacer"></div>
<input type="submit" value="Enregistrer les options"/>
</form>
