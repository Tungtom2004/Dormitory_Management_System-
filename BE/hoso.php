<?php
session_start();
$username = $_SESSION['username'] ?? '';

$serverName = "DESKTOP-RRIDB2R\\CLCCSDLPTNHOM4";
$connectionOptions = array("Database" => "Dormitory_Management_System");
$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn || !$username) {
    die("Lỗi kết nối hoặc chưa đăng nhập.");
}

$sql = "SELECT * FROM Users WHERE username = ?";
$stmt = sqlsrv_query($conn, $sql, [$username]);
$user = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hồ sơ người dùng</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <script>
    function toggleEdit() {
      const button = document.getElementById("editButton");
      const saveGroup = document.getElementById("saveGroup");
      const fields = ["employeeid", "name", "gender", "phone", "address"];

      fields.forEach(id => {
        const el = document.getElementById(id);
        const value = el.textContent;
        const input = document.createElement("input");
        input.value = value;
        input.className = "w-full border px-2 py-1 rounded";
        el.innerHTML = "";
        el.appendChild(input);
      });

      button.classList.add("hidden");
      saveGroup.classList.remove("hidden");
    }

    function cancelEdit() {
      location.reload();
    }

    function saveEdit() {
      const data = {
        username: "<?= $username ?>",
        employeeid: document.querySelector("#employeeid input").value,
        fullname: document.querySelector("#name input").value,
        gender: document.querySelector("#gender input").value,
        phonenumber: document.querySelector("#phone input").value,
        address: document.querySelector("#address input").value
      };

      fetch("../BE/update_profile.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data)
      })
        .then(res => res.json())
        .then(res => {
          alert(res.message);
          if (res.success) location.reload();
        })
        .catch(err => {
          alert("Lỗi khi cập nhật thông tin!");
          console.error(err);
        });
    }
  </script>
</head>

<body class="bg-gradient-to-br from-blue-50 to-blue-100 min-h-screen flex items-center justify-center p-4">
  <div class="bg-white rounded-2xl shadow-xl p-8 w-full max-w-3xl">
    <div class="flex items-center justify-between mb-6">
      <h1 class="text-3xl font-bold text-blue-700">👤 Hồ sơ cá nhân</h1>
      <button id="editButton" onclick="toggleEdit()" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
        ✏️ Chỉnh sửa hồ sơ
      </button>
      <div id="saveGroup" class="hidden space-x-2">
        <button onclick="saveEdit()" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-4 py-2 rounded-lg shadow">
          💾 Lưu
        </button>
        <button onclick="cancelEdit()" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold px-4 py-2 rounded-lg shadow">
          ❌ Hủy
        </button>
      </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-800">
      <div>
        <p class="font-medium text-gray-500">📄 Mã nhân viên</p>
        <p id="employeeid" class="text-lg font-semibold"><?= htmlspecialchars($user['employeeid'] ?? '') ?></p>
      </div>
      <div>
        <p class="font-medium text-gray-500">👤 Họ tên</p>
        <p id="name" class="text-lg font-semibold"><?= htmlspecialchars($user['fullname'] ?? '') ?></p>
      </div>
      <div>
        <p class="font-medium text-gray-500">⚧️ Giới tính</p>
        <p id="gender" class="text-lg font-semibold"><?= htmlspecialchars($user['gender'] ?? '') ?></p>
      </div>
      <div>
        <p class="font-medium text-gray-500">📞 Số điện thoại</p>
        <p id="phone" class="text-lg font-semibold"><?= htmlspecialchars($user['phonenumber'] ?? '') ?></p>
      </div>
      <div class="md:col-span-2">
        <p class="font-medium text-gray-500">🏠 Địa chỉ</p>
        <p id="address" class="text-lg font-semibold"><?= htmlspecialchars($user['address'] ?? '') ?></p>
      </div>
      <div class="md:col-span-2">
        <p class="font-medium text-gray-500">📅 Ngày đăng ký gần nhất</p>
        <p class="text-lg font-semibold">13/04/2025</p>
      </div>
      <div class="md:col-span-2 text-center mt-4">
        <a href="../index.html" class="inline-block bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-lg shadow">
          🔙 Quay lại trang chủ
        </a>
      </div>
    </div>
  </div>
</body>
</html>
