<?php
    include '../php/dbconnect.php';
    session_start();
    $profile = $_SESSION['username'];
    $valid = $_SESSION['id'];
    //get id from URL
    $id = $_GET['update'];
    if($profile == true){
    //allow to use this page only if session exists
    }   
    else{
    //redirect to login if no session
    header('location:http://localhost/wtproj/pages/login.php');
    }
    $sql = "SELECT * FROM todo where t_id = $id";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    if ($row['id']!=$valid) {
        echo '<script>alert("Access denied!")</script>';
        header('location:http://localhost/wtproj/pages/home.php');
    }
    $task = $row['t_name'];
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit To-Do</title>
    <link rel="stylesheet" href="../stylesheets/home1.css?v=<?php echo time(); ?>">
    <style>
        
            table, th, td {    
                margin-left: auto;  
margin-right: auto;  
margin-top:40px;
border-collapse: collapse;    
width: 500px;  
text-align: center;  
font-size: 20px;  
padding: 10px;
}    

input[type=text]{
    border:none;
    height:30px;
    border-radius:16px;
    padding: 5px 15px;
}
.btn-sub{
    background-color:#4CAF50;
    color:white;
    border:none;
    border-radius: 12px;
    padding:12px;
    cursor: pointer;
    box-shadow: 0 0 10px #333;
    font-size:15px;
    /* margin-left:20px; */
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
<form action="" method="post">
            <table >
               <caption>Update ToDo</caption>
                <tr>
                    <th>Task Name: </th>
                </tr>
                <tr>
                    <td><input type="text" name="t_name" value="<?php echo $task; ?>" autocomplete="off"></td>
                </tr>
                <tr>
                    <td>
                        
                        <input type="submit" value="Submit" name="Submit" class="btn-sub">
                    </td>
             
                </tr>
            </table>
        </form>
           
        <?php
            if (isset($_POST['Submit'])) {
                $taskname = $_POST['t_name'];
                //update taskname
                $sql1 = "update todo set t_name ='$taskname' where t_id = $id";
                $result1 = mysqli_query($conn,$sql1);
                if($result1){
                    //redirect to home after update
                    header('location:http://localhost/wtproj/pages/home.php');
                }else{
                    echo '<script>alert("Enter valid title")</script>';
                }
            }
        
        ?>
</body>
</html>