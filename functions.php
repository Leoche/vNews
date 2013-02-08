<?php
function savedata($file,$data,$s=true,$root=false){
    if($root){$filepath = getFolder()."/content/private/".$file.".vnews";}
    else{$filepath = "content/private/".$file.".vnews";}
    $file = fopen($filepath,"w+");
    if($s){$data = serialize($data);}
    fputs($file, $data);
    fclose($file);
    return true;
}
function deleteidfromdata($file,$id){
    $x = readdata($file);
    unset($x[$id]);
    savedata($file,$x);
}
function replacedatawithdatafromid($file,$data,$id,$all=false){
    $x = readdata($file,true,null,null,null,false,null,1,10000000000,10000000000,$all);
    $x[$id] = array();
    $x[$id] = $data;
    savedata($file,$x);
}
function replacealldatawithdata($file,$index,$source,$data){
    $x = readdata($file);
    $r = $x;
    foreach($x as $i => $p){
        if($p[$index]==$source){
        $r[$i][$index] = $data;
        }
    }
    $x = $r;
    savedata($file,$x);
}
function deletealldatawithdata($file,$index,$source){
    $x = readdata($file);
    $r = $x;
    foreach($x as $i => $p){
        if($p[$index]==$source){
        unset($r[$i]);
        }
    }
    $x = $r;
    savedata($file,$x);
}

function readdata($file,$u=true,$id=null,$order=null,$sens=null,$root=false,$limit=null,$page=1,$newsid=10000000000,$cat=10000000000,$all=false){   
    $filename = $file;
    if(!ctype_alnum($file)){$filepath = $file;}
    elseif($root){$filepath = getFolder()."/content/private/".$file.".vnews";}
    else{$filepath = "content/private/".$file.".vnews";}
    if(!file_exists($filepath)){return false;}
    $file = fopen($filepath,"r");
    $taille_fichier=filesize($filepath);
    if($taille_fichier==0){return false;}
    $data=fread($file,$taille_fichier);
    fclose($file);
    if($u){$data = unserialize($data);}
    if(empty($data)){return null;}
    if($id != null){if(isset($data[$id]) && ($all || !isset($data[$id]["online"]) || (isset($data[$id]["online"]) && $data[$id]["online"]==1)) ){$e= $data[$id];$data = "";$data[0]=$e;}else{return "404";}}
    if($newsid!=10000000000){
        $temp=array();
        foreach($data as $w=>$m){
            if($m["news_id"] == $newsid ){
                $temp[$w] = $m;
            }
        }
        $data="";
        $data=$temp;
        return $data;
    }
    if($order!=null){
    $sear = array();
    $datatmp = array();
        foreach($data as $e => $p){
            $sear[$e] = $p[$order];
        }
        if($sens){asort($sear);}else{arsort($sear);}
        $datatmp = $data;
        $data = array();
        foreach($sear as $o => $r){
            $data[$o] = $datatmp[$o];
        }
    }
    if($limit!=null){
        $i=0;

        $temp=array();
        foreach($data as $w=>$m){
            if($i < $limit*$page && $i >= ($limit*$page)-$limit){
                $temp[$w] = $m;
            }
            $i++;
        }
        $data="";
        $data=$temp;
    }
    if($cat!=10000000000){
        if(!is_numeric($cat)){
            $cat = getCatidfromslug($cat,$root);
        }
        if(!is_numeric($cat))
            return "";
        $temp=array();
        foreach($data as $w=>$m){
            if($m["categorie"] == $cat){
                $temp[$w] = $m;
            }
        }
        $data="";
        $data=$temp;
    }
    if(!$all && $filename == "dbnews"){
        $temp = "";
        foreach($data as $w=>$m){
            if(!isset($m["online"]) || (isset($m["online"]) && $m["online"]==1)){
                $temp[$w] = $m;
            }
        }
        $data="";
        $data=$temp;
    }
    return $data;
}

