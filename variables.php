<?php
$rolesnum = array(1,2,3);
$roles = array(1=>'Administrateur',2=>'Journaliste',3=>'Correcteur');
$auths = array(
	1=>"*",
	2=>array("home"=>"*","news"=>"*"),
	3=>array("home"=>"*","news"=>array("liste","editer"),"pages"=>array("liste","editer"))
	);
?>