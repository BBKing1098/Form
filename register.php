<?php 

//form data
$email = $_REQUEST['email'];
$login = $_REQUEST['username'];
$password = $_REQUEST['password'];

//errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//generate salt
$salt = bin2hex(random_bytes(17));
$salt_paswd = $password . $salt;
$hashedPassword = password_hash($salt_paswd, PASSWORD_BCRYPT);


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

$result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$login' LIMIT 1");
if($result->num_rows == 1) {
    mysqli_close($conn);

}

else {
    $sql = "INSERT INTO users (email, username, password, salt) VALUES ('$email', '$login', '$hashedPassword', '$salt')";
    mysqli_query($conn, $sql);


    mysqli_close($conn);
}

header("Location: /");
exit;
?>
