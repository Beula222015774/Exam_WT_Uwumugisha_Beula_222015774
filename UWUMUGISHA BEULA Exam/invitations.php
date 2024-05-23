<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Our Invitations</title>
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
  </head>

  <header>

<body bgcolor="skyblue">
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
    
  </ul>

</header>
<section>

    <h1><u> invitations Form </u></h1>
    <form method="post" onsubmit="return confirmInsert();">
            
        <label for="iid">invitation_id:</label>
        <input type="number" id="iid" name="iid"><br><br>

        <label for="gid">guest_id:</label>
        <input type="number" id="gid" name="gid"><br><br>

        <label for="event_id">event_id:</label>
        <input type="number" id="eid" name="eid" required><br><br>

        <input type="submit" name="add" value="Insert">
      

    </form>


<?php
include('database_connection.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $connection->prepare("INSERT INTO invitations(invitation_id, guest_id, event_id) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $iid, $gid, $eid);
    // Set parameters and execute
    $iid = $_POST['iid'];
    $gid = $_POST['gid'];
    $eid = $_POST['eid'];
   
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

// SQL query to fetch data from the invitations table
$sql = "SELECT * FROM invitations";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of invitations</title>
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
    <center><h2>Table of invitations</h2></center>
    <table border="5">
        <tr>
            <th>invitation_id</th>
            <th>guest_id</th>
            <th>event_id</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>
        <?php
      include('database_connection.php');

        // Prepare SQL query to retrieve all invitations
        $sql = "SELECT * FROM invitations";
        $result = $connection->query($sql);

        // Check if there are any invitations
        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $iid = $row['invitation_id']; // Fetch the invitation_id
                echo "<tr>
                    <td>" . $row['invitation_id'] . "</td>
                    <td>" . $row['guest_id'] . "</td>
                    <td>" . $row['event_id'] . "</td>
                    <td><a style='padding:4px' href='delete_invitations.php?invitation_id=$iid'>Delete</a></td> 
                    <td><a style='padding:4px' href='update_invitations.php?invitation_id=$iid'>Update</a></td> 
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