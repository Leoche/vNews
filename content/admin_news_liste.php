<h1>Liste des articles</h1>
<div class="spacer"></div>
<?php if(is_auth("admin_news_categories")){ ?>
<a class="bouttona" href="index.php?page=admin_news_ajouter">Ajouter un article</a><a style="margin-left:10px;" class="bouttona" href="index.php?page=admin_news_categories_liste">Gestion des catégories</a><br/>
<div class="spacer"></div>
<?php } ?>
<table>
    <thead>
        <td>Titre</td>
        <td>Contenu</td>
        <td>Auteur</td>
        <td>Date</td>
        <td>Catégorie</td>
        <td>Action</td>
    </thead>
    <tbody>
<?php
$news = array();
if(readdata("dbnews")){
    $news = readdata("dbnews");
}
$i=0;
foreach ($news as $id=>$n){
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
    <td><?php echo substr(strip_tags($n['contenu']),0,20)."..."; ?></td>
    <td><?php echo $n['auteur']; ?></td>
    <td><?php echo date("d/m/Y",$n['date']); $g = $n['titre'];?></td>
    <td><?php echo getCatname($n['categorie']); ?></td>
    <td>
        <a href="index.php?page=admin_news_editer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/edit.png" alt="Editer" /></a>
        <?php if(is_auth("admin_news_supprimer")){ ?><a onclick="javascript:h = confirm('Voulez-vous vraiment supprimer \'\'<?php echo $n['titre']; ?>\'\'?'); if(h){return true;} else{return false;}" href="index.php?page=admin_news_supprimer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/delete.png" alt="Delete" /></a>
        <?php 
        }
        if(countComs($id))
        {
        ?>
        &nbsp;&nbsp;
        <a alt="Editer les commentaires" href="index.php?page=admin_coms_liste&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/coms.gif" alt="Editer les commentaires" /></a>
        <?php 
        } 
        ?>
    </td>
    </tr>
<?php
}
}
?>
</tbody>
</table>