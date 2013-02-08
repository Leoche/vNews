<?php
$ids = array(
    "news"=>"f",
    "single"=>"f",
    "commentaires"=>"f",
    "page"=>"f",
    );
$helpers = array(
    "news"=>array(
        "Titre"=>"{titre}",
        "Auteur"=>"{auteur}",
        "Contenu"=>"{contenu}",
        "Date"=>"{date}",
        "Url de la News"=>"{url}",
        "Nombres de commentaires"=>"{nbcommentaires}",
        "Catégorie"=>"{categorie}",
        ),
    "single"=>array(
        "Titre"=>"{titre}",
        "Auteur"=>"{auteur}",
        "Contenu"=>"{contenu}",
        "Date"=>"{date}",
        "Commentaires"=>"{commentaires}",
        "Catégorie"=>"{categorie}",
        "Facebook: J'aime"=>"{like}",
        "Twitter: Tweet"=>"{tweet}",
        "Google: +1"=>"{+1}",
        ),
    "commentaires"=>array(
        "Pseudo du posteur"=>"{pseudo}",
        "Contenu du commentaire"=>"{commentaire}",
        "Date"=>"{date}",
        ),
    "page"=>array(
        "Titre"=>"{titre}",
        "Contenu"=>"{contenu}",
        "Facebook: J'aime"=>"{like}",
        "Twitter: Tweet"=>"{tweet}",
        "Google: +1"=>"{+1}",
        ),
    );
if(!isset($_GET["theme"])){
    if(is_dir("themes/".$_GET["theme"])){
        header("Location:index.php?page=admin_themes");
    }
}
if(isset($_GET["pagetoedit"])){
    $pagetoedit = $_GET["pagetoedit"];
    $ids[$_GET["pagetoedit"]]="F";
}else{
$pagetoedit = "";
}
if(isset($_POST['code']) && isset($_GET["pagetoedit"]) && isset($_GET["theme"])){
        file_put_contents("themes/".$_GET['theme']."/".$_GET['pagetoedit'].".html",$_POST['code']);
        $message = $_GET['pagetoedit'].".html vient d'être modifiée";
}
?>
<link rel="stylesheet" href="css/codemirror.css">
<script src="js/codemirror.js"></script>
<link rel="stylesheet" href="css/monokai.css">
<script src="js/javascript.js"></script>
<script src="js/css.js"></script>
<script src="js/xml.js"></script>
<script src="js/htmlmixed.js"></script>
<script type="text/javascript">
    var changed = false;
$(function(){
    $("a").click(function(){
        if(!$(this).hasClass("nohref")){
    if(changed){
        if(confirm('Vous avez modifie la template. Voulez-vous vraiment quitter sans sauvegarder?')){
            return  true;
        }else{
            return false;
        }
    }else{
            return true;
        }
}
    });
    $("textarea").keyup(function(event) {
        changed = true;
    });
});
</script>
<h1>Edition de page.html</h1>
<br/>
<div class="boutton-block">
    <div class="boutton">
<?php if($pagetoedit!="news"){ ?><a href="index.php?page=admin_themes_editer&theme=<?php echo $_GET['theme'] ?>&pagetoedit=news"><?php } ?>
        <div class="icon big"><?php echo $ids['news']; ?></div>
<?php if($pagetoedit!="news"){ ?></a><?php } ?>
    </div>
    <span>news.html</span>
</div>


<div class="boutton-block">
    <div class="boutton">
<?php if($pagetoedit!="single"){ ?><a href="index.php?page=admin_themes_editer&theme=<?php echo $_GET['theme'] ?>&pagetoedit=single"><?php } ?>
        <div class="icon big"><?php echo $ids['single']; ?></div>
<?php if($pagetoedit!="single"){ ?></a><?php } ?>
    </div>
    <span>single.html</span>
</div>


<div class="boutton-block">
    <div class="boutton">
<?php if($pagetoedit!="commentaires"){ ?><a href="index.php?page=admin_themes_editer&theme=<?php echo $_GET['theme'] ?>&pagetoedit=commentaires"><?php } ?>
        <div class="icon big"><?php echo $ids['commentaires']; ?></div>
<?php if($pagetoedit!="commentaires"){ ?></a><?php } ?>
    </div>
    <span>commentaires.html</span>
</div>


<div class="boutton-block">
    <div class="boutton">
<?php if($pagetoedit!="page"){ ?><a href="index.php?page=admin_themes_editer&theme=<?php echo $_GET['theme'] ?>&pagetoedit=page"><?php } ?>
        <div class="icon big"><?php echo $ids['page']; ?></div>
<?php if($pagetoedit!="page"){ ?></a><?php } ?>
    </div>
    <span>page.html</span>
</div>
<div class="clear"></div>
<?php if(isset($_GET['pagetoedit'])){
?>
<br />
<form name="codage" id="codage" method="post" action="index.php?page=admin_themes_editer&theme=<?php echo $_GET['theme'] ?>&pagetoedit=<?php echo $_GET['pagetoedit'] ?>">
<?php
$dir = "themes/".$_GET['theme']."/".$_GET['pagetoedit'].".html";
$file = fopen( $dir, "r",1);
if(filesize($dir)>0){
$contents = fread($file, filesize($dir));
}else{
    $contents="";
}
?>
<b>Variables à insérer:</b></br>
<?php
foreach($helpers[$_GET['pagetoedit']] as $k=>$r){
    echo '<a class="bouttona nohref" onClick="editor.replaceSelection(\''.$r.'\');editor.save();changed=true;">'.$k.'</a><div class="separe-button"></div>';
}
?>
<br />
<br />
<textarea id="code" name="code">
<?php echo $contents; ?>
</textarea>
<script>
var editor = CodeMirror.fromTextArea(document.getElementById("code"), {extraKeys: {            
    "F11": function() {              
        var scroller = editor.getScrollerElement();              
        if (scroller.className.search(/\bCodeMirror-fullscreen\b/) === -1) {                
            scroller.className += " CodeMirror-fullscreen";                
            scroller.style.height = "100%";                
            scroller.style.width = "100%";
            scroller.style.position = "fixed";  
            scroller.style.top = "0";  
            scroller.style.left = "0";              
            editor.refresh();              
        } else {                
            scroller.className = scroller.className.replace(" CodeMirror-fullscreen", "");                
            scroller.style.height = '';                
            scroller.style.width = '';   
            scroller.style.position = "static";  
            scroller.style.top = "";  
            scroller.style.left = "";                    
            editor.refresh();              
        }            
    },            
    "Esc": function() {              
        var scroller = editor.getScrollerElement();              
        if (scroller.className.search(/\bCodeMirror-fullscreen\b/) !== -1) {                
            scroller.className = scroller.className.replace(" CodeMirror-fullscreen", "");                
            scroller.style.height = '';                
            scroller.style.width = '';   
            scroller.style.position = "static";  
            scroller.style.top = "";  
            scroller.style.left = "";                   
            editor.refresh();
        }
    },
    "Ctrl-S":function(){
        $("#codage").submit();
    }
},"lineNumbers":true,"theme":"monokai",mode: "text/html", tabMode: "indent"});
</script>
<br/>

<input type="submit" value="Enregistrer la template"/>
</form>
<?php } ?>