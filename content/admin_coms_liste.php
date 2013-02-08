<h1>Liste des Commentaire de l'article <?php echo  $_GET["id"]; ?></h1>
<div class="spacer"></div>
<a style="margin-left:10px;" class="bouttona" href="index.php?page=admin_news_liste">Retour</a><br/>
<div class="spacer"></div>
<table>
    <thead>
        <td><input id="checkall" type="checkbox" onchange="javascript:checkAll();" /></td>
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
    <td><input type="checkbox" class="comcheck" value="<?php echo $id; ?>" /></td>
    <td><?php echo date("d/m/Y",$n['date']); ?></td>
    <td><?php echo $n['pseudo']; ?></td>
    <td><?php echo $n['message']; ?></td>
    <td>
        <a onclick="javascript:h = confirm('Voulez-vous vraiment supprimer \'<?php echo $n['pseudo']; ?>\'?'); if(h){return true;} else{return false;}" href="index.php?page=admin_coms_supprimer&id=<?php echo $id; ?>;&token=<?php echo $_SESSION['Auth']['token']; ?>"><img src="css/images/delete.png" alt="Delete" /></a>
    </td>
    </tr>
<?php
}
}
?>
</tbody>
</table>
<input id="deleteall" type="submit" value="Supprimer" />
<input type="text" id="finalchecks" style="display:none;">
<script type="text/javascript">
    var finalchecks = "";
    jQuery(function(){
        $("#deleteall").hide().click(function(){
            window.location='index.php?page=admin_coms_supprimer&id='+finalchecks+'&token=<?php echo $_SESSION["Auth"]["token"]; ?>';
        });
        $(".comcheck").click(function(){
            if($(this).attr("checked")!="checked"){
                finalchecks = finalchecks.replace($(this).attr("value")+";","");
                $("#checkall").removeAttr('checked');
            }else{
                finalchecks += $(this).attr("value")+";";
                if($('.comcheck:not(:checked)').length==0)
                    $("#checkall").attr('checked','checked');
            }
            $("#finalchecks").val(finalchecks);
            if(finalchecks!="")
                $("#deleteall").slideDown();
            else
                $("#deleteall").slideUp();
        });
    });
    function checkAll(){
        if($('.comcheck:not(:checked)').length==0){
            $(".comcheck").removeAttr('checked');
            finalchecks="";
            $("#deleteall").slideUp();
        }
        else{
            $("#deleteall").slideDown();
            $(".comcheck").attr('checked','checked');
            finalchecks = "";
            $(".comcheck").each(function(){
                finalchecks += $(this).attr("value")+";";
            });
        }
        $("#finalchecks").val(finalchecks);
    }
</script>