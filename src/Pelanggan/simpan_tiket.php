<?php
$ticketId = $_POST['ticketId'] ?? '';
$name = $_POST['name'] ?? '';
$date = $_POST['date'] ?? '';
$people = $_POST['people'] ?? '';
$totalPrice = $_POST['totalPrice'] ?? '';
$totalPrice = str_replace(['Rp.', ','], '', $totalPrice);

$host = 'localhost';
$db = 'pulau_komodo';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

if ($ticketId) {
    $stmt = $mysqli->prepare("UPDATE tiket SET name = ?, date = ?, people = ?, total_price = ?, status = 'Menunggu' WHERE id = ?");
    $stmt->bind_param("ssiii", $name, $date, $people, $totalPrice, $ticketId);
} else {
    $stmt = $mysqli->prepare("INSERT INTO tiket (name, date, people, total_price, status) VALUES (?, ?, ?, ?, 'Menunggu')");
    $stmt->bind_param("ssii", $name, $date, $people, $totalPrice);
}

if ($stmt->execute()) {
    echo "Data berhasil disimpan!";
} else {
    echo "Terjadi kesalahan. Data gagal disimpan.";
}

$stmt->close();
$mysqli->close();
?>
