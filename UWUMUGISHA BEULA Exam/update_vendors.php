<?php
include('database_connection.php');

// Check if vendor_id is set
if(isset($_REQUEST['vendor_id'])) {
    $cid = $_REQUEST['vendor_id'];
    
    $stmt = $connection->prepare("SELECT * FROM vendors WHERE vendor_id=?");
    $stmt->bind_param("i", $vid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['vendor_id'];
        $u = $row['user_id'];
        $y = $row['vendor_name'];
        $z = $row['address'];
    } else {
        echo "vendor not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in vendors</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update vendors form -->
    <h2><u>Update Form of vendors</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="uid">user_id:</label>
        <input type="number" name="uid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="vn">vendor_name:</label>
        <input type="text" name="vn" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=adr>address:</label>
        <input type="text" name="adr" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_id = $_POST['uid'];
    $vendor_name = $_POST['vn'];
    $address = $_POST['adr'];
    
    // Update the vendors in the database
    $stmt = $connection->prepare("UPDATE vendors SET id=?, vendor_name=?, address=? WHERE vendor_id=?");
    $stmt->bind_param("issi", $id, $vendor_name, $address, $vid);
    $stmt->execute();
    
    // Redirect to vendors.php
    header('Location: vendors.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
