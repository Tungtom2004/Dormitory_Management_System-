<?php
$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = ["Database" => "Dormitory_Management_System"];
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die("Lỗi kết nối CSDL");
}

// Lấy dữ liệu từ form
$studentID = $_POST['StudentID'];
$firstName = $_POST['firstName'];
$middleName = $_POST['middleName'];
$lastName = $_POST['lastName'];
$Gender = $_POST['Gender'];
$phoneNumber = $_POST['phoneNumber'];
$roomID = $_POST['Room_ID'];
$regDate = $_POST['regDate'];
$PersonalID_DM = $_POST['PersonalID_DM']; 

// Kiểm tra phòng có tồn tại
$check = "SELECT number_of_Students, Capacity FROM room WHERE Room_ID = ?";
$stmt = sqlsrv_query($conn, $check, [$roomID]);
$row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);

if (!$row) {
    echo "<script>alert('Không tìm thấy thông tin phòng.');window.history.back();</script>";
    exit;
}

// Kiểm tra số lượng sinh viên vượt quá
if ($row['number_of_Students'] >= $row['Capacity']) {
    echo "<script>alert('Phòng đã đầy, không thể đăng ký thêm!');window.history.back();</script>";
    exit;
}

// Kiểm tra sinh viên đã tồn tại chưa
$checkStudent = sqlsrv_query($conn, "SELECT * FROM student WHERE StudentID = ?", [$studentID]);
if (!sqlsrv_fetch_array($checkStudent)) {
    $insertStudent = "INSERT INTO student (StudentID, firstName, middleName, lastName, Gender, phoneNumber)
                      VALUES (?, ?, ?, ?, ?, ?)";
    sqlsrv_query($conn, $insertStudent, [$studentID, $firstName, $middleName, $lastName, $Gender, $phoneNumber]);
}

// Ghi vào bảng live
$insertLive = "INSERT INTO live (StudentID, Room_ID, PersonalID_DM) VALUES (?, ?, ?)";
$liveResult = sqlsrv_query($conn, $insertLive, [$studentID, $roomID, $PersonalID_DM]);

if (!$liveResult) {
    die("Lỗi khi chèn vào bảng live: " . print_r(sqlsrv_errors(), true));
}


// Cập nhật số sinh viên trong phòng
$updateRoom = "UPDATE room SET number_of_Students = number_of_Students + 1 WHERE Room_ID = ?";
sqlsrv_query($conn, $updateRoom, [$roomID]);

echo "<script>alert('Đăng ký thành công!');window.location.href='../index.html';</script>";
?>
