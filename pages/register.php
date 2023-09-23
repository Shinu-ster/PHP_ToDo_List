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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register Page</title>
    
    <link rel="stylesheet" href="../stylesheets/style.css?v=<?php echo time(); ?>">
  </head>
  <body>
    
    <div class="container">
        <div class="card">
            <h3>REGISTER</h3>
           <form action="" method="post">
            <div class="lowerform">
                <input type="text" name="username" id="username" placeholder="Username" autocomplete="off" required> <br>
                <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required> <br>
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required> <br>
            </div>
            <div class="btn">
                <button type="submit" name="Submit">Regiser</button>
            </div>
           </form>

        </div>
    </div>
    <?php
      if(isset($_POST['Submit'])){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = md5($_POST['password']);
        //create user
        $sql = "INSERT INTO users (username,email,password) values('$username','$email','$pass')";
        $result = mysqli_query($conn,$sql);
        if($result){
          //redirect to login
          header('location:http://localhost/wtproj/pages/login.php');
        }else{
          echo '<script>alert("Enter valid information")</script>';
        }
      }
    ?>
  </body>
  
</html>

