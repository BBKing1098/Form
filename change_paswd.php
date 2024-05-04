<?php 
$login = $_REQUEST['login'];
$pswd  = $_REQUEST['password'];


//errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//db_data
$servername = "localhost";
$database = "registered_users";
$username = "admin";
$password = "H6Bx8t7tB4";


//con_db
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$sql = "SELECT salt FROM users WHERE username = '$login' LIMIT 1";
$result = mysqli_query($conn, $sql);
$row_arr = mysqli_fetch_array($result);


$change_pswd = $pswd . $row_arr['salt'];
$hashedPassword = password_hash($change_pswd, PASSWORD_BCRYPT);


$sql = "UPDATE users SET password='$hashedPassword' WHERE username = '$login';";
mysqli_query($conn, $sql);
mysqli_close($conn);


header("Location: /");
exit;
?>
