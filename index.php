<?php
	session_start();
 ?>
<!DOCTYPE html>
<html lang="pl">

<head>
  <meta charset="utf-8" />
  <meta name="descripcion" content="Strona internetowa do podania o prace jako Junior Webmaster" />
  <meta name="keywords" content="podaanie_o_prace, webmaster, webdeweloper, prosty_projekt" />
  <meta http-equiv="X-UA-Compatiable" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link rel="stylesheet" href="style/style.css" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Mouse+Memoirs|Open+Sans|Oxygen|Sriracha" rel="stylesheet">
  
  <script type="text/javascript" src="script/jquery-3.3.1.min.js"></script>

  <title>Start</title>
</head>

<body>
	<main>
		<div class="top_bar">
			<?php 
				// Pasek stanu zalogowania użytkownika
				// znienna $_SESSION['loged'] informuje czy ktoś jest zalogowany
				if(isset($_SESSION['loged']))
				{	
					// Jeśli użytkownik jest zalogowany 
					// ustawia zawartość top_bar
					echo "Jesteś zalogowany jako: ".$_SESSION['user_name'];
					echo '<a href="logout.php" >[ wyloguj się ]</a>';
				}
				else
				{
					// Jeśli użytkownik nie jest zalogowany 
					// ustawia zawartość top_bar
					echo " Jesteś nie zalogowany ";
					echo '<button id="log_set">Zaloguj się</button>';
				}
			?>
		</div>
		<div class="main_container">
			<section>
				<?php
					if(isset($_SESSION['loged']))
					{
						// Jeśli użytkownik jest zalogowany 
						// ustawia zawartość top_bar
						echo '<div class="title_1">Witaj '.$_SESSION['user_name'].'</div>';
						echo '<p>Nic tej stronie nie brakuje. Może jedynie twórcy tej strony przydało by się troszkę doświadczenia w komercyjnym tworzeniu stron internetowych. Bardzo się stara się by ktoś uwierzył w niego, tak jak on sam wierzy że w przysłości będzie bardzo dobrym  WebMaster.</p>';
						echo '<div class="quote">Wszystko, czego się dotąd nauczyłeś, zatraci sens, jeśli nie potrafisz znaleźć zastosowania dla tej wiedzy.<br /><span class="quote_span">Paulo Coelho</span></div>';
					 	echo '<div class="quote">Wszystka wiedza pochodzi z doświadczenia. Doświadczenie jest produktem rozumu.<br /><span class="quote_span">Immanuel Kant</span></div>';
					}
					else
					{
						// Jeśli użytkownik nie jest zalogowany 
						// ustawia zawartość top_bar
						echo '<div class="title_1">Witaj</div>';
						echo '<p>Jeśli chcesz zobaczyć zawartość strony proszę o zalogowanie się.';
					}
				?>
			</section>
		</div>
	</main>
	<footer>
		<a href="https://przemekdab1993.github.io/Portfolio/" class="link_black">Przemysław Dąbrowski</a> &copy; 2018 v1.3
	</footer>
	
	<div class="black_back">
		<div class="form_login_container">
			<div id="exit">
				<a href="index.php" class="link_grey">[zamknij]</a>
			</div>
			<div class="form_title">Logowanie</div>
			<form id="form_1" action="login.php" method="POST">
				<label for="user_name">Nazwa użytkownika:</label>
				<input type="text" name="user_name" value="<?php if (isset($_SESSION['re_login_user_name'])) echo $_SESSION['re_login_user_name']; ?>"/><br />
				<label for="password">Hasło:</label>
				<input type="password" name="password" /><br />
				<span class="red_error">
					<?php 
						// komunikat wyświetlany przy niepowodzeniu logowania
						if (isset($_SESSION['error_l']))
						{
							echo $_SESSION['error_l'];
						}
					?>
				</span>
				<input type="submit" value="Zaloguj się"/>
			</form>
			Jeśli masz jeszcze konta, kliknij <a href="register.php">rejestracja</a>
		</div>
	</div>
	<script type="text/javascript" src="script/function_index.js"></script>
	<?php
		if(isset($_SESSION['error_l']))
		{
			echo '<script>$(function(){show_login();});</script>';
			unset($_SESSION['error_l']);
			unset($_SESSION['re_login_user_name']);
		}
	?>

	<?php	
		// Komunikat wyświetlany użytkownikowi przy:
		// -wylogowaniu
		// -aktywacji konta
		// -poprawnej rejestracji nowego użytkownika
		if(isset($_SESSION['alert']))
		{
			$text_alert = $_SESSION['alert'];
echo <<<ECHOEND
	<div class="alert">
		<div class="alert_container">
			$text_alert
		</div>
	</div>
ECHOEND;
			unset($_SESSION['alert']);
		}
	?>
</body>

</html>
