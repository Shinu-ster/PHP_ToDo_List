<?php
include '../php/dbconnect.php';
session_start();
$profile = $_SESSION['username'];
if($profile == true){
   //allow to use this page only if session exists
}
else{
    header('location:http://localhost/wtproj/pages/index.php');
}
$sql = "select * from users where username = '$profile'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add To-Do</title>
    <link rel="stylesheet" href="../stylesheets/home1.css">
    <style>
       *{
    margin:0;
}
table, th, td {    
/* margin-top:40px; */
border-collapse: collapse;    
width: 500px;  
text-align: center;  
font-size: 20px;  
padding: 10px;
}    
table{
    margin: 40px auto;
}
input[type=text]{
    border:none;
    height:30px;
    border-radius:16px;
    padding: 5px 15px;
}
.btn-sub, .btn-edit{
    background-color:#4CAF50;
    color:white;
    border:none;
    border-radius: 12px;
    padding:12px;
    cursor: pointer;
    box-shadow: 0 0 10px #333;
    font-size:15px;
}

    </style>
</head>
<body>
<header> 
        <span>ToDo List</span>
        <nav>
            <a href="addtodo.php" class="nava">Add Todos</a>
            <a href="../php/signout.php" class="nava">Sign Out</a>
        </nav>
    </header>
    <div class="form">
    <?php
    
    $id ="SELECT id FROM users Where username = '$profile' ";
            $result = mysqli_query($conn,$id);
            $num = mysqli_num_rows($result);
            if($num > 0){
                while ($row = mysqli_fetch_assoc($result)) {
                    $num1 = $row['id'];
                }
            }
    ?>
    
     <form action="" method="post">
            <table  >
                <caption>Add ToDo</caption>
                <tr>
                    <th>Task Name: </th>
                </tr>
                <tr>
                    <td><input type="text" name="t_name" id="" value="" autocomplete="off" required></td>
                </tr>
                <tr>
                    <td>
                        <button class="btn-sub"  onclick="window.location.href = 'home.php'">Go Back</button>
                        <input type="submit" value="Submit" name="Submit" class="btn-sub">
                    </td>
                </tr>
            </table>
        </form>
        <?php
        if (isset($_POST['Submit'])) {
            $t_name = $_POST['t_name'];
            //insert new value
            $sql2 = "INSERT into todo (t_id,t_name,is_complete,id) values(
                '','$t_name',0,'$num1')";
                  $result3 = mysqli_query($conn,$sql2);
                  if($result3){
                      echo "inserted succesfully";
                      header('location:http://localhost/wtproj/pages/home.php');
                  }else{
                      echo "error";
                  }
        }
        ?>
    </div>
</body>
</html>