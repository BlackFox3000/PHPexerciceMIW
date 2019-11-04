<?php

function foundImage($id, $bdd){

    $req = $bdd->prepare('SELECT image FROM article WHERE id=:id');

    $req->bindValue('id', $id);
    $req->execute();
    return  $req->fetchAll(PDO::FETCH_ASSOC);


}