<?php
header("Content-Type: application/json");

$serverName = "DESKTOP-RRIDB2R\CLCCSDLPTNHOM4";
$uid = "";
$pass = "";

$connectionOptions = array(
    "Database" => "Dormitory_Management_System",
    "Uid" => $uid,
    "PWD" => $pass
);
$conn = sqlsrv_connect($serverName, $connectionOptions);
if(!$conn){
    die(json_encode(["success" => false, "message" => "Lỗi kết nối CSDL"]));
}

// Lấy dữ liệu từ client gửi đến
$data = json_decode(file_get_contents("php://input"), true);

$sql = "INSERT INTO Student 
(StudentID, firstName, middleName, lastName, Date_of_Birth, Address, Gender, phoneNumber, EmailAddress)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

$params = [
    $data["StudentID"],
    $data["firstName"],
    $data["middleName"],
    $data["lastName"],
    $data["Date_of_Birth"],
    $data["Address"],
    $data["Gender"],
    $data["phoneNumber"],
    $data["EmailAddress"]
];

$stmt = sqlsrv_query($conn, $sql, $params);
if($stmt){
    echo json_encode(["success" => true, "message" => "Thêm sinh viên thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Thêm thất bại!", "error" => sqlsrv_errors()]);
}
?>
