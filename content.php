<?php  

	session_start();

	if (!$_SESSION['email']) {
		header("Location: index.php");
		die();
	}

	if ($_POST['unlogin']) {
		session_destroy();
		header("Location: index.php");
	}

	if (count($_POST) > 0) {
		header('location: index.php');
	}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style>
		body {
			background: #fcfcfc;
		}
		.client-data {
			max-width: 600px;
			font-size: 18px;
			margin: 5px auto;
			margin-bottom: 10px;
		}
		form {
			width: 600px;
			margin: 0 auto;
			margin-top: 30px;
		}
		input[name="unlogin"] {
			max-width: 100%;
			padding: 10px 20px;
			display: block;
			cursor: pointer;
		}
	</style>
</head>
<body>
	
	<p class="client-data"><? echo "Привет: " . "<strong>" . $_SESSION['name'] . "</strong>" . ", Ваша карточка уже существует!"; ?></p>
	<p class="client-data"><? echo "Ваш e-mail: " .  "<strong>" . $_SESSION['email'] . "</strong>"; ?></p>
	<p class="client-data"><? echo "Ваши данные: " .  "<strong>" . $_SESSION['district_list'] . "</strong>"; ?></p>

	<form action="" method="post">
		<input type="submit" name="unlogin" value="НА СТРАНИЦУ АВТОРИЗАЦИИ">
	</form>
</body>
</html>