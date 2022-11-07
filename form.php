<?php
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $uploadDir = 'uploads/';
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $uploadFile = $uploadDir . uniqid() . "." . $extension;
    $authorizedExtensions = ['jpg', 'png', 'gif', 'webp'];
    $maxFileSize = 1000000;

    if ((!in_array($extension, $authorizedExtensions))) {
        $errors[] = 'Veuillez sélectionner une image de type JPG, PNG, GIF ou WEBP !';
    }

    if (file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize) {
        $errors[] = "Veuillez choisir un fichier de moins de 1Mo !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image de profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="firstname">Prénom:</label>
            <input type="text" name="firstname" id="firstname" required />
        </div>
        <div>
            <label for="lastname">Nom:</label>
            <input type="text" name="lastname" id="lastname" required />
        </div>
        <div>
            <label for="age">Age:</label>
            <input type="number" name="age" id="age" required />
        </div>
        <div>
            <label for="imageUpload">Choisir une image</label>
            <input type="file" name="avatar" id="imageUpload" required />
        </div>
        <div>
            <button name="send">Envoyer</button>
        </div>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        if (!empty($errors)) {
            echo "<div><ul>";
            foreach ($errors as $error) {
                echo "<li>";
                echo $error;
                echo "</li>";
            }
            echo "</ul></div>";
        } else {
            move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile); ?>
            <div class="card" style="width: 18rem;">
                <img src="<?= $uploadFile ?>" class="card-img-top" alt="image de profil">
                <div class="card-body">
                    <h5 class="card-title"><?= $_POST['firstname'] . " " . $_POST['lastname'] ?></h5>
                    <p class="card-text"><?= $_POST['age'] ?> ans</p>
                </div>
        <?php }
    }; ?>
</body>

</html>