<?php
$host = 'localhost';
$db = 'pulau_komodo';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

file_put_contents('debug.log', print_r($_POST, true));

$name = $_POST['name'];
$date = $_POST['date'];
$people = $_POST['people'];
$totalPrice = $_POST['totalPrice'];

$totalPrice = str_replace(['Rp.', ','], '', $totalPrice);

$stmt = $mysqli->prepare("INSERT INTO tiket (name, date, people, total_price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssii", $name, $date, $people, $totalPrice);

if ($stmt->execute()) {
    echo "Data berhasil disimpan!";
} else {
    echo "Terjadi kesalahan. Data gagal disimpan.";
}

$stmt->close();
$mysqli->close();
?>
