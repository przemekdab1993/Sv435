<?php

	require_once "connect.php";
	
	session_start();
	
	if(!isset($_POST['user_name']) && !isset($_POST['password']))
	{
		header('Location: index.php');
		exit();
	}
	
	$vali_flag = True; 
	//Pobieranie przesłanych danych z formularza
	$user_name = $_POST['user_name'];
	$user_password = $_POST['password'];
	
	// Walidacja danych z formularza 
	if ($user_name != htmlentities($user_name, ENT_QUOTES, "UTF-8"))
	{
		$_SESSION['error_l'] = "Niedozwolone dane w formularzu";
		$vali_flag = False;
	}
	
	// Wywołanie zapytania do bazy pod warunkiem poprawnego przejscia walidacji danych
	if($vali_flag == True)
	{
		mysqli_report(MYSQLI_REPORT_STRICT);
		try
		{
			$connect = @new mysqli($host, $db_user, $db_password, $db_name);
			if($connect->connect_errno != 0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$_SQL = "SELECT * FROM user WHERE user_name = '%s'";
				
				if($res = $connect->query(sprintf($_SQL,
											mysqli_real_escape_string($connect, $user_name))))
				{
					$num_user = $res->num_rows;
					if ($num_user > 0)
					{	
						$res_row = $res->fetch_assoc();
						$password_res = $res_row['password'];
						
						if(password_verify($user_password, $password_res) == true)
						{
							$_SESSION['loged'] = True;
							$_SESSION['user_name'] = $res_row['user_name'];
							unset($_SESSION['error_l']);
							
							header('Location: index.php');
						}
						else
						{
							$_SESSION['error_l'] =  "Niepoprawne login lub hasło<br />";
							header('Location: index.php');
						}
					}
					else
					{
						$_SESSION['error_l'] =  "Niepoprawne login lub hasło<br />";
						header('Location: index.php');
					}
				}
				else
				{
					throw new Exception("Złe zapytanie do bazy".$connect->error());
				}
				$res->close();
				$connect->close();
			}
		}
		catch(Exception $err)
		{
			echo "Błąd krytyczny serwera. Prosimy spróbować ponownie puźniej. Przepraszamy.";
			echo "<br />";
			echo "Błąd: ".$err;
			exit();
		}
	}
	else
	{
		header('Location: index.php');
	}	

?>