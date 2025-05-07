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
    die(json_encode(["error" => "Lỗi kết nối cơ sở dữ liệu"]));
}

$keyword = isset($_GET['q']) ? trim($_GET['q']) : '';
$sql = "SELECT * FROM Student WHERE StudentID LIKE ? OR lastName LIKE ?";
$params = ["%$keyword%", "%$keyword%"];
$stmt = sqlsrv_query($conn, $sql, $params);

$data = [];
while($row = sqlsrv_fetch_array($stmt,SQLSRV_FETCH_ASSOC)){
    if (isset($row['Date_of_Birth']) && $row['Date_of_Birth'] instanceof DateTime) {
        $row['Date_of_Birth'] = $row['Date_of_Birth']->format('Y-m-d');
    }
    $data[] = $row;
}
echo json_encode($data);
?>