function news_exist($id,$root=false){
    if(readdata("dbnews",true,$id,null,null,$root)!="404"){
        return true;
    }
    else{
        return false;
    }
}

function pages_exist($id,$root=false){
    if(getCatidfromslug($id,$root,'dbpages')!==false){
        if(readdata("dbpages",true,getCatidfromslug($id,$root,'dbpages'),null,null,$root)!="404"){
            return true;
        }
        else{
            return false;
        }
    }
        else{
            return false;
        }
}

function getCatname($id,$root=false){
    if($root){$c = readdata("dbnewscategories",true,$id,null,null,true);}
    else{$c = readdata("dbnewscategories",true,$id);}
    return $c[0]['titre'];
}
function getCatidfromslug($slug,$root=false,$file="dbnewscategories"){
    if($root){$c = readdata($file,true,null,null,null,true);}
    else{$c = readdata($file,true,null);}
    foreach($c as $i=>$k){
        if($k['slug'] == slug($slug)){
            return $i;
        }
    }
    return false;
}
function deletecategory($id){
    replacealldatawithdata("dbnews","categorie",$id,0);
    deleteidfromdata("dbnewscategories",$id);
}
function countComs($id,$root=false){
    $coms = readdata('dbcoms',true,null,null,false,$root,null,null,$id);
    if(is_array($coms)){
    return count($coms);
    }else{return 0;}
}
function getPagination($current = 1,$limit,$cat){
    echo "<center>";
    if($cat!=10000000000){
        $cate = "&categorie=".$cat;
    }else{
        $cate = null;
    }
    $sep = " | ";
    $ttnews = count(readdata('dbnews',true,null,null,null,true,null,1,10000000000,$cat));
    $ttpages = ceil($ttnews/$limit);
    if($current != 1){
        $prev = $current-1;
        echo "<a href='?page=".$prev.$cate."'><< Pr&eacute;c&eacute;dent</a>".$sep;
    }
    for($i=1;$i<$ttpages+1;$i++){
        if($i == $ttpages){$sep = "";}
        else{$sep = " | ";}
        if($i == $current){
        echo $i.$sep;
        }
        else{
        echo "<a href='?page=".$i.$cate."'>".$i."</a>".$sep;
        }
    }
    if($current != $ttpages){
        $suiv = $current+1;
        echo " | <a href='?page=".$suiv.$cate."'>Suivant >></a>";
    }
    echo "</center>";
}

function is_install(){
    if(!readdata("config")){
        return false;
    }
    else{
        if(readdata("config",true,"install")){
            $c = readdata("config",true,"install");
            if($c[0] == 1){
                if(file_exists("content/install.php")){unlink("content/install.php");}
                if(file_exists("content/install_1.php")){unlink("content/install_1.php");}
                if(file_exists("content/install_2.php")){unlink("content/install_2.php");}
                if(file_exists("content/install_3.php")){unlink("content/install_3.php");}
                return true;
            }else{ return $c;}
        }
        else{ return "grergd"; }
    }
}

function savedatawithdata($file,$data,$s=true,$root=false){
    $x = readdata($file,true,null,null,null,$root);
    $x[] = $data;
    if(!$root){
    if(savedata($file,$x)){
        return true;
    }
    }
    else{
    if(savedata($file,$x,true,true)){
        return true;
    }
    }
}

function addUser($pseudo,$motdepasse,$rang){
    $hash = getHashcode();
    $motdepasse = sha1($hash.$motdepasse);
    $array = array("pseudo"=>$pseudo,"motdepasse"=>$motdepasse,"rang"=>$rang);
    if(savedatawithdata("dbuser",$array)){
        return true;
    }
}

