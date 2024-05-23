<?php
include('database_connection.php');

// Check if event_id is set
if(isset($_REQUEST['event_id'])) {
    $eid = $_REQUEST['event_id'];
    
    $stmt = $connection->prepare("SELECT * FROM events WHERE event_id=?");
    $stmt->bind_param("i", $eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['event_id'];
        $u = $row['couple_id'];
        $y = $row['event_name'];
        $z = $row['event_date'];
    } else {
        echo "event not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in events</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update events form -->
    <h2><u>Update Form of events</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="cid">couple_id</label>
        <input type="number" name="cid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="enm">event_name:</label>
        <input type="text" name="enm" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=edt>event_date:</label>
        <input type="date" name="edt" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $couple_id = $_POST['cid'];
    $event_name = $_POST['enm'];
    $event_date = $_POST['edt'];
    
    
    // Update the events in the database
    $stmt = $connection->prepare("UPDATE events SET couple_id=?, event_name=?, event_date=? WHERE event_id=?");
    $stmt->bind_param("issi", $couple_id, $event_name, $event_date,  $eid);
    $stmt->execute();
    
    // Redirect to events.php
    header('Location: events.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
