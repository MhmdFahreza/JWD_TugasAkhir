<?php
$ticketId = $_POST['ticketId'] ?? '';
$status = $_POST['status'] ?? '';

$host = 'localhost';
$db = 'pulau_komodo';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$stmt = $mysqli->prepare("UPDATE tiket SET status = ? WHERE id = ?");
$stmt->bind_param("si", $status, $ticketId);

if ($stmt->execute()) {
    echo "Status berhasil diperbarui!";
} else {
    echo "Terjadi kesalahan. Status gagal diperbarui.";
}

$stmt->close();
$mysqli->close();
?>
