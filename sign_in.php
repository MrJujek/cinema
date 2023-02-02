<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cinema</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="icon" href="./img/cinema.jpg">
</head>

<body>
    <header>
        <a href="index.php"><img src="./img/cinema.jpg">Cinema</a>
    </header>

    <main>
        <?php
        include "./database/DatabaseData.php";
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_errno) die('Brak połączenia z MySQL');
        if (isset($_POST['login'], $_POST['pass'])) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];
            $sql = "SELECT * FROM `users` WHERE login='$login' ";
            
            $res = $conn->query($sql);
            if ($res==null){
                header("Location: sign_in.php");
            }
            $response = array();
            while ($row = mysqli_fetch_assoc($res)) {
                $response[] = $row;
            }
            var_dump($response);
            if (password_verify($pass, $response[0]['password'])&& $login==$response[0]['login']) {
                session_start();

                $_SESSION['login'] = $_POST['login'];

                $_SESSION['id'] = $response[0]['id'];
                header("Location: cinema.php");
            }else{
                echo ("Wrong password or login");
                header("Location: sign_in.php");
            }

            $conn->close();
        };?>

        <div class="signin">
            <form method="POST">
                Sign in
                <label>Login:</label>
                <input type="text" name="login" required />
                
                <label>Password:</label>
                <input type="password" name="pass" required />

                <input type="submit" value="Sign in"></input>
            </form>
            OR
            <a href="sign_up.php">Sign up</a>
        </div>
    </main>
    
    <footer>
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </footer>
</body>

</html>