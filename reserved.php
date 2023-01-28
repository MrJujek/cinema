<?php
    include "./database/DatabaseData.php";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_errno) die('Brak połączenia z MySQL');


    $sql = "SELECT * FROM `book`";
    $res = $conn->query($sql);
    $response = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $json[] = [
            "id" => $row["id"],
            "row" => $row["row"],
            "seat" => $row["seat"],
            "id_film" => $row["id_film"],
        ];
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

    $conn->close();
?>