function connect($pseudo,$motdepasse){
    $motdepasse = sha1(getHashcode().$motdepasse);
    $dbuser = readdata('dbuser');
    foreach ($dbuser as $de=>$d){
        //echo debug($d);
        if($d['pseudo']==$pseudo){
            if($d['motdepasse']==$motdepasse){
                $_SESSION['Auth'] = array();
                $_SESSION['Auth']['pseudo']=$pseudo;
                $_SESSION['Auth']['motdepasse']=$motdepasse;
                $_SESSION['Auth']['rang']=$d['rang'];
                $_SESSION['Auth']['token']=genKey(26);
                return true;
                break; 
            }else{ return false;}
        }
    }
}

function genKey($lenght){
    $uniquekey = "";
    $alpha = range("a","z");
    for($i=0;$i<$lenght;$i++){
        if(rand(1,2)==1){
            $uniquekey.=rand(0,9);
        }
        else{
            if(rand(1,2)==1){
                $uniquekey.=$alpha[rand(0,25)];
            }
            else{
                $uniquekey.=strtoupper($alpha[rand(0,25)]);
            }
        }
    }
    return $uniquekey;
}

function getHashcode($root=false){
if($root){$h = readdata("config",true,null,null,null,true);}
else{$h = readdata("config");}
return $h['hashcode'];
}

function getVersion($root=false){
if($root){$h = readdata("config",true,null,null,null,true);}
else{$h = readdata("config");}
return $h['version'];
}

function theme_exist($t){
    if(is_dir(getFolder()."/themes/"+$t))
        return true;
    return false;
}

function getFolder(){
if(preg_match('/\//',__FILE__)){
    $folder = explode("/",__FILE__);
}
else{
    $folder = explode("\\",__FILE__);
}
$folder = $folder[count($folder)-2];
return $folder;
}

function verifVersion(){
    ob_start();
    echo substr(file_get_contents("http://www.leoche.org/assets/vnews/lastversion"),-3);
    $curversion = ob_get_contents();
    ob_end_clean();
    if(getVersion()){
    if(intval(substr($curversion,-1))>intval(substr(getVersion(),-1))){
        return "Votre version est obselète, vNews v".$curversion." est disponible sur Leoche.org.";
    }
    if(intval(substr($curversion,-1))<intval(substr(getVersion(),-1))){
        return "Votre version est une Bêta, si vous rencontrez un bogue informez en moi sur Leoche.org.";
    }
    else{return 1;}
    }
    else{return 1;}
}

function debug($s){
    return "<pre>".print_r($s)."</pre>";
}

function converttohtml($text){
    $text = nl2br(htmlspecialchars($text));
    $bbcode = array("\[spoiler=(.*?)\](.*?)\[\/spoiler\]"=>"<span class='spoiler'>$1</span><p>$2</p>","\[zoombox\](.*?)\[\/zoombox\]"=>"<div class='zoombox'>$1</div>","\[html\](.*?)\[\/html\]"=>"$1","\[centre\](.*?)\[\/centre\]"=>"<center>$1</center>","\[b\](.*?)\[\/b\]"=>"<strong>$1</strong>","\[i\](.*?)\[\/i\]"=>"<em>$1</em>",
                    "\[u\](.*?)\[\/u\]"=>"<u>$1</u>","\[img\](.*?)\[\/img\]"=>"<img src='$1' />","\[url=(.*?)\](.*?)\[\/url\]"=>"<a href='$1'>$2</a>",
                    "\[size=(.*?)\](.*?)\[\/size\]"=>'<span style="font-size:$1%">$2</span>',"\[color=(.*?)\](.*?)\[\/color\]"=>'<span style="color:$1">$2</span>',
                    "\[quote\](.*?)\[\/quote\]"=>"<blockquote>$1</blockquote>","\[list\=(.*?)\](.*?)\[\/list\]"=>"<ol start='$1'>$2</ol>","\[list\](.*?)\[\/list\]"=>"<ul>$1</ul>",
                    "\[\*\]\s?(.*?)\n"=>"<li>$1</li>","\[code=(.*?)\](.*?)\[\/code\]"=>"<pre class='code' lang='$1'>$2</pre>","\[droite\](.*?)\[\/droite\]"=>"<div style='float:right'>$1</div>","\[gauche\](.*?)\[\/gauche\]"=>"<div style='float:left'>$1</div>");
    foreach($bbcode as $k=>$v){
        if($k == "\[html\](.*?)\[\/html\]"){
          $text = str_replace("&lt;", "<", $text);
          $text = str_replace("&gt;", ">", $text);
          $text = str_replace("&amp;", "&", $text);
          $text = str_replace("&quot;", '"', $text);
          $text = str_replace("&#039;", "'", $text);
          $text = preg_replace('/'.$k.'/ms',"<div class='html'>".$v."</div>",$text);
      }
        else{
          $text = preg_replace('/'.$k.'/ms',$v,$text);
      }
    }
    return $text;
}

