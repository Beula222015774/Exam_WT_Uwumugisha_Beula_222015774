<?php
include('database_connection.php');

// Check if couple_id is set
if (isset($_REQUEST['couple_id'])) {
    $cid = $_REQUEST['couple_id'];
    
    $stmt = $connection->prepare("SELECT * FROM couples WHERE couple_id = ?");
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['couple_id'];
        $u = $row['id'];
        $y = $row['wedding_date'];
        $z = $row['wedding_location'];
    } else {
        echo "Couple not found.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update new record in couples</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update couples form -->
    <h2><u>Update Form of Couples</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">User ID:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? htmlspecialchars($u) : ''; ?>">
        <br><br>

        <label for="wdt">Wedding Date:</label>
        <input type="date" name="wdt" value="<?php echo isset($y) ? htmlspecialchars($y) : ''; ?>">
        <br><br>

        <label for="wdl">Wedding Location:</label>
        <input type="text" name="wdl" value="<?php echo isset($z) ? htmlspecialchars($z) : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $id = $_POST['uid'];
    $wedding_date = $_POST['wdt'];
    $wedding_location = $_POST['wdl'];

    // Validate and sanitize input data
    if (!empty($id) && !empty($wedding_date) && !empty($wedding_location) && !empty($cid)) {
        // Update the record in the database
        $stmt = $connection->prepare("UPDATE couples SET id = ?, wedding_date = ?, wedding_location = ? WHERE couple_id = ?");
        $stmt->bind_param("issi", $id, $wedding_date, $wedding_location, $cid);
        $stmt->execute();
        
        // Redirect to couples.php
        header('Location: couples.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Please fill in all fields.";
    }
}
?>
