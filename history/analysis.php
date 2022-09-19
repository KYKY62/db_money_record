<?php
include "../connection.php";

$id_user = $_POST['id_user'];
$today = new DateTime($_POST['today']);
$this_month = $today->format('Y-m'); // 2022-06

$day7 = $today->format('Y-m-d');
$day6 = date_sub($today, new DateInterval('P1D'))->format('Y-m-d');
$day5 = date_sub($today, new DateInterval('P1D'))->format('Y-m-d');
$day4 = date_sub($today, new DateInterval('P1D'))->format('Y-m-d');
$day3 = date_sub($today, new DateInterval('P1D'))->format('Y-m-d');
$day2 = date_sub($today, new DateInterval('P1D'))->format('Y-m-d');
$day1 = date_sub($today, new DateInterval('P1D'))->format('Y-m-d');
$week = array($day1, $day2, $day3, $day4, $day5, $day6, $day7);

$weekly = array(0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0);
$month_income = 0.0;
$month_outcome = 0.0;

$sql_month = "SELECT * FROM history
        WHERE
        id_user='$id_user' AND date LIKE '%$this_month%'
        ORDER BY date DESC
        ";
$result_month = $connect->query($sql_month);

if ($result_month->num_rows > 0) {
    while ($row_month = $result_month->fetch_assoc()) {
        $type = $row_month["type"]; // Pemasukan / Pengeluaran        
        if ($type == "Pemasukan") {
            $month_income += floatval($row_month['total']);
        } else {
            $month_outcome += floatval($row_month['total']);
        }
    }
}

$sql_week = "SELECT * FROM history
        WHERE
        id_user='$id_user' AND date >= '%$day1%'
        ORDER BY date DESC
        ";
$result_week = $connect->query($sql_week);

if ($result_week->num_rows > 0) {
    while ($row_week = $result_week->fetch_assoc()) {
        $type = $row_week["type"]; // Pemasukan / Pengeluaran
        $date = $row_week["date"];
        if ($type == "Pengeluaran") {
            for ($i = 0; $i < count($week); $i++) {
                if ($date == $week[$i]) {
                    $weekly[$i] = floatval($row_week['total']);
                }
            }
        }
    }
}

echo json_encode(array(
    "today" => $weekly[6],
    "yesterday" => $weekly[5],
    "week" => $weekly,
    "month" => array(
        "income" => $month_income,
        "outcome" => $month_outcome
    ),
));
