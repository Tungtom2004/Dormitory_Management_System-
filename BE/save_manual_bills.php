<?php
$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = ["Database" => "Dormitory_Management_System"];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) die("Kết nối CSDL thất bại");

function generateNextBillID($conn) {
    $sql = "SELECT TOP 1 Bill_ID FROM bill ORDER BY Bill_ID DESC";
    $stmt = sqlsrv_query($conn, $sql);
    $latestID = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)['Bill_ID'] ?? 'B000';

    // Tách số từ B001 → 1
    $number = (int)substr($latestID, 1);
    $newNumber = $number + 1;
    return 'B' . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // B016
}

$count = 0;

if (!empty($_POST['Bill_Type'])) {
  for ($i = 0; $i < count($_POST['Bill_Type']); $i++) {
    $newID = generateNextBillID($conn);

    $sql = "INSERT INTO bill (Bill_ID, Bill_Type, Amount_Due, Due_Date, Payment_Status, StudentID, PersonalID_O)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $params = [
      $newID,
      $_POST['Bill_Type'][$i],
      $_POST['Amount_Due'][$i],
      $_POST['Due_Date'][$i],
      $_POST['Payment_Status'][$i],
      $_POST['StudentID'][$i],
      $_POST['PersonalID_O'][$i],
    ];

    sqlsrv_query($conn, $sql, $params);
    $count++;
  }
}

echo "<h2>✅ Đã thêm $count hóa đơn thành công!</h2>";
echo "<a href='../genbill.html'>⬅ Quay lại</a>";
?>
