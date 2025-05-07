<?php
header("Content-Type: application/json");

$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) {
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

$data = json_decode(file_get_contents("php://input"), true);

$sql = "UPDATE Student SET 
    firstName = ?, 
    middleName = ?, 
    lastName = ?, 
    Date_of_Birth = ?, 
    Address = ?, 
    Gender = ?, 
    phoneNumber = ?, 
    EmailAddress = ?
    WHERE StudentID = ?";

$params = [
    $data["firstName"],
    $data["middleName"],
    $data["lastName"],
    $data["Date_of_Birth"],
    $data["Address"],
    $data["Gender"],
    $data["phoneNumber"],
    $data["EmailAddress"],
    $data["StudentID"]
];

$stmt = sqlsrv_query($conn, $sql, $params);
if($stmt){
    echo json_encode(["success" => true, "message" => "Cập nhật thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Cập nhật thất bại!", "error" => sqlsrv_errors()]);
}
?>
