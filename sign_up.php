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

        if (isset($_POST['login'], $_POST['pass'], $_POST['phone'])) {
            $pass=$_POST['pass'];
            $login = $_POST['login'];
            $phone = $_POST['phone'];
            if(strlen($phone)==9&&strlen($login)>2&&strlen($pass)>2){
                $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $sql = "SELECT * FROM `users` WHERE login='$login' ";
                $res = $conn->query($sql);
                $response = array();

                while ($row = mysqli_fetch_assoc($res)) {
                    $response[] = $row;
                }

                if ($login==$response[0]['login']) {
                    echo("Login already exists");
                }else{
                    $conn->query("INSERT INTO users (login, password, phone) VALUES ('$login', '$password', $phone)") or die('Nie można zapisać rekordu');
                    header("Location: sign_in.php");
                }
            }else{
                echo("Incorrect data");
            }
        }?>
        
        <div class="signup">
            <form method="POST">
                Sign up
                <label>Login:</label>        
                <input type="text" name="login" min="3"required />
                    
                <label>Password:</label>
                <input type="password" name="pass" min="3" required />
                

                <label>Phone Number:</label>
                <input type="text" name="phone" min="9" max="9" required  />
                    
                <input type="submit" value="Sign up"></input>
            </form>
            OR
            <a href="sign_in.php">Sign in</a>
        </div>
    </main>
    
    <footer>
        <span>Julian Dworzycki</span>
        <span>© Cinema 2023</span>
    </footer>
</body>
</html>
