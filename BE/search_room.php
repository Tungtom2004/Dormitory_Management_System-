<?php
header("Content-Type: application/json");

$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4"; // sửa nếu khác
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
    $sql = "SELECT * FROM Room";
    $params = [];
} else {
    $sql = "SELECT * FROM Room WHERE UPPER(Room_ID) LIKE UPPER(?)";
    $params = ["%$q%"];
}

$stmt = sqlsrv_query($conn, $sql, $params);
$data = [];

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

echo json_encode($data);
