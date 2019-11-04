<?php

require 'config.php';
$bdd = getDB();
//liste des 5 derniers articles
$res = $bdd->query('SELECT a.* FROM article a LIMIT 5'); // limit 5
$articles = $res->fetchAll();


?>
<!-- table à l'extérieur de la boucle -->
    <table>
    <tr>
        <th>Titre</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
<?php foreach($articles as $article){ ?>
<?php $origDate = $article['datetime'];
 
 $newDate = date("d-m-Y H:i:s", strtotime($origDate)); //format date : H au lieu de h (format 24/12h)
 ?>
        <tr>
            <td><?php echo $article['titre'] ?></td>
            <td><?php echo $newDate ?></td><!-- supression du echo -->
            <td>
                <a href="article.php?id_article=<?php echo $article['id'] ?>">Lire</a>
            </td>
        </tr>
<?php } ?>
    </table>