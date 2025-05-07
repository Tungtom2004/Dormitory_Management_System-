<?php
header("Content-Type: application/json");
$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$sql = "UPDATE dormitory SET 
    Location = ?, 
    Number_of_Floors = ?, 
    Number_of_Rooms = ?, 
    Overall_Condition = ?, 
    PersonalID_G = ?
    WHERE Dormitory_ID = ?";

$params = [
    $data["Location"],
    $data["Number_of_Floors"],
    $data["Number_of_Rooms"],
    $data["Overall_Condition"],
    $data["PersonalID_G"],
    $data["Dormitory_ID"]
];

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt) {
    echo json_encode(["success" => true, "message" => "Cập nhật thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Cập nhật thất bại", "error" => sqlsrv_errors()]);
}
?>
