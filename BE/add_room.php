<?php
header("Content-Type: application/json");
$input = json_decode(file_get_contents("php://input"), true);

if ((int)$input["number_of_Students"] > (int)$input["Capacity"]) {
    echo json_encode([
        "success" => false,
        "message" => " Số sinh viên vượt quá sức chứa cho phép"
    ]);
    exit;
}



$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

$sql = "INSERT INTO Room (Room_ID, number_of_Students, Size_of_room, Capacity, Gender, Dormitory_ID) 
        VALUES (?, ?, ?, ?, ?, ?)";

$params = [
    $input["Room_ID"],
    $input["number_of_Students"],
    $input["Size_of_room"],
    $input["Capacity"],
    $input["Gender"],
    $input["Dormitory_ID"]
];

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    echo json_encode(["success" => true, "message" => "Thêm phòng thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Thêm phòng thất bại", "error" => sqlsrv_errors()]);
}
