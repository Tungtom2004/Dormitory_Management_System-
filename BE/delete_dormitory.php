<?php
header("Content-Type: application/json");
$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

$data = json_decode(file_get_contents("php://input"), true);
$sql = "DELETE FROM dormitory WHERE Dormitory_ID = ?";
$params = [$data["Dormitory_ID"]];

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt) {
    echo json_encode(["success" => true, "message" => "Xóa thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Xóa thất bại", "error" => sqlsrv_errors()]);
}
?>
