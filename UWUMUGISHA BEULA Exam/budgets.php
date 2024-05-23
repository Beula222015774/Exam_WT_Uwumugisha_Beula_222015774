<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Budgets</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: yellow;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
      
    }
    header{
    background-color:skyblue;
}
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:skyblue;
    }

  </style>
  <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
  </head>

  <header>

<body bgcolor="pink">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="query">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./images/wedding logo.png" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./Service.html">SERVICE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./couples.php">COUPLES</a>
  </li>
      <li style="display: inline; margin-right: 10px;"><a href="./budgets.php">BUDGETS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./checklist.php">CHECKLIST</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./events.php">EVENTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./guests.php">GUESTS</a>
  </li>
  <li style="display: inline; margin-right: 10px;"><a href="./vendors.php">VENDORS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./payments.php">PAYMENTS</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./invitations.php">INVITATIONS</a>
  </li>
   <li style="display: inline; margin-right: 10px;"><a href="./tasks.php">TASKS</a>
  </li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

    <h1><u> budgets Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
            
        <label for="bid">budget_id:</label>
        <input type="number" id="bid" name="bid"><br><br>

        <label for="cid">couple_id:</label>
        <input type="number" id="cid" name="cid"><br><br>

        <label for="tob">total_budget:</label>
        <input type="number" id="tob" name="tob" required><br><br>

        <label for=spb>spent_budget:</label>
        <input type="number" id="spb" name="spb" required><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>


<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO budgets(budget_id, couple_id, total_budget, spent_budget) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $bid, $cid, $tob, $spb);
    // Set parameters and execute
    $bid = $_POST['bid'];
    $cid = $_POST['cid'];
    $tob = $_POST['tob'];
    $spb = $_POST['spb'];
    
    if ($stmt->execute() == TRUE) {
        echo "New record has been added successfully";
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
$connection->close();
?>

<?php
include('database_connection.php');

// SQL query to fetch data from the budgets table
$sql = "SELECT * FROM budgets";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of budgets</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <center><h2>Table of budgets</h2></center>
    <table border="5">
        <tr>
            <th>budget_id</th>
            <th>couple_id</th>
            <th>total_budget</th>
            <th>spent_budget</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
     include('database_connection.php');

        // Prepare SQL query to retrieve all budgets
        $sql = "SELECT * FROM budgets";
        $result = $connection->query($sql);

        // Check if there are any budgets
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $bid = $row['budget_id']; // Fetch the budget_id
                echo "<tr>
                    <td>" . $row['budget_id'] . "</td>
                    <td>" . $row['couple_id'] . "</td>
                    <td>" . $row['total_budget'] . "</td>
                    <td>" . $row['spent_budget'] . "</td>
                    <td><a style='padding:4px' href='delete_budgets.php?budget_id=$bid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_budgets.php?budget_id=$bid'>Update</a></td> 
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No data found</td></tr>";
        }
        // Close the database connection
        $connection->close();
        ?>
    </table>
</body>

    </section>


  
<footer>
  <center> 
    <marquee behavior='alternate'>
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Beula UWUMUGISHA</h2></b>
  </marquee>
  </center>
</footer>
</body>
</html>