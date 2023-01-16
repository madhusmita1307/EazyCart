<?php
    require ("includes/common.php");
    session_start();
    
    $showError = "false";
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        // token verification
        if(!isset($_POST['token']))
        {
            // token not found
            header('Location: index.php?error=CSRF Token Missing');
            echo "<script>alert('CSRF Token Missing')</script>";
            $showError = "CSRF Token Missing";
        }

        else if(!empty($_POST['token']) && $_SESSION['token'] != $_POST['token'])
        {
            // token invalid
            header('Location: index.php?error=Authentication Failed');
            echo "<script>alert('CSRF Token Authentication Failed!!')</script>";
            $showError = "CSRF Token Mismatch";
        }

        else {
            $email = $_POST['lemail'];
            $email = mysqli_real_escape_string($con,$email);
    
            $password = $_POST['lpassword'];
            $password = mysqli_real_escape_string($con,$password);
    
            $query = "SELECT id,email_id,password from users where email_id='".$email."' and  password='".$password."'";
            $result = mysqli_query($con,$query);
            $num = mysqli_num_rows($result);
            if($num == 0) {
                $m = "Please enter correct E-mail id and Password";
                header('location: index.php?errorl='.$m);
            }
            else {
                $row = mysqli_fetch_array($result);
                $_SESSION['email'] = $row['email_id'];
                $_SESSION['user_id'] = $row['id'];
                header('location:products.php');
            }
        }
    }
?>