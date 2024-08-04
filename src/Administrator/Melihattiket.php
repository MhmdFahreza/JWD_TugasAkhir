<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulau Komodo</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        .alert-container {
            margin: 10px auto;
            max-width: 600px;
        }

        .navbar-collapse-left {
            position: fixed;
            top: 0;
            left: 0;
            /* Menempatkan navbar di sisi kiri */
            height: 100%;
            width: 250px;
            background-color: #343a40;
            z-index: 1040;
            /* Memastikan di atas elemen lainnya */
            overflow-y: auto;
            /* Scroll jika konten meluap */
        }

        .profile-section {
            text-align: center;
        }

        .profile-section h5 {
            font-size: 1.5rem;
            /* Memperbesar ukuran font */
        }

        .profile-section .text-body-secondary {
            display: block;
            font-size: 1.2rem;
            /* Memperbesar ukuran font */
            margin-top: 10px;
        }

        .nav-link {
            transition: transform 0.2s, background-color 0.2s;
        }

        .nav-link:hover {
            transform: translateX(10px);
            /* Animasi pada saat hover */
            background-color: #495057;
            /* Warna latar belakang saat hover */
        }

        .nav-link:active {
            transform: scale(0.95);
            /* Animasi saat mengklik */
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
                <a class="nav-link text-light" href="Melihattiket.php">Melihat Tiket</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="Melihatpesanan.php">Melihat Pesanan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="Melihatpembayaran.php">Melihat Pembayaran</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="back.html">Back</a>
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
</body>

</html>