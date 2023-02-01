<?php
    session_start();

    $target_dir = "img/films/";
    $target_file = $target_dir . basename($_FILES["addnewimage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["addnewimage"]["tmp_name"]);
        if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        } else {
        echo "File is not an image.";
        $uploadOk = 0;
        }
    }

    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        $_SESSION["fileuploaded"] = "false";
        header("Location: addfilmimage.php");
    } else {
        if (move_uploaded_file($_FILES["addnewimage"]["tmp_name"], $target_file)) {
            $_SESSION["fileuploaded"] = "true";
            $_SESSION["filename"] = basename( $_FILES["addnewimage"]["name"]);
            header("Location: addfilmimage.php");
        } else {
            $_SESSION["fileuploaded"] = "false";
            header("Location: addfilmimage.php");
        }
    }
?>