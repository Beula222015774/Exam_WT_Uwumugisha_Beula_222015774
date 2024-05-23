<?php
include('database_connection.php');

// Check if invitation_id is set
if(isset($_REQUEST['invitation_id'])) {
    $iid = $_REQUEST['invitation_id'];
    
    $stmt = $connection->prepare("SELECT * FROM invitations WHERE invitation_id=?");
    $stmt->bind_param("i", $iid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['invitation_id'];
        $u = $row['guest_id'];
        $y = $row['event_id'];
    } else {
        echo "invitation not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in invitations</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update transactions form -->
    <h2><u>Update Form of invitations</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="gid">guest_id:</label>
        <input type="number" name="gid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="eid">event_id:</label>
        <input type="number" name="eid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $guest_id = $_POST['gid'];
    $event_id = $_POST['eid'];
    
    // Update the invitations in the database
    $stmt = $connection->prepare("UPDATE invitations SET guest_id=?, event_id=? WHERE invitation_id=?");
    $stmt->bind_param("iii", $guest_id, $event_id,  $iid);
    $stmt->execute();
    
    // Redirect to invitations.php
    header('Location: invitations.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
