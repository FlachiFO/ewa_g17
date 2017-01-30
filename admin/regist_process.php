<?php
	session_start();
	require_once 'db_config.php';

	if(isset($_POST['btn-regist']))
	{
		$user = trim($_POST['user']);
		$user_password = trim($_POST['password']);
        $user_confirm_password = trim($_POST['confirm_password']);
        $strasse = trim($_POST['strasse']);
        $country = trim($_POST['country']);
        $plz = trim($_POST['plz']);
        $ort = trim($_POST['ort']);
        $anrede = trim($_POST['anrede']);
	
		$password = md5($user_password);
//		$password = $user_password;
        
        if($user_password == $user_confirm_password) {
        
            if($user == "" OR $user_password == "" OR $user_confirm_password == "" OR $strasse == "" OR $anrede == "" OR $country == "" OR $plz == "" OR $ort == "")
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
                $regist = "INSERT INTO user (Username, Userpwmd5, UserAnrede, UserAdresse, UserPLZ, UserCountry, UserOrt) VALUES ('$user', '$password', '$anrede', '$strasse', '$plz', '$country', '$ort')";
                $eintragen = mysqli_query($db_con,$regist);
                if($eintragen == true)
                    {
                        $sql="SELECT UserID, Username, UserAnrede, Useradresse, UserPLZ, UserCountry, UserOrt FROM user WHERE Username='$user' AND Userpwmd5='$password'";
                        $result = mysqli_query($db_con,$sql);

                        $row = mysqli_fetch_row($result);

                        $menge = mysqli_num_rows($result);

                        if($menge == 1)
                        {
                            //session_register($username);
                            $_SESSION['user_session_id']=$row[0];
                            $_SESSION['user_session_name']=$row[1];
                            $_SESSION['user_session_anrede']=$row[2];
                            $_SESSION['user_session_address']=$row[3];
                            $_SESSION['user_session_plz']=$row[4];
                            $_SESSION['user_session_ort']=$row[5];
                            $_SESSION['user_session_country']=$row[6];
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