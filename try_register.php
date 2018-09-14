<?php
	require "connect.php";
	
	session_start();
	
	// Funkcja wysyłająca email z linkiem aktywacyjnym //
	// pobiera nazwe użytkownika oraz jego adres email
	// zwraca TRUE kiedy uda się wysłać email, FALSE jeśli się nie uda
	//	wykorzystuje biblioteke PHPMailer 'https://github.com/PHPMailer/PHPMailer.git'
	function setEmailRegister($user_email, $key, $user_name)
	{
		require "connect.php";
		require_once "PHPMailer/PHPMailerAutoload.php";
		
		// Zawartość wysyłanej wiadomości 
		$body = 'Aby aktywować nowo utworzone konto nalerzy kliknąć koniższy link.<br />';
		$body .= '<a href="' . $link_f . '/' . $ws_name . '/active_user.php?user=' . $user_name . '&key=' . $key . '" target="_blank">link</a>';
		
		$mail = new PHPMailer;
		# $mail->isSMTP();
		
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "tls";
		
		$mail->Username = "iniesta.regist@gmail.com";
		$mail->Password = "frytki123";
		
		$mail->setFrom("iniesta.regist@gmail.com", "Link aktywacyjny");
		$mail->addAddress($user_email);
		$mail->addReplyTo("iniesta.regist@gmail.com");
		
		$mail->CharSet = 'UTF-8';
		$mail->isHTML(true);
		$mail->Subject = "Witam nowy użytkowniku";
		$mail->Body = $body;
		
		return $mail->send();
	}
	
	// SPRAWDZANIE CZY FORMLARZ ZOSTAŁ WYSŁANY //
	if(!isset($_POST['user_name']))
	{
		header('Location: register.php');
		exit();
	}
	
	// Pobranie zmiennych przesłanych metodą POST 
	$user_name = $_POST['user_name'];
	$password_1 = $_POST['password_1'];
	$password_2 = $_POST['password_2'];
	$email = $_POST['email'];
	
	$flag_vali = true;	//zmienna walidacyjna 
	
	// WALIDACJA DANYCH FORMULARZA //
	// Walidacja user_name
	if(strlen($user_name) < 4 || strlen($user_name) > 32)
	{
		$flag_vali = false;
		$_SESSION['e_user_name'] = "Nazwa urzytkownika powinna składać się od 4 do 32 znaków";
	} 
	else
	{
		if(!ctype_alnum($user_name))
		{
			$flag_vali = false;
			$_SESSION['e_user_name'] = "Nazwa użytkownika może składać się tylko ze liter i liczb( bez znaków narodowych)";
		}
	}
	
	// Walidacja password_1 i password_2
	if(strlen($password_1) < 6 || strlen($password_1) > 32)
	{
		$flag_vali = false;
		$_SESSION['e_password_1'] = "Hasło powinno składać się od 6 do 32 znaków";
	}
	else
	{
		if(ctype_alnum($password_1) == false)
		{
			$flag_vali = false;
			$_SESSION['e_password_1'] = "Hasło może składać się tylko ze liter i liczb( bez znaków narodowych)";
		}
	}
	if($password_1 != $password_2)
	{
		$flag_vali = false;
		$_SESSION['e_password_2'] = "Hasło wpisane w dwóch polach powinno być identyczne";
	}
	
	// Walidacja email
	if(strlen($email) < 6 || strlen($password_1) > 64)
	{
		$flag_vali = false;
		$_SESSION['e_email'] = "Nieprawidłowy adres email";
	}
	$emailS = filter_var($email, FILTER_SANITIZE_EMAIL);
	if((filter_var($emailS, FILTER_VALIDATE_EMAIL) == false) || ($email != $emailS))
	{
		$flag_vali = false;
		$_SESSION['e_email'] = "Niepoprawny adres email";
	}
	
	// walidacja check_reg (akceptacji reglaminu)
	if(!isset($_POST['check_reg']))
	{
		$flag_vali = false;
		$_SESSION['e_check_reg'] = "Nie zaakceptowałeś regulaminu!";
	}
	
	try
	{
		// ŁĄCZENIE Z BAZĄ DANYCH //
		$connect = new mysqli($host, $db_user, $db_password, $db_name);
		
		if($connect->connect_errno != 0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			// SPRAWDZANIE CZY NAZWA UŻYTKOWNIKA ORAZ EMAIL NIE SĄ JUŻ WYKORZYSTYWANE //
			// Sprawdzanie user_name
			$_SQL1 = "SELECT id_user FROM user WHERE user_name = '%s'";
				
			if($res1 = $connect->query(sprintf($_SQL1, mysqli_real_escape_string($connect, $user_name))))
			{
				$num_user = $res1->num_rows;
				if ($num_user > 0)
				{	
					$flag_vali = false;
					$_SESSION['e_user_name'] = "Istnieje już użytkownik o podanym nazwie";
				}
				$res1->close();
			}
			else 
			{
				throw new Exception("BŁĄD zapytania do bazy".$connect->error());
			}
			
			//Sprawdzanie email
			$_SQL2 = "SELECT id_user FROM user WHERE email = '%s'";
			
			if($res2 = $connect->query(sprintf($_SQL2, mysqli_real_escape_string($connect, $email))))
			{
				$num_user = $res2->num_rows;
				if ($num_user > 0)
				{	
					$flag_vali = false;
					$_SESSION['e_email'] = "Podany email już wykorzystywany przez innego użytkownika.";
					$res2->close();
				}
			}
			
			
			// TWORZENIE NOWEGO UZYTKOWNIKA GDY WALIDACJA PRZEBIEGNIE POMYŚLNIE //
			if($flag_vali == true)
			{
				$password_hash = password_hash($password_1, PASSWORD_DEFAULT);	//hashowanie hasła
				$activation_key = md5(rand().time()); // Generowanie 32-bajtowego klucza aktywacyjnego 
				
				$_SQL3 = "INSERT INTO user (user_name, password, email, activation_key) VALUES ('%s', '%s', '%s', '%s')";
				
				$connect->query(sprintf($_SQL3, 
										mysqli_real_escape_string($connect, $user_name),
										mysqli_real_escape_string($connect, $password_hash),
										mysqli_real_escape_string($connect, $email),
										mysqli_real_escape_string($connect, $activation_key)));
				
				if(setEmailRegister($email, $activation_key, $user_name))
				{
					echo "Wiadomość wysłana<br />";
				}
				echo "Dziękujemy za skorzystanie z naszych usług.<br />"; 
				echo "Aby korzystać z nowo utworzonego konta musisz najpierw go aktywować specjalnym linkiem wysłanym na email podany w formularzu rejestracji.";
			}
			else
			{
				header('Location: register.php');
			}
			mysqli_commit($connect);
			$connect->close();
		}
	}
	catch(Exception $err)			
	{
		echo "Błąd krytyczny serwera. Prosimy spróbować ponownie puźniej. Przepraszamy.";
		echo "<br />";
		echo ">>>".$err;
		exit();
	}
?>