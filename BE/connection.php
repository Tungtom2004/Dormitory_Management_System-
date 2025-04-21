<?php

$serverName = "DESKTOP-RRIDB2R\CLCCSDLPTNHOM4";
$database = "Dormitory_Management_System";
$uid = "";
$pass = "";

$connection = [
    "Database" => $database,
    "Uid" => $uid,
    "PWD" => $pass
];

$conn = sqlsrv_connect($serverName, $connection);
if(! $conn){
    die(print_r(sqlsrv_errors(), true));
} 
$tsql = "SELECT * FROM Student";

$stmt = sqlsrv_query($conn, $tsql);
if( $stmt === false ){
    echo("Error");
}
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    echo $obj['StudentID'] . "</br>";
    echo $obj['firstName'] . "</br>";
    echo $obj['middleName'] . "</br>";
    echo $obj['lastName'] . "</br>";
    echo $obj['Date_of_Birth']->format('Y-m-d H:i:s'). "</br>";
    echo $obj['Address']. "</br>";
    echo $obj['Gender']. "</br>";
    echo $obj['phoneNumber']. "</br>";
    echo $obj['EmailAddress']. "</br>";

}
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>