function getSocialButton($service,$title,$url){
    $buttons = array(
        'twitter'=>'<a href="https://twitter.com/share" class="twitter-share-button" data-lang="fr" data-url="'.$url.'" data-text="'.$title.'" data-hashtags="vNews">Tweet</a>',
        'facebook'=>'<div class="fb-like" data-send="false" data-height="23" data-layout="button_count" data-show-faces="false"></div>',
        'google'=>'<div class="g-plusone" data-size="medium" data-href="'.$url.'"></div>'
    );
    return $buttons[$service];
}

function getSocialScript($service){
    $scripts = array(
        'twitter'=>'<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>',
        'facebook'=>'<style type="text/css">.fb-like span{height:23px !important;margin-right:15px;</style><div id="fb-root"></div><script>(function(d, s, id){var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "http://connect.facebook.net/fr_FR/all.js#xfbml=1&appId=524376704262889";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "facebook-jssdk"));</script>',
        'google'=>'<script type="text/javascript" src="https://apis.google.com/js/plusone.js">{lang: "fr"}</script>'
    );
    return $scripts[$service];
}

function converttobbcode($text){
    $bbcode = array("<span class='spoiler'>(.*?)<\/span><p>(.*?)<\/p>"=>"[spoiler=$1]$2[/spoiler]","<div class='zoombox'>(.*?)<\/div>"=>"[zoombox]$1[/zoombox]","<div style='float:left'>(.*?)<\/div>"=>"[gauche]$1[/gauche]","<div style='float:right'>(.*?)<\/div>"=>"[droite]$1[/droite]","<center>(.*?)<\/center>"=>"[centre]$1[/centre]","&quot;"=>'"',"&lt;"=>"<","&amp;"=>"&",'<img src="(.*?)"\/>'=>"[img]$1[/img]","&gt;"=>">","<strong>(.*?)<\/strong>"=>"[b]$1[/b]",
                    "<em>(.*?)<\/em>"=>"[i]$1[/i]","<u>(.*?)<\/u>"=>"[u]$1[/u]","<img src='(.*?)' \/>"=>"[img]$1[/img]","<a href='(.*?)'>(.*?)<\/a>"=>"[url=$1]$2[/url]",
                    '<span style="font-size:(.*?)">(.*?)<\/span>'=>"[size=$1]$2[/size]",'<span style="color:(.*?)">(.*?)<\/span>'=>"[color=$1]$2[/color]",
                    "<ul>(.*?)<\/ul>"=>"[list]$1[/list]","<ol start='(.*?)'>(.*?)<\/ol>"=>"[list=$1]$2[/list]","<blockquote>(.*?)<\/blockquote>"=>"[quote]$1[/quote]",
                    "<pre class='code' lang='(.*?)'>(.*?)<\/pre>"=>"[code=$1]$2[/code]","<li>(.*?)<\/li>"=>"[*] $1","<br \/>"=>"");
    foreach($bbcode as $k=>$v){
          $text = preg_replace('/'.$k.'/ms',$v,$text);
    }
    return stripcslashes($text);
}
function getTheme($tm,$root=true,$page="news"){
    if($root){$data = readdata(getFolder()."/themes/".$tm."/".$page.".html",false);}
    else{readdata("themes/".$tm."/".$page.".html",false);}
    return $data;
}
function toDate($timestamp,$c){
    $df = $c["date_format"];
    if($df=="defaut"){
        $difference = time() - $timestamp;
        $periods = array("seconde", "minute", "heure", "jour", "semaine", "mois", "an", "décedie");
        $lengths = array("60","60","24","7","4.35","12","10");
        for($j = 0; $difference >= $lengths[$j]; $j++) $difference /= $lengths[$j];
        $difference = round($difference);
        if($difference != 1 && $j!=5) $periods[$j].= "s";
        $text = "Il y a $difference $periods[$j]";
        return $text;
    }
    else{
        $t = $timestamp;
        $date = $df;
        $keyJ = array("J0","J1","J2","J3","J4","J5","J6");
        $keyM = array("M01","M02","M03","M04","M05","M06","M07","M08","M09","M10","M11","M12"); 
        $jours = array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
        $mois = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"); 
        $finds = array("d","m","y","Y","H","i","s","D","M");
        $repl  = array(date("d",$t),date("m",$t),date("Y",$t),date("y",$t),date("H",$t),date("i",$t),date("s",$t),$keyJ[date("w",$t)],$keyM[date("n",$t)-1]);
        $date = str_replace($finds, $repl, $date);
        $date = str_replace($keyJ, $jours, $date);
        $date = str_replace($keyM, $mois, $date);
        return $date;
    }
    return "";
}
setlocale(LC_ALL, 'en_US.UTF8');
function slug($str, $replace=array(), $delimiter='-') {
    if( !empty($replace) ) {$str = str_replace((array)$replace, ' ', $str);}$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);$clean = strtolower(trim($clean, '-'));$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);return $clean;
}
function is_mobile(){  $mobile_browser   = false;  if (stristr($_SERVER['HTTP_USER_AGENT'], "Android")|| strpos($_SERVER['HTTP_USER_AGENT'], "iPod")|| strpos($_SERVER['HTTP_USER_AGENT'], "iPhone")) { $mobile_browser = true;}  return $mobile_browser;}
function is_connected(){if(!isset($_SESSION['Auth']["rang"])){return false;}else{return true;}}
function is_auth($page){
global $roles, $auths, $rolesnum;
$page = explode("_", $page);
if($page[0]!="admin"){return true;}
if(!isset($_SESSION['Auth']["rang"])){return false;}
$id = $_SESSION['Auth']["rang"];
if(!in_array($id, $rolesnum)){return false;}
if($auths[$id] == "*"){return true;}

if(isset($auths[$id][$page[1]])){
    if($auths[$id][$page[1]] == "*"){return true;}
    if(isset($page[2])){
        if(in_array($page[2],$auths[$id][$page[1]])){return true;}
    }
    return false;
}else{return false;}
}

function getvNewsTweets(){
$hashtag = 'vnews';
$show = 10;
$cacheFile = 'cache/' . $hashtag .'.json.cache';
$cacheTime = 10 * 60;
if (file_exists($cacheFile) && (time() - $cacheTime < filemtime($cacheFile))) {
    $json = file_get_contents($cacheFile);
}
else {
    $json = file_get_contents("http://search.twitter.com/search.json?result_type=recent&rpp=$show&q=%23" . $hashtag);
    $fp = fopen($cacheFile, 'w');
    fwrite($fp, $json);
    fclose($fp);
}
return json_decode($json)->results;
$results = json_decode($json)->results;
/*
function displayTweet($text) {
    $text = preg_replace('@(https?://([-\w\.]+)+(/([\w/_\.]*(\?\S+)?(#\S+)?)?)?)@', '<a class="twitterLink" rel="nofollow" href="$1">$1</a>',$text);
    $text = preg_replace('/@(\w+)/','<a class="twitterUser" rel="nofollow" href="http://twitter.com/$1">@$1</a>',$text);
    return $text;
}
*/
}
?>