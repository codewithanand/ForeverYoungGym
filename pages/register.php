<?php
    include "../partials/dbConnect.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $admin_email = $_POST['admin_email'];
        $admin_password = $_POST['admin_password'];
        $admin_cpassword = $_POST['admin_cpassword'];

        $exists = "SELECT * FROM admin WHERE admin_email='$admin_email'";
        $result = mysqli_query($conn, $exists);
        $numExistsRows = mysqli_num_rows($result);

        if($numExistsRows > 0){
            echo 'Error! user already exists';
        }
        else{
            if($admin_password == $admin_cpassword){
                $hash = password_hash($admin_password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `admin` (`admin_email`,`admin_password`, `admin_role`) VALUES ('$admin_email', '$hash', 1)";
                $result = mysqli_query($conn, $sql);

                if($result){
                    echo 'Success! Now you can log in';
                }
                else{
                    echo 'Error! Fill the credentials very carefully '.mysqli_error($conn);
                }
            }
            else{
                echo 'Error! passwords must be same';
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Welcome</h1>
    <form action="register.php" method="post">
        <input type="email" placeholder="Email address" id="admin_email" name="admin_email">
        <input type="password" placeholder="Password" id="admin_password" name="admin_password">
        <input type="password" placeholder="Confirm Password" id="admin_cpassword" name="admin_cpassword">
        <button type="submit">Register</button>
    </form>
</body>
</html>