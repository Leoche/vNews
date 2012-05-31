<h1>Liste des categories d'articles</h1>
<div class="spacer"></div>
<a class="bouttona" href="index.php?page=admin_news_categories_ajouter">Ajouter une Catégorie d'article</a><a style="margin-left:10px;" class="bouttona" href="index.php?page=admin_news_liste">Retour aux articles</a><br/>
<div class="spacer"></div>
<table>
    <thead>
        <td>ID</td>
        <td>Titre</td>
    </thead>
    <tbody>
<?php
$news = array();
if(readdata("dbnewscategories")){
    $news = readdata("dbnewscategories");
}
$i=0;
foreach ($news as $id=>$n){
$re="";
    $i++;
    if($i==2){$i=0;$re = " class='altrow'";}
    $no=false;
        if(!$no && $id!=0){
?>
    <tr<?php echo $re; ?>>
    <td><?php echo substr($n['titre'],0,20); ?></td>
    <td>
        <a href="index.php?page=admin_news_categories_editer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/edit.png" alt="Editer" /></a>
        <a onclick="javascript:h = confirm('Voulez-vous vraiment supprimer \'\'<?php echo $n['titre']; ?>\'\'?'); if(h){return true;} else{return false;}" href="index.php?page=admin_news_categories_supprimer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/delete.png" alt="Delete" /></a>
    </td>
    </tr>
<?php
}
}
?>
</tbody>
</table>