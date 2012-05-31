<h1>Liste des pages</h1>
<div class="spacer"></div>
<a class="bouttona" href="index.php?page=admin_pages_ajouter">Ajouter une page</a><br/>
<div class="spacer"></div>
<table>
    <thead>
        <td>Titre</td>
        <td>Contenu</td>
        <td>Slug</td>
        <td>Auteur</td>
        <td>Date</td>
        <td>Action</td>
    </thead>
    <tbody>
<?php
$pages = array();
if(readdata("dbpages")){
    $pages = readdata("dbpages");
}
$i=0;
foreach ($pages as $id=>$n){
$re="";
    $i++;
    if($i==2){$i=0;$re = " class='altrow'";}
    $no=false;
    if($_SESSION['Auth']['rang']==2){
    if($n['auteur']!=$_SESSION['Auth']['pseudo']){
        $no = true;
        }
    }
        if(!$no){
?>
    <tr<?php echo $re; ?>>
    <td><?php echo substr($n['titre'],0,20); ?></td>
    <td><?php echo substr(htmlspecialchars($n['contenu']),0,20)."..."; ?></td>
    <td><?php echo $n['slug']; ?></td>
    <td><?php echo $n['auteur']; ?></td>
    <td><?php echo date("d/m/Y",$n['date']); $g = $n['titre'];?></td>
    <td>
        <a href="index.php?page=admin_pages_editer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/edit.png" alt="Editer" /></a>
        <a onclick="javascript:h = confirm('Voulez-vous vraiment supprimer \'\'<?php echo $n['titre']; ?>\'\'?'); if(h){return true;} else{return false;}" href="index.php?page=admin_pages_supprimer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/delete.png" alt="Delete" /></a>
    </td>
    </tr>
<?php
}
}
?>
</tbody>
</table>

