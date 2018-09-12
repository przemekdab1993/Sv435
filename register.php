<?php
	session_start();
	
	function show_error(&$error = '')
	{
		if(strlen($error) != 0)
			{
				echo $error;
			}
	}
?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="utf-8" />
  <meta name="descripcion" content="" />
  <meta name="keywords" content="" />
  <meta http-equiv="X-UA-Compatiable" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="style/style.css" type="text/css" />
  
  <script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>

  <title></title>
</head>

<body>
	<main>
		<div class="form_register_container">
			<div class="form_title">Rejestracja</div>
			<form id="form_2" action="try_register.php" method="POST">
				<label for="user_name">Nazwa użytkownika:</label>
				<input type="text" name="user_name" /><br />
				<span class="red_error">
					<?php show_error($_SESSION['e_user_name']); unset($_SESSION['e_user_name']); ?>
				</span>
				<label for="password_1">Hasło:</label>
				<input type="password" name="password_1" /><br />
				<span class="red_error">
					<?php show_error($_SESSION['e_password_1']); unset($_SESSION['e_password_1']); ?>
				</span>
				<label for="password_2">Powtórz hasło:</label>
				<input type="password" name="password_2" /><br />
				<span class="red_error">
					<?php show_error($_SESSION['e_password_2']); unset($_SESSION['e_password_2']); ?>
				</span>
				<label for="email">Email:</label>
				<input type="text" name="email" /><br />
				<span class="red_error">
					<?php show_error($_SESSION['e_email']); unset($_SESSION['e_email']); ?>
				</span>
				<label><input type="checkbox" name="check_reg" />Akceptuje regulamin</label>
				<span class="red_error">
					<?php show_error($_SESSION['e_check_reg']); unset($_SESSION['e_check_reg']); ?>
				</span>
				<input type="submit" value="Zarejestruj się"/>
			</form>
			<div id="back_home"><a class="link_grey" href="index.php">Anuluj, powróć do strony głównej</a></div>
		</div>
	</main>
	<footer>
		Przemysław Dąbrowski &copy; 2018 v 1.0
	</footer>
	<script type="text/javascript" src="script/function.js"></script>
</body>

</html>
