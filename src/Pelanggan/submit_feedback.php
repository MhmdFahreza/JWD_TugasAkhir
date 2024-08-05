<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pulau_komodo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $feedback = $_POST['feedback'];

    $sql = "INSERT INTO feedback (name, feedback) VALUES ('$name', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        echo "pesan masuk sir";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
