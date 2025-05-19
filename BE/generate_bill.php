<?php
$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = ["Database" => "Dormitory_Management_System"];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) die("Kết nối CSDL thất bại");


$monthlyCharges = [
    ["type" => "Tiền phòng", "amount" => 500000],
    ["type" => "Tiền điện", "amount" => 100000],
    ["type" => "Tiền nước", "amount" => 50000],
    ["type" => "Internet",  "amount" => 30000]
];


$month = date('m');
$year = date('Y');
$dueDate = date('Y-m-t'); // ngày cuối tháng hiện tại


$sqlStudents = "SELECT StudentID FROM student";
$stmtStudents = sqlsrv_query($conn, $sqlStudents);

$created = 0;
$skipped = 0;

while ($student = sqlsrv_fetch_array($stmtStudents, SQLSRV_FETCH_ASSOC)) {
    $studentID = $student['StudentID'];

    foreach ($monthlyCharges as $charge) {
        // Kiểm tra xem đã tồn tại hóa đơn của loại này trong tháng chưa
        $check = sqlsrv_query($conn,
            "SELECT 1 FROM bill 
             WHERE StudentID = ? AND Bill_Type = ? AND MONTH(Due_Date) = ? AND YEAR(Due_Date) = ?",
            [$studentID, $charge['type'], $month, $year]
        );

        if (!sqlsrv_has_rows($check)) {
            // Chưa có → thêm mới
            sqlsrv_query($conn,
                "INSERT INTO bill (StudentID, Bill_Type, Amount_Due, Due_Date, Payment_Status)
                 VALUES (?, ?, ?, ?, N'Chưa thanh toán')",
                [$studentID, $charge['type'], $charge['amount'], $dueDate]
            );
            $created++;
        } else {
            $skipped++;
        }
    }
}

echo "<h3>Tạo hóa đơn thành công!</h3>";
echo "<p>Hóa đơn mới tạo: $created</p>";
echo "<p>Hóa đơn đã tồn tại (bỏ qua): $skipped</p>";
?>
