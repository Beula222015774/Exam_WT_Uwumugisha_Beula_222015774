<?php
include('database_connection.php');

// Check if payment_id is set
if(isset($_REQUEST['payment_id'])) {
    $pid = $_REQUEST['payment_id'];
    
    $stmt = $connection->prepare("SELECT * FROM payments WHERE payment_id=?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['payment_id'];
        $u = $row['vendor_id'];
        $y = $row['couple_id'];
        $z = $row['amount'];
    } else {
        echo "payments not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in payments</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update customer form -->
    <h2><u>Update Form of payments</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="vid">vendor_id:</label>
        <input type="number" name="cid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="cid">couple_id:</label>
        <input type="number" name="tob" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=amt>amount:</label>
        <input type="number" name="spb" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $vendor_id = $_POST['vid'];
    $couple_id = $_POST['cid'];
    $amount = $_POST['amt'];
    
    // Update the payments in the database
    $stmt = $connection->prepare("UPDATE payments SET vendor_id=?, couple_id=?, amount=? WHERE payment_id=?");
    $stmt->bind_param("iiii", $vid, $cid, $amt, $pid );
    $stmt->execute();
    
    // Redirect to payments.php
    header('Location: payments.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
