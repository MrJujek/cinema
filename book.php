<?php
    include "./database/DatabaseData.php";
    $conn = new mysqli($servername, $username, $password, $database);

    if ($conn->connect_errno) die('Brak połączenia z MySQL');
    $ran = json_decode($_POST['choosen']);

    for ($i = 0; $i < sizeof($ran); $i++) {
        $id = $ran[$i]->{'id'};
        $row = $ran[$i]->{'row'};
        $seat = $ran[$i]->{'seat'};
        $id_film = $ran[$i]->{'id_film'};
        $sql = "INSERT INTO book (id, row, seat,id_film) VALUES ('$id', '$row', '$seat','$id_film')";
        $result = $conn->query($sql);
    }
    $conn->close();
?>