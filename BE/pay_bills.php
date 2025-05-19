<?php
require_once __DIR__ . '/../dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = ["Database" => "Dormitory_Management_System"];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) die("Kết nối CSDL thất bại");

if (!isset($_POST['bills']) || empty($_POST['bills'])) {
    echo "<script>alert('Vui lòng chọn ít nhất một hóa đơn để thanh toán!'); history.back();</script>";
    exit;
}

$total = 0;
$rows = '';
$studentID = '';
$studentName = ''; 

foreach ($_POST['bills'] as $billID) {
    $sql = "SELECT * FROM bill WHERE Bill_ID = ?";
    $stmt = sqlsrv_query($conn, $sql, [$billID]);
    $bill = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
    if (!$bill) continue;

    $studentID = $bill['StudentID'];
    $total += $bill['Amount_Due'];
    $dueDate = $bill['Due_Date'] instanceof DateTime ? $bill['Due_Date']->format('d/m/Y') : '';

    $rows .= "<tr>
        <td>{$bill['Bill_ID']}</td>
        <td>{$bill['Bill_Type']}</td>
        <td>" . number_format($bill['Amount_Due']) . " VND</td>
        <td>$dueDate</td>
    </tr>";

    sqlsrv_query($conn, "UPDATE bill SET Payment_Status = N'Đã thanh toán' WHERE Bill_ID = ?", [$billID]);
}


if (!empty($studentID)) {
    $stmtStudent = sqlsrv_query($conn, "SELECT firstName, middleName, lastName FROM student WHERE StudentID = ?", [$studentID]);
    if ($row = sqlsrv_fetch_array($stmtStudent, SQLSRV_FETCH_ASSOC)) {
        $studentName = trim("{$row['firstName']} {$row['middleName']} {$row['lastName']}");
    }
}

$html = "
<!DOCTYPE html>
<html>
<head>
  <meta charset='utf-8'>
  <style>
    body { font-family: DejaVu Sans; }
    table { border-collapse: collapse; width: 100%; margin-top: 20px; }
    th, td { border: 1px solid black; padding: 8px; text-align: center; }
    th { background-color: #eee; }
  </style>
</head>
<body>
  <h2 style='text-align:center;'>HÓA ĐƠN THANH TOÁN</h2>
  <p><strong>Mã sinh viên:</strong> $studentID</p>
  <p><strong>Tên sinh viên:</strong> $studentName</p>
  <p><strong>Ngày thanh toán:</strong> " . date('d/m/Y H:i') . "</p>

  <table>
    <thead>
      <tr>
        <th>Mã HĐ</th>
        <th>Loại</th>
        <th>Số tiền</th>
        <th>Hạn</th>
      </tr>
    </thead>
    <tbody>
      $rows
      <tr>
        <td colspan='2'><strong>Tổng cộng</strong></td>
        <td colspan='2'><strong>" . number_format($total) . " VND</strong></td>
      </tr>
    </tbody>
  </table>
</body>
</html>
";

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("hoa_don_{$studentID}.pdf", ["Attachment" => 1]); // 1 = tự tải
?>
