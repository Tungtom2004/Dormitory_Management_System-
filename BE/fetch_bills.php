
<?php
header('Content-Type: application/json'); 
$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4"; // Sửa theo máy bạn
$connectionOptions = ["Database" => "Dormitory_Management_System"];
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    http_response_code(500);
    echo json_encode(["error" => "Kết nối CSDL thất bại"]);
    exit;
}

$StudentID = $_GET['StudentID'] ?? ''; 

if (empty($StudentID)) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT * FROM bill WHERE StudentID = ? AND Payment_Status = N'Chua thanh toan'";
$stmt = sqlsrv_query($conn, $sql, [$StudentID]);

$bills = [];
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $bills[] = $row;
}

echo json_encode($bills);
?>
