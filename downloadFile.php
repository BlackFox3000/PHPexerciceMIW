<?php
$form= '
    <form enctype="multipart/form-data" action="upload.php" method="post">
        Nom : <input type="text" name="nom"><br />
     Photo : <input type="file" name="photo"><br />
     <input type="submit" value="Envoyer">
    </form>';

echo($form);

