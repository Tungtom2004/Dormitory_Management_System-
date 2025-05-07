<?php
header("Content-Type: application/json");

$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(json_encode(["error" => "Lỗi kết nối CSDL"]));
}

$q = isset($_GET['q']) ? trim($_GET['q']) : '';

if ($q === '') {
    $sql = "SELECT * FROM Dormitory";
    $params = [];
} 
else {
    $sql = "SELECT * FROM Dormitory WHERE UPPER(Dormitory_ID) LIKE UPPER(?)";
    $params = ["%$q%"];
}

$stmt = sqlsrv_query($conn, $sql, $params);

$data = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $data[] = $row;
}

echo json_encode($data);
?>
