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

$data = json_decode(file_get_contents("php://input"), true);
$studentID = $data["StudentID"];

$sql = "DELETE FROM Student WHERE StudentID = ?";
$params = [$studentID];

$stmt = sqlsrv_query($conn, $sql, $params);
if($stmt){
    echo json_encode(["success" => true, "message" => "Xóa sinh viên thành công!"]);
} else {
    echo json_encode(["success" => false, "message" => "Xóa thất bại!", "error" => sqlsrv_errors()]);
}
?>
