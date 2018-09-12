<?php
	session_start();
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
		
			<div class="top_bar">
				<?php 
					if(isset($_SESSION['loged']))
					{
						echo "Jesteś zalogowany jako: ".$_SESSION['user_name'];
					echo '<a href="logout.php">[ wyloguj się ]</a>';
					}
					else
					{
						echo "Nie jesteś zalogowany";
						echo '<button id="log_set">zaloguj</button>';
					}
				?>
			</div>
			<main>
				<div class="main_container">
					<section>
						<?php
							if(isset($_SESSION['loged']))
							{
								echo '<h2>Witaj '.$_SESSION['user_name'].'</h2>';
								echo '<p>Niestety nie ma tu nic szczeglnie fajnego nawet po zalogowani.</p>';
							}
							else
							{
								echo '<h2>Witaj</h2>';
								echo '<p>Jeeśli chcesz zobaczyć główną zawartość strony musisz się zalogować.';
							}
						?>
					</section>
				</div>
			</main>
			
		</div>
	</main>
	<footer>
		Przemysław Dąbrowski &copy; 2018 v 1.0
	</footer>
	
	<div class="backgrand_alert">
		<div class="form_login_container">
			<div id="exit">
				<a href="index.php">[zamknij]</a>
			</div>
			<div class="form_title">Logowanie</div>
			<form id="form_1" action="login.php" method="POST">
				<label for="user_name">Nazwa użytkownika:</label>
				<input type="text" name="user_name" /><br />
				<label for="password">Hasło:</label>
				<input type="password" name="password" /><br />
				<span class="red_error">
					<?php 
						if (isset($_SESSION['error_l']))
						{
							echo $_SESSION['error_l'];
						}
					?>
				</span>
				<input type="submit" value="Zaloguj się"/>
			</form>
			Jeśli nie posiadasz konta, kliknij <a href="register.php">rejestracja</a>
		</div>
	</div>
	
	<script type="text/javascript" src="script/function.js"></script>
	<?php
		if(isset($_SESSION['error_l']))
		{
			echo '<script>$(function(){show_login();});</script>';
			unset($_SESSION['error_l']);
		}
	?>
</body>

</html>
