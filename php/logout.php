<?php
    session_start();
   
    if(isset($_SESSION['unique_id'])){   // User is logged in
        include_once "config.php";
        $logout_id=mysqli_real_escape_string($conn,$_GET['logout_id']);
        
        if(isset($logout_id)){  // if logout id is set
            $status="Offline now";
            // After click Logout button, Update the status value as "Offline now"
            $sql=mysqli_query($conn,"UPDATE users SET status='Offline now' WHERE unique_id={$logout_id}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../login.php");
            }
        }else{
            header("location: ../users.php");
        }
    }else{ // Go login page
        header("location: ../login.php");
    }
?>