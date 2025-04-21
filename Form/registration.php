<?php
// Initialize variables to store form data
$first_name = $last_name = $password = $email = $dob = $gender = $city = $description = '';
$success_message = $error_message = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST['first_name'] ?? '';
    $last_name = $_POST['last_name'] ?? '';
    $password = $_POST['password'] ?? '';
    $email = $_POST['email'] ?? '';
    $dob = $_POST['dob'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $city = $_POST['city'] ?? '';
    $description = $_POST['description'] ?? '';

    // Validate form data
    $errors = [];
    if (empty($first_name)) $errors[] = "Họ không được để trống";
    if (empty($last_name)) $errors[] = "Tên không được để trống";
    if (empty($password)) $errors[] = "Mật khẩu không được để trống";
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Email không hợp lệ";
    if (empty($dob)) $errors[] = "Ngày sinh không được để trống";
    if (empty($gender)) $errors[] = "Giới tính không được để trống";
    if (empty($city)) $errors[] = "Thành phố không được để trống";

    // If no errors, save data
    if (empty($errors)) {
        // Create data string
        $data = array(
            'first_name' => $first_name,
            'last_name' => $last_name,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash password
            'email' => $email,
            'dob' => $dob,
            'gender' => $gender,
            'city' => $city,
            'description' => $description,
            'registration_date' => date('Y-m-d H:i:s')
        );
        
        // Convert to JSON
        $json_data = json_encode($data) . "\n";
        
        // Save to file
        if (file_put_contents('users.json', $json_data, FILE_APPEND | LOCK_EX) !== false) {
            $success_message = "Đăng ký thành công!";
            // Clear form data
            $first_name = $last_name = $password = $email = $dob = $gender = $city = $description = '';
        } else {
            $error_message = "Có lỗi xảy ra khi lưu dữ liệu!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký thông tin</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .control-label {
            margin-left: 5px;
            margin-right: 5px;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-title {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn-container .btn {
            margin: 0 5px;
            min-width: 100px;
        }
        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    
        <div class="form-container">
            <h1 class="form-title">Đăng ký thông tin</h1>

            <?php if (!empty($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal">
                <div class="row">
                    <div class="col-sm-6 form-group">
                        <label for="first_name" class="control-label">Họ</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" 
                               value="<?php echo htmlspecialchars($first_name); ?>" placeholder="Nhập họ của bạn">
                    </div>
                    <div class="col-sm-6 form-group">
                        <label for="last_name" class="control-label">Tên</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" 
                               value="<?php echo htmlspecialchars($last_name); ?>" placeholder="Nhập tên của bạn">
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="control-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu của bạn">
                </div>

                <div class="form-group">
                    <label for="email" class="control-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" 
                           value="<?php echo htmlspecialchars($email); ?>" placeholder="Nhập email của bạn">
                </div>

                <div class="row">
                    <div class="col-sm-4 form-group">
                        <label for="dob" class="control-label">Ngày sinh</label>
                        <input type="date" class="form-control" id="dob" name="dob" 
                               value="<?php echo htmlspecialchars($dob); ?>">
                    </div>

                    <div class="col-sm-4 form-group">
                        <label class="control-label">Giới tính</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="Nam" <?php if ($gender === 'Nam') echo 'checked'; ?>>
                                Nam
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="Nữ" <?php if ($gender === 'Nữ') echo 'checked'; ?>>
                                Nữ
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gender" value="Khác" <?php if ($gender === 'Khác') echo 'checked'; ?>>
                                Khác
                            </label>
                        </div>
                    </div>

                    <div class="col-sm-4 form-group">
                        <label for="city" class="control-label">Thành phố</label>
                        <select class="form-control" id="city" name="city">
                            <option value="">--Mời chọn--</option>
                            <option value="Hà Nội" <?php if ($city === 'Hà Nội') echo 'selected'; ?>>Hà Nội</option>
                            <option value="Hồ Chí Minh" <?php if ($city === 'Hồ Chí Minh') echo 'selected'; ?>>Hồ Chí Minh</option>
                            <option value="Đà Nẵng" <?php if ($city === 'Đà Nẵng') echo 'selected'; ?>>Đà Nẵng</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="description" class="control-label">Mô tả bản thân</label>
                    <textarea class="form-control" id="description" name="description" rows="4" 
                              style="resize: none;" placeholder="Nhập mô tả bản thân"><?php echo htmlspecialchars($description); ?></textarea>
                </div>

                <div class="btn-container">
                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                    <button type="reset" class="btn btn-default">Làm lại</button>
                </div>
            </form>
        </div>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html> 