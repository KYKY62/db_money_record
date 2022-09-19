<?php
include '../connection.php';

$name       = $_POST['name'];
$email      = $_POST['email'];
$password   = md5($_POST['password']);
$created_at = $_POST['created_at'];
$update_at = $_POST['update_at'];

$sql_check = "SELECT * FROM user
             WHERE
             email = '$email'
             ";

$result_check = $connect->query($sql_check);

if ($result_check->num_rows > 0) {
    echo json_encode(array(
        "success" => false,
        "message" => "email",
    ));
} else {
    $sql =  "INSERT INTO user
            SET
            name = '$name',
            email = '$email',
            password = '$password',
            created_at = '$created_at',
            update_at = '$update_at'
            ";

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
