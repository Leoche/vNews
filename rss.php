<?php include "functions.php"; 
$z = readdata("config");
if(!isset($z["sitelink"]) || !isset($z["sitename"]) || !isset($z["sitedesc"])){
    echo "Vous devez d'abord configurer le flux RSS via les options de vNews.";
    die();
}
else{
$n = readdata('dbnews',true,null,"date",false,false,10,1,10000000000,10000000000);
echo '<?xml version="1.0" encoding="UTF-8"?><rss version="2.0">';
?>
    <channel>
   
        <title><?php echo $z["sitename"]; ?></title>
        <link><?php echo $z["sitelink"]; ?></link>
        <description><?php echo $z["sitedesc"]; ?></description>
       <?php if(!empty($n)){
        foreach($n as $k=>$v): ?>       
        <item>
            <title><?php echo $v["titre"]; ?></title>
            <link><?php echo $z["sitelink"]; ?>/?news=<?php echo $k; ?></link>
            <author><?php echo $v["auteur"]; ?></author>
            <description><?php echo substr($v["contenu"],0,150); ?></description>
            <pubDate><?php echo date("D, j M Y H:i:s \G\M\T",$v["date"]); ?></pubDate>
        </item>
       <?php endforeach; } ?>
    </channel>
</rss>
<?php } ?>