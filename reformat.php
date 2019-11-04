<?php

$fichier=$_FILES['photo']['name'];
var_dump($fichier);
$file = 'tmp/image/'.$type.'/'.$fichier;
var_dump($file);
//on récupère l'extension de l'image:
$ext = explode('.', $file);
$ext = strtolower($ext[count($ext)-1]);
switch ($ext) {
    case 'gif':
        $source_gd_image = imagecreatefromgif($file);
        break;
    case 'jpeg':
    case 'jpg':
        $source_gd_image = imagecreatefromjpeg($file);
        break;
    case 'PNG':
        $source_gd_image = imagecreatefrompng($file);
        break;
}
if($source_gd_image === false){
    echo 'erreur lors de la récupération de la source de l\'image';
    die();
}

echo('Ca marche');

//on récupère la taille de notre image
$imgsize = getimagesize($file);
if($imgsize === false){
    echo 'erreur lors de la récupération de la
source de l\'image';
    die();
}
var_dump($imgsize);

//on récupère la taille de notre image
$imgsize = getimagesize($file);
if($imgsize === false){
    echo 'erreur lors de la récupération de la source de l\'image';
    die();
}
//création de la miniature, en concervant le ratio.
//on fixe une largeur (width)
$thumbnailWitdh = 150;
//on calcul la hauteur
$thumbnailHeight = floor($thumbnailWitdh*$imgsize[1]/$imgsize[0]);
$thumbnailWitdh;
$thumbnailHeight;
//on créé une image "vide" (une image noire)
$thumbnail = imagecreatetruecolor($thumbnailWitdh, $thumbnailHeight);
//on créé une copie de notre image source
imagecopyresampled($thumbnail, $source_gd_image, -10,-10, -20, -30, $thumbnailWitdh,
    $thumbnailHeight, $imgsize[1], $imgsize[1]);

$dossier='./tmp/image/'.$type.'/';
//et on en fait un fichier jpeg avec une qualité de 90%
imagejpeg($thumbnail, $dossier.'thumb_'.$fichier, 90);
//on n'oublie pas de libérer la mémoire, car nos images sources sont stockées et prennent de la place!
imagedestroy($source_gd_image);
imagedestroy($thumbnail);
echo '<img src="'. $dossier.'thumb_'.$fichier.'">';
echo '<img src="'. $dossier.$fichier.'">';

