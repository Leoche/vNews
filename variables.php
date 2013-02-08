<?php
$debug = false;
$rolesnum = array(1,2,3,4);
$roles = array(1=>'Administrateur',2=>'Journaliste',3=>'Correcteur',4=>'Moderateur');
$auths = array(
	1=>"*",
	2=>array("home"=>"*","news"=>"*"),
	3=>array("home"=>"*","news"=>array("liste","editer"),"pages"=>array("liste","editer")),
	4=>array("home"=>"*","news"=>array("liste"),"coms"=>"*")
	);
?>