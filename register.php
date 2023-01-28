<head>
    <title>Cinema</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="img/cinema.jpg">
</head>

<body>
    <div class="top-panel"><a href="index.php"><img src="./img/cinema.jpg">Cinema</a></div>
    <div class="bottom-panel">
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
                    header("Location: login.php");
                }
            }else{
                echo("Too short login or password or phone number");
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
            <a href="login.php">Sign in</a>
        </div>
    </div>
    
    <div class="footer">
        <span>Julian Dworzycki</span>
        <span>© Cinema 2022</span>
    </div>
</body>