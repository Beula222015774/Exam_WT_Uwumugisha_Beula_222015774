<?php
include('database_connection.php');

// Check if guest_id is set
if(isset($_REQUEST['guest_id'])) {
    $cid = $_REQUEST['guest_id'];
    
    $stmt = $connection->prepare("SELECT * FROM guests WHERE guest_id=?");
    $stmt->bind_param("i", $gid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['guest_id'];
        $u = $row['couple_id'];
        $y = $row['guest_name'];
        $z = $row['guest_email'];
    } else {
        echo "guest not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in guests</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update guests form -->
    <h2><u>Update Form of guests</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="cid">couple_id:</label>
        <input type="number" name="cid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="gnm">guest_name:</label>
        <input type="text" name="gnm" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=geml>guest_email:</label>
        <input type="text" name="geml" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $couple_id = $_POST['cid'];
    $guest_name = $_POST['gnm'];
    $guest_email = $_POST['geml'];
    
    // Update the guests in the database
    $stmt = $connection->prepare("UPDATE guests SET couple_id=?, guest_name=?, guest_email=? WHERE guest_id=?");
    $stmt->bind_param("issi", $couple_id, $guest_name, $guest_email, $gid);
    $stmt->execute();
    
    // Redirect to guests.php
    header('Location: guests.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
