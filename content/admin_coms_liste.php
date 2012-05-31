<h1>Liste des Commentaire de l'article <?php echo  $_GET["id"]; ?></h1>
<div class="spacer"></div>
<a style="margin-left:10px;" class="bouttona" href="index.php?page=admin_news_liste">Retour</a><br/>
<div class="spacer"></div>
<table>
    <thead>
        <td>Date</td>
        <td>Auteur</td>
        <td>Message</td>
        <td>Action</td>
    </thead>
    <tbody>
<?php
$coms = array();
if(readdata('dbcoms',true,null,"date",false,false,null,null,$_GET["id"]) ){
    $coms = readdata('dbcoms',true,null,"date",false,false,null,null,$_GET["id"]);
}
$i=0;
foreach ($coms as $id=>$n){
$re="";
    $i++;
    if($i==2){$i=0;$re = " class='altrow'";}
    $no=false;
        if(!$no){
?>
    <tr<?php echo $re; ?>>
    <td><?php echo date("d/m/Y",$n['date']); ?></td>
    <td><?php echo $n['pseudo']; ?></td>
    <td><?php echo $n['message']; ?></td>
    <td>
        <a onclick="javascript:h = confirm('Voulez-vous vraiment supprimer \'<?php echo $n['pseudo']; ?>\'?'); if(h){return true;} else{return false;}" href="index.php?page=admin_coms_supprimer&id=<?php echo $id; ?>&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/delete.png" alt="Delete" /></a>
    </td>
    </tr>
<?php
}
}
?>
</tbody>
</table>