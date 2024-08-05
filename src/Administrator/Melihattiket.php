<?php
$host = 'localhost';
$db = 'pulau_komodo';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}

$result = $mysqli->query("SELECT * FROM tiket");

$tickets = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $tickets[] = $row;
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulau Komodo - Melihat Tiket</title>
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
            height: 100vh;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes blink {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
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
                <a class="nav-link text-light rounded-2" style="background-color: cyan;" href="Melihattiket.php">Melihat Tiket</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="Melihatpesanan.php">Melihat Pesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="Melihatpembayaran.php">Melihat Pembayaran</a>
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

    <div class="container mt-4">
        <h2>Melihat Tiket</h2>
        <table class="table table-dark table-striped mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal Pembelian</th>
                    <th scope="col">Jumlah Orang</th>
                    <th scope="col">Persetujuan</th>
                </tr>
            </thead>
            <tbody id="ticketTableBody">
                <?php foreach ($tickets as $index => $ticket) : ?>
                <tr data-id="<?= $ticket['id'] ?>">
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= $ticket['name'] ?></td>
                    <td><?= $ticket['date'] ?></td>
                    <td><?= $ticket['people'] ?></td>
                    <td>
                        <?php if ($ticket['status'] === 'Menunggu') : ?>
                        <button class="btn btn-success btn-approve">✔️</button>
                        <?php else : ?>
                        Sudah Disetujui
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#ticketTableBody').on('click', '.btn-approve', function() {
                var row = $(this).closest('tr');
                var ticketId = row.data('id');

                $.ajax({
                    url: '/JWD_TugasAkhir/src/Administrator/update_status.php',
                    method: 'POST',
                    data: { ticketId: ticketId, status: 'Diterima' },
                    success: function() {
                        row.find('.btn-approve').replaceWith('Sudah Disetujui');
                    },
                    error: function() {
                        alert('Gagal memperbarui status tiket.');
                    }
                });
            });
        });
    </script>
</body>
</html>