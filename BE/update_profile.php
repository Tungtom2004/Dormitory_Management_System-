<?php
header("Content-Type: application/json");


$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    echo json_encode([
        "success" => false,
        "message" => "Lỗi kết nối cơ sở dữ liệu!"
    ]);
    exit;
}

$data = json_decode(file_get_contents("php://input"), true);

if (
    empty($data["username"]) ||
    empty($data["fullname"]) ||
    empty($data["gender"]) ||
    empty($data["phonenumber"]) ||
    empty($data["address"]) ||
    empty($data["employeeid"])
) {
    echo json_encode([
        "success" => false,
        "message" => "Vui lòng điền đầy đủ thông tin!"
    ]);
    exit;
}

$sql = "UPDATE Users 
        SET 
            fullname = ?, 
            gender = ?, 
            phonenumber = ?, 
            address = ?, 
            employeeid = ?
        WHERE username = ?";

$params = [
    $data["fullname"],
    $data["gender"],
    $data["phonenumber"],
    $data["address"],
    $data["employeeid"],
    $data["username"]
];

$stmt = sqlsrv_query($conn, $sql, $params);

if ($stmt) {
    echo json_encode([
        "success" => true,
        "message" => "Cập nhật thông tin thành công!"
    ]);
} else {
    echo json_encode([
        "success" => false,
        "message" => "Cập nhật thất bại!",
        "error" => sqlsrv_errors()
    ]);
}
