<?php
// Kiểm tra xem dữ liệu có được gửi bằng phương thức POST không
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ form
    $lastname = $_POST['lastname'] ?? '';
    $firstname = $_POST['firstname'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $description = $_POST['description'] ?? '';

    // Kiểm tra các điều kiện đơn giản (ví dụ: password phải >= 6 ký tự)
    if (strlen($password) < 6) {
        $params = http_build_query($_POST) . '&error=' . urlencode('Mật khẩu phải có ít nhất 6 ký tự');
        header("Location: index.html?$params");
        exit();
    }

    // Chuẩn bị dữ liệu ghi vào file
    $data = "Họ tên: $lastname $firstname\n"
          . "Email: $email\n"
          . "Mật khẩu: $password\n"
          . "Ngày sinh: $birthdate\n"
          . "Giới tính: $gender\n"
          . "Thành phố: $city\n"
          . "Mô tả: $description\n"
          . "------------------------\n";

    // Ghi dữ liệu vào file check.txt
    $file = 'check.txt';
    file_put_contents($file, $data, FILE_APPEND);

    // Redirect về lại form với thông báo thành công
    header("Location: register.html?success=1");
    exit();
}
?>
