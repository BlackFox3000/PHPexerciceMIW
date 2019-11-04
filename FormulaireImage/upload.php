<?php
function testFile($path){
    if(! file_exists($path)) {
        if (!mkdir($path))
            die('Le fichier image n\'existe pas et n\'as pas pu être créé.');
    }
}
function renameFile($path, $type){
    do {
        $name = date("D-d-M-Y-H-i-s-v").'.'.$type;
    }
    while(file_exists($path.'\\'.$name));
    return $name;
}
function traitementErreurs($valeur){
    if( $valeur==UPLOAD_ERR_INI_SIZE)
        echo('La taille du fichier téléchargé excède la valeur
          de upload_max_filesize, configurée dans le
           php.ini.<br>');
    if( $valeur== UPLOAD_ERR_FORM_SIZE )
        echo('La taille du fichier téléchargé excède la valeur
         de MAX_FILE_SIZE, qui a été spécifiée dans le
         formulaire HTML.<br>');
    if( $valeur==UPLOAD_ERR_PARTIAL )
        echo('Le fichier n\'a été que partiellement téléchargé.<br>');
    if( $valeur== UPLOAD_ERR_NO_TMP_DIR)
        echo('Aucun fichier n\'a été téléchargé.<br>');
    if( $valeur== UPLOAD_ERR_INI_SIZE)
        echo('Un dossier temporaire est manquant. Introduit
         en PHP 5.0.3.<br>');
    if( $valeur== UPLOAD_ERR_CANT_WRITE)
        echo('Échec de l\'écriture du fichier sur le disque.
          Introduit en PHP 5.1.0.<br>');
    if( $valeur== UPLOAD_ERR_EXTENSION )
        echo(') Une extension PHP a arrêté l\'envoi de fichier.
            PHP ne propose aucun moyen de déterminer
            quelle extension est en cause. L\'examen du
            phpinfo() peut aider. Introduit en PHP 5.2.0.<br>');
    if( $valeur== UPLOAD_ERR_OK)
        echo('Aucune erreur, le téléchargement est correct.<br>');
    else
        die('Erreur lors du téléchargement<br>');
}
//test upload
$valeur=$_FILES['photo']['error'];
traitementErreurs($valeur);

//vérification/création des dossiers
var_dump($_POST);
var_dump($_FILES);

$image='\wamp64\tmp\image';
//créer dossier image si il  n'existe pas
var_dump(file_exists($image));
testFile($image);
echo('__________________');

$type=str_split($_FILES['photo']['type'],6)[1];
//créer un sous dossier type s'il n'existe pas dans image
$pathType='\wamp64\tmp\image\\'.$type;
testFile($pathType);
var_dump(file_exists($pathType));
$typeFile=substr($_FILES['photo']['name'],-3);
$_FILES['photo']['name']=renameFile($pathType,$typeFile);

var_dump($_FILES);

if(isset($_FILES['photo'])){
    if($_FILES['photo']['error'] == UPLOAD_ERR_OK){
        $dossier = $pathType;
        $fichier = $_FILES['photo']['name'];//ou on peu mettre le nom de fichier que l'on veut pour être certain d'éviter les doublons
        if(move_uploaded_file($_FILES['photo']['tmp_name'], $dossier.$fichier)){
 //la fonction renvoie true, le fichier a bien été enregistré
        }else{
            echo 'echec de l\'upload.';
        }
    }
}
