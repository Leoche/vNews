<?php
if(!isset($_GET)){
    header("Location:index.php?page=admin_news_categories_liste");
}
elseif(empty($_GET['id']) && empty($_GET['token'])){
    header("Location:index.php?page=admin_news_categories_liste");
}
else{
    if($_SESSION['Auth']['rang']!=1){header("Location:index.php?page=home");}
    if($_GET['id']==0){header("Location:index.php?page=admin_news_categories_liste");}
    if($_GET['token'] != $_SESSION['Auth']['token']){header("Location:index.php?page=admin_news_liste");}
    deletecategory($_GET['id']);
    header("Location:index.php?page=admin_news_categories_liste");
}

?>