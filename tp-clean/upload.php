<?php
require_once 'uploadImageTemp/functions.php';
require_once 'savePath.php';
var_dump($_POST);
if(isset($_FILES['fichier'])){

    try{
        $filepath = uploadFile('fichier');
    }catch (Exception $e){
        echo $e->getMessage();
        die;
    }

    if(file_exists($filepath)){
        echo 'Upload fichier OK<br />';
        $file_path=resizeImg($filepath, 100, 100);
        savePath($file_path, $_POST['id']);
        header('Location: article.php?id_article='.(int)$_POST['id']);
    }
}
?>

