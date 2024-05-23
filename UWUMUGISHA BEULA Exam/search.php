<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query']) && !empty($_GET['query'])) {
include('database_connection.php');


    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Queries for different tables
    $queries = [
        'couples' => "SELECT wedding_location FROM couples WHERE wedding_location LIKE '%$searchTerm%'",
        'budgets' => "SELECT total_budget FROM budgets WHERE total_budget LIKE '%$searchTerm%'",
        'tasks' => "SELECT task_name FROM tasks WHERE task_name LIKE '%$searchTerm%'",
        'checklist' => "SELECT checklist_name FROM checklist WHERE checklist_name LIKE '%$searchTerm%'",
        'events' => "SELECT event_name FROM events WHERE event_name LIKE '%$searchTerm%'",
        'payments' => "SELECT amount FROM payments WHERE amount LIKE '%$searchTerm%'",
        'invitations' => "SELECT event_id FROM invitations WHERE event_id LIKE '%$searchTerm%'",
        'vendors' => "SELECT vendor_name FROM vendors WHERE vendor_name LIKE '%$searchTerm%'",
        'guests' => "SELECT guest_name FROM guests WHERE guest_name LIKE '%$searchTerm%'"


    ];

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";

    foreach ($queries as $table => $sql) {
        $result = $connection->query($sql);
        echo "<h3>Table of $table:</h3>";
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row[array_keys($row)[0]] . "</p>"; // Dynamic field extraction from result
            }
        } else {
            echo "<p>No results found in $table matching the search term: '$searchTerm'</p>";
        }
    }

    // Close the connection
    $connection->close();
} else {
    echo "<p>No search term was provided.</p>";
}
?>
