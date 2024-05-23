<?php
include('database_connection.php');

// Check if checklist_id is set
if (isset($_REQUEST['checklist_id'])) {
    $chid = $_REQUEST['checklist_id'];

    // Prepare the DELETE statement
    $stmt = $connection->prepare("DELETE FROM checklist WHERE checklist_id=?");
    $stmt->bind_param("i", $chid);
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
            <input type="hidden" name="chid" value="<?php echo htmlspecialchars($chid); ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($stmt->execute()) {
                echo "Record deleted successfully.;
                <a href='checklist.php'>Yes</a>";
            } else {
                echo "Error deleting data: " . $stmt->error;
            }
        }
        ?>
    </body>
    </html>
    <?php
    $stmt->close();
} else {
    echo "checklist_id is not set.";
}

$connection->close();
?>
