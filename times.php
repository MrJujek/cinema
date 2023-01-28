<?php
    include "./database/DatabaseData.php";
    $conn = new mysqli($servername, $username, $password, $database);
    if ($conn->connect_errno) die('Brak połączenia z MySQL');


    $sql = "SELECT * FROM `seanse`";
    $res = $conn->query($sql);
    $response = array();
    while ($row = mysqli_fetch_assoc($res)) {
        $json[] = [
            "id" => $row["id"],
            "id_film" => $row["id_film"],
            "date" => $row["date"],
            "hour" => $row["hour"],
        ];
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

    $conn->close();
?>