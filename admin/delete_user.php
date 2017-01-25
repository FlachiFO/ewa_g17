<?php 
session_start();
require_once 'db_config.php';


        $del_id = $_SESSION['user_session_id'];
        $del_user = $_SESSION['user_session_name'];

        $del_check="SELECT UserID, Username FROM user WHERE Username='$del_user' AND UserID='$del_id'";

        $result = mysqli_query($db_con,$del_check);
        $row = mysqli_fetch_row($result);
        $menge = mysqli_num_rows($result);
        if($menge == 1) {
            $sql_del="DELETE FROM user WHERE Username='$del_user' AND UserID='$del_id'";
            $result = mysqli_query($db_con,$sql_del);
            $del_check="SELECT UserID, Username FROM user WHERE Username='$del_user' AND UserID='$del_id'";
            $result = mysqli_query($db_con,$del_check);
            $del = mysqli_fetch_row($result);
            $menge = mysqli_num_rows($result);
            if ($menge != 1){
                unset($_SESSION['user_session_id']);
                echo "Benutzer gelöscht!";
            }
            else {
                echo "nö";
            }
        }

?>