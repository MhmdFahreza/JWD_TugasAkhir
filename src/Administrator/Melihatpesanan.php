<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulau Komodo</title>
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

        body {
            animation: fadeIn 2s ease-in-out, blink 1.5s infinite;
            background-image: url('../img/backgroundtiket.jpg');
            height: 720px;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: #fff;
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
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" id="navbarToggleButton" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
</body>

</html>