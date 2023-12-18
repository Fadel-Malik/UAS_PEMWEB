<?php
include "connectDB.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Data</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .title {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-top: 20px;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        a {
            text-decoration: none;
            color: white;
            background-color: #4caf50;
            padding: 10px 20px;
            border-radius: 4px;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    ?>

    <div class="title">
        <?php
        if (isset($_SESSION['user_data']) && isset($_SESSION['user_data']['name'])) {
            $userName = $_SESSION['user_data']['name'];
            echo "<h2>Welcome, $userName!</h2>";
        } else {
            echo "<h2>User Data</h2>";
        }
        ?>

    </div>

    <?php
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subscribe</th>
                    <th>Gender</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['subscribe']}</td>
                    <td>{$row['gender']}</td>
                </tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='text-align: center;'>0 results</p>";
    }

    $conn->close();
    ?>
    <a href="index.html">Back To Form</a>
</body>

</html>