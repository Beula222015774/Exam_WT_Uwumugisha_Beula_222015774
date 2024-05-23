<?php
include('database_connection.php');

// Check if event_id is set
if (isset($_REQUEST['event_id'])) {
    $eid = $_REQUEST['event_id'];
    
    // Prepare the DELETE statement
    $stmt = $connection->prepare("DELETE FROM events WHERE event_id = ?");
    $stmt->bind_param("i", $eid);
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Execute the statement upon form submission
        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting data: " . $stmt->error;
        }
        
        $stmt->close();
        $connection->close();
        
        // Redirect to events.php after deletion
        header('Location: events.php');
        exit();
    }
} else {
    echo "event_id is not set.";
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Delete Record</title>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this record?");
        }
    </script>
</head>
<body>
    <form method="post" onsubmit="return confirmDelete();">
        <input type="hidden" name="eid" value="<?php echo htmlspecialchars($eid); ?>">
        <input type="submit" value="Delete">
    </form>
</body>
</html>
