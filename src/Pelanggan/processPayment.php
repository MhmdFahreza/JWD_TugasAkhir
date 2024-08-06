<?php
$host = 'localhost';
$db = 'pulau_komodo';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$required_fields = ['customerName', 'purchaseDate', 'peopleCount', 'totalPrice', 'adminName', 'virtualAccount', 'orderId'];

foreach ($required_fields as $field) {
    if (!isset($_POST[$field])) {
        die("Error: Missing $field in form submission");
    }
}

$customerName = $mysqli->real_escape_string($_POST['customerName']);
$purchaseDate = $mysqli->real_escape_string($_POST['purchaseDate']);
$peopleCount = $mysqli->real_escape_string($_POST['peopleCount']);
$totalPrice = $mysqli->real_escape_string($_POST['totalPrice']);
$adminName = $mysqli->real_escape_string($_POST['adminName']);
$virtualAccount = $mysqli->real_escape_string($_POST['virtualAccount']);
$orderId = $mysqli->real_escape_string($_POST['orderId']);

$targetDir = "uploads/";
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

if ($_FILES['paymentProof']['error'] === UPLOAD_ERR_OK) {
    $targetFile = $targetDir . basename($_FILES["paymentProof"]["name"]);
    move_uploaded_file($_FILES["paymentProof"]["tmp_name"], $targetFile);

    $query = "UPDATE pembayaran SET paymentProof='$targetFile', status='Lunas' WHERE id='$orderId'";

    if ($mysqli->query($query) === TRUE) {
        echo "Pembayaran berhasil diperbarui.";
    } else {
        echo "Error: " . $mysqli->error;
    }
} else {
    echo "Error uploading file.";
}

$mysqli->close();

?>
