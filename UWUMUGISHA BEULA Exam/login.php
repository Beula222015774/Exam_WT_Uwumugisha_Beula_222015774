<?php
session_start(); // Start the session
include('database_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "SELECT * FROM user WHERE email=?"; 
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];

            header("Location: home.html");
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Invalid email or password";
        }
    } else {
        echo "User not found";
    }

    $stmt->close();
    $connection->close();
} else {
    // If the request method is not POST, display an appropriate message or handle it accordingly.
    echo "Please submit the form to log in.";
}
?>

