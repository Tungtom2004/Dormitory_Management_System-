<?php
header("Content-Type: application/json");

$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4"; // hoặc tên SQL Server máy bạn
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

$data = json_decode(file_get_contents("php://input"), true);

// Thêm Location và PersonalID_G để khớp với các cột trong bảng
$sql = "INSERT INTO dormitory (Dormitory_ID, Number_of_Floors, Number_of_Rooms, Overall_Condition, Location, PersonalID_G)
        VALUES (?, ?, ?, ?, ?, ?)";
$params = [
    $data["Dormitory_ID"],
    $data["Number_of_Floors"],
    $data["Number_of_Rooms"],
    $data["Overall_Condition"],
    $data["Location"],
    $data["PersonalID_G"]
];

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt) {
    echo json_encode(["success" => true, "message" => "Thêm tòa nhà thành công!"]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Thêm thất bại",
        "error" => sqlsrv_errors()
    ]);
}
?>
