<?php
    include "./database/DatabaseData.php";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_errno) die('Brak połączenia z MySQL');
    
    $ran = json_decode($_POST['del']);

    for ($i = 0; $i < sizeof($ran); $i++) {
        $id = $ran[$i]->{'id'};
        $row = $ran[$i]->{'row'};
        $seat = $ran[$i]->{'seat'};
        $id_film = $ran[$i]->{'id_film'};
        if ($id == 5) {
            $sql = "DELETE FROM book WHERE row=$row AND seat=$seat AND id_film=$id_film;";
        } else {
            $sql = "DELETE FROM book WHERE id=$id AND row=$row AND seat=$seat AND id_film=$id_film;";
        }
        $result = $conn->query($sql);
    }
    $conn->close();
?>