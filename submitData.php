<?php
session_start();
include "connectDB.php";

function saveUserDataToSession($name, $email, $suka, $gender)
{
    $_SESSION['user_data'] = array(
        'name' => $name,
        'email' => $email,
        'suka' => $suka,
        'gender' => $gender,
    );
}

function getUserDataFromSession()
{
    return isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $suka = isset($_POST["suka"]) ? $_POST["suka"] : 0; 
    $gender = isset($_POST["gender"]) ? $_POST["gender"] : null;

    saveUserDataToSession($name, $email, $suka, $gender);

    $sql = "INSERT INTO users (name, email, suka, gender) VALUES ('$name', '$email', $suka, '$gender')";

    if ($conn->query($sql) === TRUE) {
        echo "Data has been submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
