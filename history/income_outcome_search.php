<?php

include '../connection.php';

$id_user = $_POST['id_user'];
$type = $_POST['type'];
$date = $_POST['date'];

$sql = "SELECT id_history, date, total,type FROM history 
        WHERE id_user='$id_user' AND date='$date' ORDER BY date DESC";

$result = $connect->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode(array(
        "success" => true,
        "data" => $data,
    ));
} else {
    echo json_encode(array(
        "success" => false,
    ));
}
