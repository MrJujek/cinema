<head>
    <title>Cinema</title>
    <link rel="stylesheet" href="/style/style.css">
    <link rel="icon" href="img/cinema.jpg">
</head>

<body>
    <div class="top-panel"><a href="index.php"><img src="img/cinema.jpg">Cinema</a></div>
    <div class="bottom-panel">
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
            header("Location: login.php");
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
            header("Location: kino.php");
        }else{
            echo ("Wrong password or login");
            header("Location: login.php");
        }

        $conn->close();
    };
    ?>
    <div class="signin">
        <form method="POST">
            <label>Login:</label>
            <input type="text" name="login" required />
            
            <label>Password:</label>
            <input type="password" name="pass" required />

            <button type="submit">Login</button>
        </form>

        <a href="register.php">Sign up</a>
    </div>
</div>
</body>

</html>