<?php
if(!isset($_COOKIE['authorization_user'])) {
    header("Location: /");
    exit;
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="utf8">
    <title>Панель керування</title>

</head>
<body>
    
    <h1>Панель керування</h1>
    <form action="change_paswd.php" method="post">
	<label for="mail">Новий пароль</label>
	<input type="hidden" name='login' value=<?php echo $_COOKIE['authorization_user'];?>>
        <input type="password" name="password" value="" id="paswd" required><br>
	<br>
        <input type="submit" value="Змінити пароль">
    </form>

</body>
</html>
