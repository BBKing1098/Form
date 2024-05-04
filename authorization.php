<?php

//form data
$login = $_REQUEST['username'];
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


$sql = "SELECT username, password, salt FROM users WHERE username = '$login' LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($result->num_rows == 1) {
    $row_arr = mysqli_fetch_array($result);
    $check_password = $pswd . $row_arr['salt'];

    $isPasswordCorrect = password_verify($check_password, $row_arr['password']);
    if ($isPasswordCorrect) {
	    setcookie('authorization_user', $login, time()+3600, 'personal_account.php');
	    mysqli_close($conn);
	    header("Location: personal_account.php");
            exit;
    } 
    else {
        mysqli_close($conn);
	header("Location: /");
        exit;
    }
    
}
else {
    mysqli_close($conn);
    header("Location: /");
    exit;
}
?>
