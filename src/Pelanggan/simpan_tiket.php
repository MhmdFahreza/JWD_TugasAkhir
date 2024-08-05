<?php
$host = 'localhost';
$db = 'pulau_komodo';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$ticketId = $_POST['ticketId'];
$name = $_POST['name'];
$date = $_POST['date'];
$people = $_POST['people'];
$totalPrice = $_POST['totalPrice'];

if ($ticketId) {
    // Update existing ticket
    $stmt = $mysqli->prepare("UPDATE tiket SET name = ?, date = ?, people = ?, status = 'Menunggu' WHERE id = ?");
    $stmt->bind_param('ssii', $name, $date, $people, $ticketId);
    if ($stmt->execute()) {
        echo 'Data tiket berhasil diperbarui.';
    } else {
        echo 'Terjadi kesalahan saat memperbarui data tiket.';
    }
    $stmt->close();
} else {
    // Insert new ticket
    $stmt = $mysqli->prepare("INSERT INTO tiket (name, date, people, status) VALUES (?, ?, ?, 'Menunggu')");
    $stmt->bind_param('ssi', $name, $date, $people);
    if ($stmt->execute()) {
        echo 'Tiket berhasil ditambahkan.';
        echo "<form action='Melihatkritik.php' method='get'>
                <button type='submit'>Back</button>
              </form>";
    } else {
        echo 'Terjadi kesalahan saat menambahkan tiket.';
    }
    $stmt->close();
}

$mysqli->close();
?>
