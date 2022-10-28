<?php
    include './partials/dbConnect.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $adminEmail = $_POST['admin_email'];
        $adminPassword = $_POST['admin_password'];
        
        $sql = "SELECT * FROM admin WHERE admin_email = '$adminEmail'";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);
        
        if($numOfRows == 1){
            while($row = mysqli_fetch_assoc($result)){
                if(password_verify($adminPassword, $row['admin_password'])){
                    session_start();
                    $_SESSION['admin_email'] = $adminEmail;
                    if($row["admin_role"] == 0){
                        header('location: ./pages/superadmin.php');
                    }
                    else{
                        header('location: ./pages/admin.php');
                    }
                }
                else{
                    echo 'Error! Invalid user credentials';
                }
            }
        }else{
            echo 'Error!  Invalid user credentials';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
</head>
<body>
    
    <h1>Welcome back!</h1>
    <form action="index.php" method="post">
        <input type="email" placeholder="email@example.com" id="admin_email" name="admin_email">
        <input type="password" id="admin_password" name="admin_password">
        <button type="submit">Sign in</button>
    </form>
</body>
</html>