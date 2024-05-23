<?php
include('database_connection.php');

// Check if task_id is set
if(isset($_REQUEST['task_id'])) {
    $tid = $_REQUEST['task_id'];
    
    $stmt = $connection->prepare("SELECT * FROM tasks WHERE task_id=?");
    $stmt->bind_param("i", $tid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['task_id'];
        $u = $row['checklist_id'];
        $y = $row['task_name'];
        $z = $row['due_date'];
    } else {
        echo "tasks not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in tasks</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update tasks form -->
    <h2><u>Update Form of tasks</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="chid">checklist_id:</label>
        <input type="number" name="chid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="tnm">task_name:</label>
        <input type="text" name="chn" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="ddt">due_date:</label>
        <input type="text" name="ddt" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $checklist_id = $_POST['chid'];
    $task_name = $_POST['tnm'];
    $due_date = $_POST['ddt'];
    
    
    // Update the tasks in the database
    $stmt = $connection->prepare("UPDATE tasks SET checklist_id=?, task_name=? ,due_date=?WHERE task_id=?");
    $stmt->bind_param("sssd", $checklist_id, $task_name,$due_date $tid);
    $stmt->execute();
    
    // Redirect to tasks.php
    header('Location: tasks.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
