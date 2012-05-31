<?php
if(!isset($_GET)){
    header("Location:index.php?page=admin_users_liste");
}
elseif(empty($_GET['id']) && empty($_GET['token'])){
    header("Location:index.php?page=admin_users_liste");
}
else{
    if($_GET['token'] != $_SESSION['Auth']['token']){header("Location:index.php?page=admin_users_liste");}
    deleteidfromdata("dbuser",$_GET['id']);
    header("Location:index.php?page=admin_users_liste");
}

?>