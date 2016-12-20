<?php
	session_start();
	require_once 'db_config.php';

	if(isset($_POST['btn-regist']))
	{
		$user = trim($_POST['user']);
		$user_password = trim($_POST['password']);
        $user_confirm_password = trim($_POST['confirm_password']);
        $address = trim($_POST['address']);
	
		$password = md5($user_password);
//		$password = $user_password;
        
        if($user_password == $user_confirm_password) {
        
            if($user == "" OR $user_password == "" OR $user_confirm_password == "" OR $address == "")
            {
                echo "Eingabefehler. Bitte alle Felder ausfüllen!";
                exit;
            }

            $sql="SELECT Username FROM user WHERE Username='$user'";
            $result = mysqli_query($db_con,$sql);

            if (mysqli_fetch_row($result) > 0) {    
                echo 'Benutzername schon vorhanden!';  
            } 
            else {
                $regist = "INSERT INTO user (Username, Userpwmd5, UserAdresse) VALUES ('$user', '$password', '$address')";
                $eintragen = mysqli_query($db_con,$regist);
                if($eintragen == true)
                    {
                       $sql="SELECT UserID, Username FROM user WHERE Username='$user' AND Userpwmd5='$password'";
                        $result = mysqli_query($db_con,$sql);

                        $row = mysqli_fetch_row($result);

                        $menge = mysqli_num_rows($result);

                        if($menge == 1)
                        {
                            //session_register($username);
                            $_SESSION['user_session_id']=$row[0];
                            $_SESSION['user_session_name']=$row[1];
                            echo "ok"; // log in

                        }
                        else
                        {
                             echo "Login nicht erfolgreich";
                         }

                    }
                else
                    {
                    echo 'Fehler beim Speichern des Kontos.';
                    }
            }
        }
        else {
            echo "Passwörter stimmen nicht überein!";
        }
	}

?>