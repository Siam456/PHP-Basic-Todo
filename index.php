<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo List Application</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>

        <!-- database -->
        <?php 
    
        $error = "";
        $db = mysqli_connect ( "localhost", "root", "", "todo" ) or die("unable to connect");

        if(isset($_POST['submit'])){
            $task = $_POST['task'];
            if(empty($task)){
                $error = "Need to fill Task";
            } else{
                $sql = "INSERT INTO tasks (task) VALUES ('$task')";
                mysqli_query($db, $sql);
                header('location: index.php');
            }
        }

        $tasks = mysqli_query($db, "SELECT * FROM tasks");

        //delete task
        if(isset($_GET['del_task'])){
            $id = $_GET['del_task'];
            $sql = "DELETE FROM tasks WHERE id = $id";
            mysqli_query($db, $sql);
            header('location: index.php'); 
        }
    ?>

    <div class="heading">
        <h2>Todo list Application</h2>
    </div>

    <form method="POST" action="index.php">
        
    <?php if(isset($error)){ ?>
        <p><?php echo $error ?> </p>
    <?php } ?>
        <input type="text" name="task" class="task_input">
        <button type="submit" class="add_btn" name="submit">Add Task</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Task</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
        <?php while($row = mysqli_fetch_array($tasks)) {?>
            <tr>
                
                <td>
                     <?php echo $row['id'] ?>
                </td>
                
                <td class='task'>
                    <?php echo $row['task'] ?>
                </td>
               
                <td class="delete">
                    <a href="index.php?del_task=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>