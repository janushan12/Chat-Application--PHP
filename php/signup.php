<?php
    session_start();
    include_once "config.php";
    $fname=mysqli_real_escape_string($conn,$_POST['fname']);
    $lname=mysqli_real_escape_string($conn,$_POST['lname']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $retypePassword=mysqli_real_escape_string($conn,$_POST['retypePassword']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password) && !empty($retypePassword)){
        // Check user email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            // Check that email already exist or not
            $sql=mysqli_query($conn,"SELECT email FROM users WHERE email='{$email}'");
            if(mysqli_num_rows($sql)>0){
                echo "$email is already exist!";
            }else{
                // Checking Password & re-type password fields are equal or not
                if ($password == $retypePassword) {
                    // Check user upload file or not
                    if(isset($_FILES['image'])){
                        $img_name=$_FILES['image']['name']; //getting user upload img name
                        $img_type=$_FILES['image']['type']; //getting user upload img type
                        $tmp_name=$_FILES['image']['tmp_name']; //this tmp name is used to save/move file in our folder

                        //Explode image and get the last extension like jpg or png
                        $img_explode=explode('.',$img_name); //get name and extension are separeted
                        $img_ext=end($img_explode); //get extension only(last element)

                        $extensions=['png','jpeg','jpg']; // Store some image extension for accept those files only
                        if(in_array($img_ext,$extensions)===true){
                            $time=time(); //return current time
                                            //when we move file after renaming file with this time in our folder
                            //move the user uploaded img file to our particular folder
                            $new_img_name=$time.$img_name;

                            //user upload img move to our folder
                            if(move_uploaded_file($tmp_name,"images/".$new_img_name)){
                                $status='Active now'; //once user signed up then his status will be active now
                                $random_id=rand(time(),10000000); //creatimg random id for user

                                //Insert all user's data inside table
                                $sql2=mysqli_query($conn,"INSERT INTO users (unique_id, fname, lname, email, password, img, status) 
                                                    VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                                
                                if($sql2){
                                    $sql3=mysqli_query($conn,"SELECT * FROM users WHERE email='{$email}'");
                                    if(mysqli_num_rows($sql3)>0){
                                        $row=mysqli_fetch_assoc($sql3);
                                        $_SESSION['unique_id'] = $row['unique_id']; //using this session we used user unique_id in other php file
                                        echo "Success";
                                    }
                                }else{
                                    echo "Something went wrong";
                                }
                            }
                            
                        }else{
                            echo "Image format should be: ".implode(', ',$extensions);
                        }
                    }else{
                        echo "Please select an image file!";
                    }
                }else{
                    echo "Password doesn't match!";
                }
            }
        }else{
            echo "$email is not valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>