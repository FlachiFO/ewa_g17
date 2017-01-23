<?php
	session_start();
	require_once 'db_config.php';

	if(isset($_POST['btn-login']))
	{
		$user = trim($_POST['user']);
		$user_password = trim($_POST['password']);
	
		$password = md5($user_password);
//		$password = $user_password;
        
        $sql="SELECT UserID, Username, UserAnrede, Useradresse FROM user WHERE Username='$user' AND Userpwmd5='$password'";
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
            echo "ok"; // log in
        }
        else
        {
            echo "Login nicht erfolgreich";
        }
        
	}

?>