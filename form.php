<?php
if($_SERVER['REQUEST_METHOD'] === "POST"){ 
    $uploadDir = 'uploads/';
    $uploadFile = $uploadDir . uniqid();
    $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
    $authorizedExtensions = ['jpg', 'png', 'gif', 'webp'];
    $maxFileSize = 1000000;

    if( (!in_array($extension, $authorizedExtensions))){
        $errors[] = 'Veuillez sélectionner une image de type Jpg, Png, Gif ou Webp !';
    }

    if( file_exists($_FILES['avatar']['tmp_name']) && filesize($_FILES['avatar']['tmp_name']) > $maxFileSize)
    {
        $errors[] = "Votre fichier doit faire moins de 1M !";
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
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
    <body>
        <form method="post" enctype="multipart/form-data">
            <div>
                <label for="firstname">Firstname:</label>    
                <input type="text" name="firstname" id="firstname" />
            </div>
            <div>
                <label for="lastname">Lastname:</label>    
                <input type="text" name="lastname" id="lastname" />
            </div>
            <div>
                <label for="age">Age:</label>    
                <input type="number" name="age" id="age" />
            </div>
            <div>
                <label for="imageUpload">Upload an profile image</label>    
                <input type="file" name="avatar" id="imageUpload" />
            </div>
            <div>
                <button name="send">Send</button>
            </div>
        </form>
<?php
if($_SERVER['REQUEST_METHOD'] === "POST")
{
    if(!empty($errors))
    {
        echo "<div><ul>";
        foreach ($errors as $error)
        {
            echo "<li>";
            echo $error;
            echo "</li>";
        }
        echo "</ul></div>";
    }
    else {
        move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadFile);?>
        <div class="card" style="width: 18rem;">
          <img src="<?=$uploadFile?>" class="card-img-top" alt="...">
              <div class="card-body">
                <h5 class="card-title"><?=$_POST['firstname'] . " " . $_POST['lastname']?></h5>
                <p class="card-text"><?=$_POST['age']?> yo</p>
                <a href="#" class="btn btn-primary">Delete picture</a>
        </div>
<?php }}; ?>
    </body>
</html>

