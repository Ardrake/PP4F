Upload results<br>

<?php
$jeuxid = $_GET['idjeux'];
echo "jeux id : ".$jeuxid."<br>";
$target_dir = "assets/jeux/".$jeuxid."/";
echo $target_dir."<br>";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// verifié si fichier existe deja
if (file_exists($target_file)) {
    echo "Fichier exist deja";
    $uploadOk = 0;
}
// validé dimension du fichier - limites
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Désoler votre fichier est trop gros.";
    $uploadOk = 0;
}
// permettre certain type de fichiers
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "zip"
&& $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "txt" && $imageFileType != "htm" 
&& $imageFileType != "html" && $imageFileType != "doc" && $imageFileType != "xls" && $imageFileType != "gif" ) {
    echo "Désoler seulement les fichiers de type JPG, JPEG, PNG, GIF, ZIP, PDF, TXT, HTM, HTML, DOC et XLS sont permis.";
    $uploadOk = 0;
}
// valide si $uploadOk est a 0 - erreur de validation
if ($uploadOk == 0) {
    echo "Votre fichiers n'a pas été téléchargé.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        header('Location: uploadMat.php?message="Fichier Téléchargé"');
        
    } else {
        echo "Erreur de téléchargement de fichiers";
    }
}
?>

