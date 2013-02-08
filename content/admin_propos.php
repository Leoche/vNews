<script type="text/javascript" src="js/vNews.js"></script>
<h1>A propos de vous et de vNews</h1>
<br />
<span class='spoiler'>Comment installer vNews?</span><div class="hide"><br />Il vous suffit de décompresser l’archive de vNews (vNews-lastest.zip) afin d’y extraire le dossier vNews. Puis, glissez le dossier vNews à la racine de votre site web sur votre FTP.<br />
Enfin configurez vNews en accédant via votre site au dossier vNews (Exemple : http://votresite.fr/vNews/) suivez les quelques étapes et le tour est joué!<br />
</div><br />
<span class='spoiler'>vNews est installé, comment l’intégrer à mon site?</span><div class="hide"><br />Pour inclure vNews dans une page, assurez vous que son extension soit “.php” et non “.html” ou encore “.htm”. Enfin includez en php la page “news.php” qui se trouve dans le dossier vNews comme ceci <pre>&lt;?php include(“vNews/news.php”); ?></pre> (Dans ce cas la page php doit se trouver dans le meme répertoire que le dossier vNews).<br />
Exemple: J’ai installé vNews à la racine de mon site et ma page “index.php” se trouve elle aussi à la racine de mon site. Il me suffit d’éditer “index.php” pour y inclure :<br />
<pre>&lt;?php include(“vNews/news.php”); ?></pre><br />
</div><br />
<span class='spoiler'>Comment afficher qu’une seule catégorie d’article sur une page PHP?</span><div class="hide"><br />Méthode par l’URL ?categorie=exemple :<br />
Il vous suffit de rajouter une variable GET a l’url de votre page.<br />
Exemple: Vous incluez vNews sur une page “macategorie.php” pour afficher la categorie qui a pour “slug” “ma-categorie” l’url est la suivante : http://votresite.fr/mapage.php?categorie=ma-categorie<br />
<br />
Méthode par variable $categorie:<br />
Il vous suffit de rajouter le “slug” de la catégorie dans une variable $categorie avant l’inclusion de news.php.<br />
Exemple: <pre>&lt;?php $categorie = “ma-categorie”; include(“vNews/news.php”); ?></pre></div><br />
<span class='spoiler'>Comment afficher une page de vNews sur une page PHP?</span><div class="hide"><br />Méthode par l’URL ?page:<br />
Il vous suffit de rajouter une variable GET a l’url de votre page.<br />
Exemple: Vous incluez vNews sur une page “mapage.php” pour afficher la page qui a pour “slug” “ma-page” l’url est la suivante : http://votresite.fr/mapage.php?page=ma-page<br />
<br />
Méthode par variable $page:<br />
Il vous suffit de rajouter le “slug” de la page dans une variable $page avant l’inclusion de news.php.<br />
Exemple: Vous incluez vNews sur une page “mapage.php” pour afficher la page “ma-page”<br />
<pre>&lt;?php $page = “ma-page”; include(“vNews/news.php”); ?></pre></div><br />
<span class='spoiler'>Il n’y a “Pas de contenu disponible” sur ma page PHP, que se passe t’il?</span><div class="hide"><br />vNews n'arrive pas a trouver le contenu.<br />
Dans le cas d’un listage de news:<br />
Assurez vous qu’il y a bien une news de postée<br />
Dans le cas d’un affichage d’une page:<br />
Vérifiez que le slug indiqué correspond bien a un slug d’une page (Les slugs sont générés automatiquement à partir du titre de la page pour connaître le slug d’una page crée, rendez-vous sur la gestion des pages de l’administration vNews colonne slug.</div><br />
<span class='spoiler'>Comment choisir le nombre de news par page?</span><div class="hide"><br />Tout simplement via la partie options depuis l’administration de vNews</div><br />
<span class='spoiler'>Puis-je renommer le dossier vNews à ma guise?</span><div class="hide"><br />Vous pouvez biensûr renommer le dossier vNews comme bon vous semble pensez cependant à adapter vos inclusions.<br />
Exemple: Si je renomme vNews en Toto, alors l’inclusion de vNews se ferai par :<br />
<pre>&lt;?php include(“Toto/news.php”); ?></pre> </div><br />
<span class='spoiler'>Modifier l’aspect des news, pages ou commentaires?</span><div class="hide"><br />On en vient à la partie personnalisation de vNews. Le système fonctionne sous formes de thèmes que l’ont peut créer via l’administration vNews (options/gérer les thèmes). Une fois crée, votre thème comporte 4 fichiers modifiables directement sur l’administration via un éditeur à la volée :<br />
<br />
<u>news.html :</u> <br />
Cette page représente un bloc d’une news affichée dans le listage total des news comme sur une page d’accueil ou une page de catégorie.<br />
Les variables à insérer sont {titre}, {auteur}, {categorie}, {nbcommentaires} et {date}.<br />
<br />
<u>single.html :</u> <br />
Cette page représente elle aussi un bloc d’une news mais cette fois si unique c’est à dire quand une seule news est affichée. Cette page contient les commentaires qui sont attachés à la news en question.<br />
Les variables à insérer sont {titre}, {auteur}, {categorie}, {commentaires} et {date}.<br />
<br />
<u>commentaire.html :</u> <br />
Cette page représente le design d’un commentaire unique.<br />
Les variables à insérer sont {titre}, {auteur}, {date} et {commentaire}.<br />
<br />
<u>page.html :</u><br />
Cette page représente le bloc d’une page statique.<br />
Les variables à insérer sont {titre} et {contenu}.</div><br />

<span class='spoiler'>Comment ajouter un bouton "Lire la news"?</span><div class="hide"><br />
Depuis la version 0.5 de vNews, une nouvelle balise est apparue dans l'édition des thèmes dans le fichier news.html qui est <strong>{url}</strong>.<br/>
Cette balise affiche l'url qui mène vers la news ainsi pour créer un lien "Lire la news" ou encore "Lire plus..." il vous suffira d'ajouter dans le news.html : <br/>
<pre>&lt;a href="{url}" title="lien vers une news">Lire la news&lt;/a></pre>	
</div><br />

<span class='spoiler'>Comment désactiver la pagination?</span><div class="hide"><br />
Ajoutez simplement <pre>$pagination = false;</pre> avant l'include de vNews. Ce qui devrait ressembler à :<br/>
<pre>&lt;?php
$pagination = false;
include(“vNews/news.php”);
?></pre>	
</div><br />

<span class='spoiler'>Comment changer de thème selon la page?</span><div class="hide"><br />
Ajoutez le nom du thème à utiliser pour la page <pre>$theme = "montheme";</pre> avant l'include de vNews. Ce qui devrait ressembler à :<br/>
<pre>&lt;?php
$theme = "montheme";
include(“vNews/news.php”);
?></pre>	
</div><br />

<span class='spoiler'>Quels droits a-t’on sur vNews?</span><div class="hide"><br />vNews est gratuit au téléchargement ainsi qu’à l’utilisation. Cependant vNews souscrit à la license de creative commons CC BY-NC 2.0 (cf: http://creativecommons.org ). En résumé, l’utilisation est autorisée seulement pour des fins non commerciales, toutes modifications sont autorisées mais Leoche.org se réserve le droit paternité de vNews.</div>
<div class="spacer"></div><div class="spacer"></div>
<h1>Contributeurs</h1>
<div class="spacer"></div>
<strong>Merci à :</strong>
este007, Google,,, Rocket, .:Quentindu83:., Steven.8.7
 <i>pour leur idées et contributions.</i>