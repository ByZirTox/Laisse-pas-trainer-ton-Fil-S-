<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    $uploadDir = 'uploads';

    $uploadFile = $uploadDir . basename($_FILES['avatar']['name']);

    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

    $authorizedExtensions = ['jpg', 'jpeg', 'png'];

    $maxFileSize = 2000000;




    if ((!in_array($extension, $authorizedExtensions))) {

        $errors[] = 'Veuillez sélectionner une image de type Jpg ou Jpeg ou Png !';
    }


    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {

        $errors[] = "Votre fichier doit faire moins de 2M !";
    }


    if (empty($errors)) {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php foreach ($errors as $error) : ?>
        <ul>
            <li>
                <?= $error ?>
            </li>
        </ul>
    <?php endforeach; ?>
    <form method="post" enctype="multipart/form-data">

        <label for="imageUpload">Upload an profile image</label>

        <input type="file" name="avatar" id="imageUpload" />

        <button name="send">Send</button>

    </form>

</body>

</html>