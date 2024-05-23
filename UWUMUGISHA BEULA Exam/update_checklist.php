<?php
include('database_connection.php');

// Check if checklist_id is set
if(isset($_REQUEST['checklist_id'])) {
    $chid = $_REQUEST['checklist_id'];
    
    $stmt = $connection->prepare("SELECT * FROM checklist WHERE checklist_id=?");
    $stmt->bind_param("i", $chid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['checklist_id'];
        $u = $row['couple_id'];
        $y = $row['checklist_name'];
    } else {
        echo "checklist not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in checklist</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update checklist form -->
    <h2><u>Update Form of checklist</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="cid">couple_id:</label>
        <input type="number" name="cid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="chn">checklist_name:</label>
        <input type="text" name="chn" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $couple_id = $_POST['cid'];
    $checklist_name = $_POST['chn'];
    
    
    // Update the checklist in the database
    $stmt = $connection->prepare("UPDATE checklist SET couple_id=?, checklist_name=? WHERE checklist_id=?");
    $stmt->bind_param("isi", $couple_id, $checklist_name, $chid);
    $stmt->execute();
    
    // Redirect to checklist.php
    header('Location: checklist.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
