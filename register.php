<?php
	session_start();
	
	function show_text(&$error = '')
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
  <meta http-equiv="X-UA-Compatiable" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="style/style.css" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Mouse+Memoirs|Open+Sans|Oxygen|Sriracha" rel="stylesheet">
  
  <script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>

  <title>Rejestracja</title>
</head>

<body>
	<main>
		<div class="form_register_container">
			<div class="form_title">Rejestracja</div>
			<form id="form_2" action="try_register.php" method="POST">
				<label for="user_name">Nazwa użytkownika:</label>
				<input type="text" name="user_name" value="<?php show_text($_SESSION['re_user_name']); unset($_SESSION['re_user_name']); ?>" /><br />
				<span class="red_error">
					<?php show_text($_SESSION['e_user_name']); unset($_SESSION['e_user_name']); ?>
				</span>
				<label for="password_1">Hasło:</label>
				<input type="password" name="password_1" /><br />
				<span class="red_error">
					<?php show_text($_SESSION['e_password_1']); unset($_SESSION['e_password_1']); ?>
				</span>
				<label for="password_2">Powtórz hasło:</label>
				<input type="password" name="password_2" /><br />
				<span class="red_error">
					<?php show_text($_SESSION['e_password_2']); unset($_SESSION['e_password_2']); ?>
				</span>
				<label for="email">Email:</label>
				<input type="text" name="email" value="<?php show_text($_SESSION['re_email']); unset($_SESSION['re_email']); ?>" /><br />
				<span class="red_error">
					<?php show_text($_SESSION['e_email']); unset($_SESSION['e_email']); ?>
				</span>
				<label><input type="checkbox" name="check_reg" />Akceptuje regulamin</label><br />
				<span class="red_error">
					<?php show_text($_SESSION['e_check_reg']); unset($_SESSION['e_check_reg']); ?>
				</span>
				<input type="submit" value="Zarejestruj się"/>
			</form>
			<div id="back_home"><a class="link_grey" href="index.php">Anuluj, powróć do strony głównej</a></div>
		</div>
	</main>
	<footer>
		Przemysław Dąbrowski &copy; 2018 v 1.4
	</footer>
	<script type="text/javascript" src="script/function_register.js"></script>
</body>

</html>
