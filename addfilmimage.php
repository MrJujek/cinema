<?php
    session_start();
?>
<head>
    <title>Cinema</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="img/cinema.jpg">
</head>

<body>
    <div class="top-panel">
        <?php
        if ($_SESSION["login"] == "admin") {
            echo '<a href="adminpanel.php" class="adminpanel">ADMIN PANEL</a>';
        }
        ?>
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
        <a href="logout.php" class="logout"><img src="./img/logout.png">Log out</a>
    </div>

    <div class="bottom-panel">
        Add new image

        <div class="addnewimage">
            <form method="POST" action="uploadfile.php" enctype="multipart/form-data">
                <label for="addnewimage">Upload file:</label>
                <input type="file" name="addnewimage" id="addnewimage">
                
                <input type="submit" value="Add image"></input>
            </form>

            <?php
                if (isset($_SESSION['fileuploaded'])) {
                    if ($_SESSION["fileuploaded"] == "true") {
                        echo 'File '.$_SESSION["filename"].' succesfuly uploaded';
                    } else {
                        echo 'There was an error uploading file';
                    }
                }
            ?>
        </div>
    </div>

    <div class="footer">
        <span>Julian Dworzycki</span>
        <span>© Cinema 2022</span>
    </div>
    
    <?php
    session_start();
    if (!isset($_SESSION["login"])) {
        header("Location: login.php");
        $_SESSION["logged"] = false;
        exit();
    } else {
        if ($_SESSION["login"] != "admin") {
            header("Location: index.php");
            exit();
        } else {
            $_SESSION["logged"] = true;
        }
    }
    ?>
    <?php
        echo '<pre>';
        var_dump($_SESSION);
        echo '</pre>';
    ?>
</body>

</html>