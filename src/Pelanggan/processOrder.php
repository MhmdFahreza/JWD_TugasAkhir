<?php
header('Content-Type: application/json');

$host = 'localhost';
$db = 'pulau_komodo';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

// Get POST data
$postData = file_get_contents("php://input");
$request = json_decode($postData, true);

if ($request && isset($request['orderName'])) {
    $orderName = $mysqli->real_escape_string($request['orderName']);
    
    // Query to fetch order details
    $query = "SELECT * FROM tiket WHERE name = '$orderName'";
    $result = $mysqli->query($query);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $response = [
            'success' => true,
            'name' => $row['name'],
            'date' => $row['date'],
            'people' => $row['people'],
            'totalPrice' => $row['total_price']
        ];
    } else {
        $response = ['success' => false, 'message' => 'Nama pesanan tidak ada'];
    }
    
    echo json_encode($response);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$mysqli->close();
?>
