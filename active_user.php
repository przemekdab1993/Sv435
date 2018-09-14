<?php
	require "connect.php";
	
	
	
	$user_name = $_GET['user'];
	$activation_key = $_GET['key'];
		
	try
	{
		$connect = new mysqli($host, $db_user, $db_password, $db_name);
		
		if($connect->connect_errno != 0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		
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
					$_SQL_u = "UPDATE user SET status = 'active' WHERE user_name = '%s' AND activation_key = '%s';";	
					if($connect->query(sprintf($_SQL_u, 
											mysqli_real_escape_string($connect, $user_name),
											mysqli_real_escape_string($connect, $activation_key))) == false)
					{
						throw new Exception(mysqli_connect_errno());
					}
					echo "<h1>Aktywacja Pomyślna</h1>";
					echo "<h3>Diękujemy że dołączyłeś naszej społecznści. Życzymy udanego korzystania z naszej witryny na twoin nowym koncie.</h3>";
					echo "Za chwilę zostaniesz przekierowany na strone główną.";
				}
				else
				{
					echo "Ten link aktywacyjny został już wcześniej aktywowany.";
				}
			}
			else
			{
				echo "Wpisałeś zły aders strony";
			}	
		}
		else throw new Exception(mysqli_connect_errno());
			
		
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