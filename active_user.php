<?php
	// AKTYWACJA KONTA NOWEGO UŻYTKOWNIKA //
	require "connect.php";
	
	// Pobranie danych przesłanych za pomocą metody GET //
	$user_name = $_GET['user'];
	$activation_key = $_GET['key'];
		
	try
	{
		// próba połaczenia z bazą
		$connect = new mysqli($host, $db_user, $db_password, $db_name);
		
		if($connect->connect_errno != 0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		
		// Sprawdzanie poprawności otrzymanych danych 
		$_SQL_s = "SELECT status FROM user WHERE user_name = '%s' AND activation_key = '%s';";	
		$res_s = $connect->query(sprintf($_SQL_s, 
								mysqli_real_escape_string($connect, $user_name),
								mysqli_real_escape_string($connect, $activation_key)));
		if($res_s)
		{
			if($res_s->num_rows == 1)
			{
				$res_a = $res_s->fetch_assoc();
				if($res_a['status'] == 'unactive')
				{
					// Aktywacja konta użytkownika czyli zmiana w bazie pozycji status na "active"
					$_SQL_u = "UPDATE user SET status = 'active' WHERE user_name = '%s' AND activation_key = '%s';";	
					if($connect->query(sprintf($_SQL_u, 
											mysqli_real_escape_string($connect, $user_name),
											mysqli_real_escape_string($connect, $activation_key))) == false)
					{
						throw new Exception(mysqli_connect_errno());
					}
					// Wysłanie krótkiego komunikatu za pomocą zmiennej sesyjnej "$_SESSION['alert']"
					$alert = "<h2>Aktywacja Pomyślna</h2>"; 
					$alert .= "Diękujemy że dołączyłeś naszej społecznści. Życzymy udanego korzystania z naszej witryny na twoin nowym koncie.";
					$_SESSION['alert'] = $alert;
					header('Location: index.php');
				}
				else
				{ 
					$alert = "Ten link aktywacyjny został już wcześniej aktywowany.";
					$_SESSION['alert'] = $alert;
					header('Location: index.php');
				}
			}
			else
			{
				echo "Strona o podanym adresie nieistnieje";
			}	
		}
		else throw new Exception(mysqli_connect_errno());
			
		// zamykanie połączenie z bazą
		$res_s->close();
		$connect->close();
	}
	catch(Exception $error)
	{
		echo "Błąd serwera";
		echo $error;
		exit();
	}

?>