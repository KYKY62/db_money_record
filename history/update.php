<?php

include '../connection.php';

$id_history = $_POST['id_history'];
$id_user    = $_POST['id_user'];
$type       = $_POST['type'];
$date       = $_POST['date'];
$total      = $_POST['total'];
$details    = $_POST['details'];
$update_at  = $_POST['update_at'];


$sql_check = "SELECT * FROM history WHERE id_user = '$id_user' AND date = '$date'";

$result_check = $connect->query($sql_check);

if ($result_check->num_rows > 1) {
    echo json_encode(array(
        "success" => false,
        "message" => "date",
    ));
} else {
    $sql = "UPDATE history SET 
            id_user='$id_user',
            type='$type',
            date='$date',
            total='$total',
            details='$details',
            update_at = '$update_at' WHERE id_history = '$id_history' ";

    $result = $connect->query($sql);

    if ($result) {
        echo json_encode(array(
            "success" => true,
        ));
    } else {
        echo json_encode(array(
            "success" => false,
            "message" => "Gagal",
        ));
    }
}
