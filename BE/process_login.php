<?php
session_start();
$serverName = "DESKTOP-RRIDB2R\CLCCSDLPTNHOM4";
$connectionOptions = array(
    "Database" => "Dormitory_Management_System",
);

$conn = sqlsrv_connect($serverName, $connectionOptions);

if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$sql = "SELECT * FROM users WHERE username = ? AND password = ?";
$params = array($username, $password);
$stmt = sqlsrv_query($conn, $sql, $params);

if($stmt && sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC)) {
    $_SESSION['username']  = $username;
    header("Location: ../index.html");
    exit();
}
else{
    header("Location: login.php?error=true");
    exit();
}


?>