<?php
include '../php/dbconnect.php';
session_start();
$profile = $_SESSION['username'];
if($profile == true){
    //allow to use this page only if session exists
}
else{
    //redirect to login if no session
    header('location:http://localhost/wtproj/pages/login.php');
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
    <title>To-Do</title>
    <link rel="stylesheet" href="../stylesheets/home1.css?v=<?php echo time(); ?>">
    <style>
        .btn-sub{
            margin-left:625px;
        }
    </style>
</head>
<body>
<?php ob_start(); // Start output buffering ?>
<header>
    <span>ToDo List</span>
    <nav>
        <a href="addtodo.php" class="nava">Add Todos</a>
        <a href="../php/signout.php" class="nava">Sign Out</a>
    </nav>
</header>
<div class="container">
    <p> Welcome <?php echo $row['username']; ?></p>
    <form action="" method="post">
        <?php
        $id = "SELECT id FROM users Where username = '$profile' ";
        $result = mysqli_query($conn, $id);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $num1 = $row['id'];
            }
        }
        $sql = "SELECT * FROM todo INNER JOIN users on users.id = todo.id where todo.id = '$num1' ";
        $result2 = mysqli_query($conn, $sql);
        $num2 = mysqli_num_rows($result2);
        if ($num2 > 0) {
            while ($row1 = mysqli_fetch_assoc($result2)) {
                ?>
                <!-- display if task exists  -->
                <div class="wrapper">
                    <div class="chkbox">
                        <?php $checked = ($row1['is_complete'] == 1 ? 'checked' : ''); ?>
                        <input type="checkbox" name="is_complete[]" value="<?php echo $row1['t_name']; ?>"
                               <?php echo $checked ?>>
                    </div>
                    <div class="tname">
                        <p><?php echo $row1['t_name'] ?></p>
                    </div>
                    <div class="buttons">
                        <button type="update" class="btn-edit" >
                            <!-- direct to edit page -->
                            <!-- pass id with url  -->
                            <a href="edittodo.php?update='<?php echo $row1['t_id'];?>'">Edit</a>
                        </button>
                        <button type="submit" name="delete_task" class="del-btn"
                                value="<?php echo $row1['t_name']; ?>">Delete
                        </button>
                            </div>
                </div>
                <?php
            }
        } elseif ($num2 == 0) {
            // display if task doesn't exists 
            echo " <p> You have no tasks you can add task in  <a href='addtodo.php'> Add Todos</a> </p>";
           
        }
        ?>
        <?php
        //display submit button only if any task exists 
            if (!empty($num2)) {
                echo '<input type="submit" name="submit" value="Submit" class="btn-sub">';
            }
        ?>
        
       
    </form>
    <br>
    
                                    
    <?php
    if (isset($_POST['submit'])) {
        if (isset($_POST['is_complete'])) {
            $selectedTasks = $_POST['is_complete'];
            foreach ($selectedTasks as $t_name) {
                //update value of database
                $sql3 = "UPDATE todo set is_complete = 1 where t_name = '$t_name' and id = '$num1'";
                $result3 = mysqli_query($conn, $sql3);
                if ($result3) {
                    // Successful update
                } else {
                    echo "Error updating task: " . mysqli_error($conn);
                }
            }
             //refresh the page after updating the database
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit();
        }
    }
    if (isset($_POST['delete_task'])) {
        $taskToDelete = $_POST['delete_task'];
        //delete from database
        $sql4 = "DELETE FROM todo WHERE t_name = '$taskToDelete' AND id = '$num1'";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4) {
            // Task deleted successfully
            //refresh page
            header('Location: ' . $_SERVER['PHP_SELF']);
            exit();
        } else {
            echo "Error deleting task: " . mysqli_error($conn);
        }
    }
    ?>
</div>
</body>
</html>
<?php ob_end_flush(); // End output buffering ?>