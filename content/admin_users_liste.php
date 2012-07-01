<h1>Liste des Utilisateurs</h1>
<div class="spacer"></div>
<a class="bouttona" href="index.php?page=admin_users_ajouter">Ajouter un Utilisateur</a><br/>
<div class="spacer"></div>
<table>
    <thead>
        <td>Pseudo</td>
        <td>Rang</td>
        <td>Action</td>
    </thead>
<?php
$users = readdata("dbuser");
$i=0;
foreach ($users as $id=>$n){
    if($_SESSION['Auth']['pseudo']!=$n['pseudo']){
$re="";
    $i++;
    if($i==2){$i=0;$re = " class='altrow'";}
?>
    <tr<?php echo $re; ?>>
    <td><?php echo $n['pseudo']; ?></td>
    <td><?php echo $roles[$n['rang']]; ?></td>
    <td>
        <a href="index.php?page=admin_users_editer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/edit.png" alt="Editer" /></a>
        <a onclick="javascript:h = confirm('Voulez-vous vraiment supprimer \'\'<?php echo $n['pseudo']; ?>\'\'?'); if(h){return true;} else{return false;}" href="index.php?page=admin_users_supprimer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/delete.png" alt="Delete" /></a>
    </td>
    </tr>
<?php
}
}
?>
</table>