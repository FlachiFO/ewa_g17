<?php
	session_start();
	unset($_SESSION['user_session_id']);
	
	if(session_destroy())
	{
		header("Location: ..");
	}
?>