<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulau Komodo - Melihat Kritik & Saran</title>
    <link rel="stylesheet" href="main.css">
    <script src="bootstrap.bundle.min.js"></script>
    <style>
        .alert-container {
            margin: 10px auto;
            max-width: 600px;
        }

        .navbar-collapse-left {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            background-color: #343a40;
            z-index: 1040;
            overflow-y: auto;
        }

        .profile-section {
            text-align: center;
        }

        .profile-section h5 {
            font-size: 1.5rem;
        }

        .profile-section .text-body-secondary {
            display: block;
            font-size: 1.2rem;
            margin-top: 10px;
        }

        .nav-link {
            transition: transform 0.2s, background-color 0.2s;
        }

        .nav-link:hover {
            transform: translateX(10px);
            background-color: #495057;
        }

        .nav-link:active {
            transform: scale(0.95);
        }

        body {
            animation: fadeIn 2s ease-in-out, blink 1.5s infinite;
            background-image: url('../img/backgroundtiket.jpg');
            height: 720px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
        }

        .table-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            margin-top: 100px;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            color: black;
        }

        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #343a40;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="collapse navbar-collapse-left" id="navbarToggleExternalContent" data-bs-theme="dark">
        <div class="bg-dark p-4 profile-section">
            <h5 class="text-body-emphasis h4">Profile</h5>
            <img src="../img/profiladmin.jpg" class="img-thumbnail rounded-circle mb-2" alt="Profile Picture">
            <span class="text-body-secondary">Admin</span>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link text-light" href="Admin.html">Menu Utama</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="Melihattiket.php">Melihat Tiket</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="Melihatpesanan.php">Melihat Pesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light rounded-2" style="background-color: cyan;" href="Melihatkritik.php">Melihat Kritik & Saran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="LoginAdmin.php">Log Out</a>
            </li>
        </ul>
    </div>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" id="navbarToggleButton" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="table-container">
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

        // Handle delete request
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
            $id = intval($_POST["id"]);
            $delete_sql = "DELETE FROM feedback WHERE id=?";
            $stmt = $conn->prepare($delete_sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
        }

        $sql = "SELECT id, name, feedback FROM feedback";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Nama</th><th>Kritik & Saran</th><th>Hapus</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . htmlspecialchars($row["name"]) . "</td><td>" . htmlspecialchars($row["feedback"]) . "</td>";
                echo "<td><form method='POST' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
                echo "<input type='hidden' name='id' value='" . htmlspecialchars($row["id"]) . "'>";
                echo "<button type='submit' name='delete' class='delete-button'>Delete</button>";
                echo "</form></td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Tidak ada masukkan yang tersedia</p>";
        }

        $conn->close();
        ?>
    </div>
</body>

</html>
