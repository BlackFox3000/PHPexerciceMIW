<?php

require 'config.php';

function savePath($filepath, $id){


    $bdd = getDB();

    var_dump($_POST);
    $req = $bdd->prepare('update article set image=:path_image WHERE id=:id');

    $req->bindValue('path_image', $filepath);
    $req->bindValue('id', $id);
    $req->execute();

}