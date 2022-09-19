<?php

include '../connection.php';

$id_user = $_POST['id_user'];
$date = $_POST['date'];
$type = $_POST['type'];

$sql = "SELECT * FROM history 
        WHERE id_user='$id_user' AND date='$date' AND type='$type'";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(array(
        "success" => true,
        "data" => $data[0],
    ));
} else {
    echo json_encode(array(
        "success" => false,
    ));
}
