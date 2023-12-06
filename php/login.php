<?php
    session_start();
    include_once "config.php";
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    
    if(!empty($email) && !empty($password)){
        //Check User entered email & password matched to DB data
        $sql=mysqli_query($conn,"SELECT * FROM users WHERE email='{$email}' AND password='{$password}'");
        if(mysqli_num_rows($sql)>0){ // if user credentials matched
            $row=mysqli_fetch_assoc($sql);
            $status="Active now";
            // After click Login button, Update the status value as "Active now"
            $sql2=mysqli_query($conn,"UPDATE users SET status='Active now' WHERE unique_id={$row['unique_id']}");
            if($sql2){
                $_SESSION['unique_id']=$row['unique_id']; // using the session we used user unique_id in other php file
                echo "Success";
            }
        }else{
            echo "Email or password is incorrect!";
        }
    }else{
        echo "All input fields are required!";
    }
?>