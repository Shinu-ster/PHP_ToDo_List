<?php
    include '../php/dbconnect.php';
    session_start();
    if(isset($_SESSION['username'])){
        //if session exists redirect to home page
        header('location:http://localhost/wtproj/pages/home.php');
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../stylesheets/style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="container">
        <div class="card">
            <form method="POST">
                <h3>LOGIN</h3>
                <div class="lowerform">
                <input type="text" name="username" id="username" placeholder="Username" autocomplete="off"> <br>
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off">
            </div>
            <div class="btn">
                <button type="submit" name="submit">Login</button>
            </div>
            <div class="bottom-form">
                <div class="no-account">Don't have an account? </div>
                  <a href="register.php">Register Now</a>
            </div>
            
            </form>
        </div>
    </div>
    <?php
        if (isset($_POST['submit'])) {
            $user = $_POST['username'];
            $pass = md5($_POST['password']);
            //check password and username
            $sql = "select * from users where username = '$user' and password = '$pass'";
            $result = mysqli_query($conn,$sql);
            $num = mysqli_num_rows($result);
            if($num>0){
                //if exists create session and 
                //redirect to home page
                $_SESSION['username'] = $user;
               $row = mysqli_fetch_assoc($result);
               $id = $row['id'];
              $_SESSION['id'] = $id;
                header('location:http://localhost/wtproj/pages/home.php');
                exit(); // Add exit() to stop execution after redirect

            }else{
                //if user doesn't exists prompt
                echo '<script>alert("Enter valid information")</script>';
            }
        }
    ?>
</body>
</html>