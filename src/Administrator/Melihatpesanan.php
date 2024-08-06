<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Melihat Pesanan</title>
    <link rel="stylesheet" href="main.css">
    <script src="bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <style>
        .table-container {
            margin: 20px;
        }

        .img-zoom {
            cursor: pointer;
            transition: transform 0.2s ease-in-out;
        }

        .img-zoom:hover {
            transform: scale(1.5);
        }

        .zoom-modal .modal-dialog {
            max-width: 90%;
        }

        .zoom-modal .modal-content {
            background: transparent;
            border: none;
        }

        .zoom-modal .modal-body {
            text-align: center;
        }

        .zoom-modal .modal-body img {
            max-width: 100%;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" id="navbarToggleButton" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

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
                <a class="nav-link text-light rounded-2" style="background-color: cyan;" href="Melihatpesanan.php">Melihat Pesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="Melihatkritik.php">Melihat Kritik & Saran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="LoginAdmin.php">Log Out</a>
            </li>
        </ul>
    </div>

    <div class="table-container">
        <h2 class="text-center">Daftar Pesanan</h2>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Status Pembayaran</th>
                    <th>Bukti Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = 'localhost';
                $db = 'pulau_komodo';
                $user = 'root';
                $pass = '';

                // Create connection
                $mysqli = new mysqli($host, $user, $pass, $db);

                // Check connection
                if ($mysqli->connect_error) {
                    die("Koneksi gagal: " . $mysqli->connect_error);
                }

                // Query to fetch data
                $query = "SELECT * FROM pembayaran";
                $result = $mysqli->query($query);

                if (!$result) {
                    die("Query gagal: " . $mysqli->error);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $status = $row['paymentProof'] ? 'Lunas' : 'Belum Lunas';
                        $paymentProof = $row['paymentProof'] ? '<a href="#" class="img-zoom" data-bs-toggle="modal" data-bs-target="#zoomModal" data-img="' . $row['paymentProof'] . '">Lihat Bukti</a>' : 'Tidak Ada Bukti';

                        echo "<tr>
                                <td>{$row['customerName']}</td>
                                <td>{$row['purchaseDate']}</td>
                                <td>$status</td>
                                <td>$paymentProof</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data.</td></tr>";
                }

                $mysqli->close();
                ?>
            </tbody>
        </table>
    </div>

    <!-- Modal for Zoom Image -->
    <div class="modal fade zoom-modal" id="zoomModal" tabindex="-1" aria-labelledby="zoomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img id="zoomImg" src="" alt="Bukti Pembayaran">
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.img-zoom').forEach(item => {
            item.addEventListener('click', function () {
                const imgSrc = this.getAttribute('data-img');
                document.getElementById('zoomImg').setAttribute('src', imgSrc);
            });
        });

        // Example for form submission confirmation
        const form = document.querySelector('form');
        if (form) {
            form.addEventListener('submit', function(event) {
                const confirmSubmit = confirm("Apakah Anda yakin ingin mengirim bukti pembayaran?");
                if (!confirmSubmit) {
                    event.preventDefault(); // Cancel form submission if user is not sure
                }
            });
        }
    });
</script>

</body>

</html>
