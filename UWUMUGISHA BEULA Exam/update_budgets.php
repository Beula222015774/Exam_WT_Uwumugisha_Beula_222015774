<?php
include('database_connection.php');

// Check if budget_id is set
if(isset($_REQUEST['budget_id'])) {
    $bid = $_REQUEST['budget_id'];
    
    $stmt = $connection->prepare("SELECT * FROM budgets WHERE budget_id=?");
    $stmt->bind_param("i", $bid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['budget_id'];
        $u = $row['couple_id'];
        $y = $row['total_budget'];
        $z = $row['spent_budget'];
    } else {
        echo "budgets not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update new record in budgets</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
    <!-- Update customer form -->
    <h2><u>Update Form of budgets</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="cid">couple_id:</label>
        <input type="number" name="cid" value="<?php echo isset($u) ? $u : ''; ?>">
        <br><br>

        <label for="tob">total_budget:</label>
        <input type="number" name="tob" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for=spb>spent_budget:</label>
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
    $couple_id = $_POST['cid'];
    $total_budget = $_POST['tob'];
    $spent_budget = $_POST['spb'];
    
    // Update the budgets in the database
    $stmt = $connection->prepare("UPDATE budgets SET couple_id=?, total_budget=?, spent_budget=? WHERE budget_id=?");
    $stmt->bind_param("ibbi", $cid, $tob, $spb, $bid);
    $stmt->execute();
    
    // Redirect to budgets.php
    header('Location: budgets.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
s