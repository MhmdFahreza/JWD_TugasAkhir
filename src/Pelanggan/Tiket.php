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
    while ($row = $result->fetch_assoc()) {
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
  <title>Pulau Komodo</title>
  <link rel="stylesheet" href="main.css">
  <script src="bootstrap.bundle.min.js"></script>
  <style>
    @keyframes menuClick {
      0% {
        transform: scale(1);
      }

      50% {
        transform: scale(1.1);
      }

      100% {
        transform: scale(1);
      }
    }

    .nav-link.active {
      animation: menuClick 0.8s ease-in-out;
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

    .navbar {
      background-color: rgba(227, 242, 253, 0.8);
      animation: fadeIn 2s ease-in-out;
    }

    .modal-content {
      color: #000;
    }

    .btn-primary {
      animation: buttonShake 10s infinite alternate;
    }

    h2 {
      animation: titleBounce 7s infinite alternate;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }

    @keyframes fadeOut {
      from {
        opacity: 1;
      }

      to {
        opacity: 0;
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

    @keyframes buttonShake {
      0% {
        transform: translateX(0);
      }

      25% {
        transform: translateX(-5px);
      }

      50% {
        transform: translateX(5px);
      }

      75% {
        transform: translateX(-5px);
      }

      100% {
        transform: translateX(0);
      }
    }

    @keyframes titleBounce {
      0% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-10px);
      }

      100% {
        transform: translateY(0);
      }
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
      <img src="../img/logo.png" class="navbar-brand ms-5" alt="Bootstrap" width="60" height="60">
      <a class="navbar-brand ms-lg-12" href="#">Pulau Komodo</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item ms-3">
            <a class="nav-link" aria-current="page" href="Beranda.html">Beranda</a>
          </li>
          <li class="nav-item ms-3">
            <a class="nav-link" href="Tentang.html">Tentang</a>
          </li>
          <li class="nav-item ms-3">
            <a class="nav-link active rounded-top-2" style="background-color: #0288d1;" href="Tiket.html">Tiket</a>
          </li>
          <li class="nav-item ms-3">
            <a class="nav-link" href="Pemesanan.html">Pemesanan</a>
          </li>
          <li class="nav-item dropdown ms-3">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Informasi
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="Berita.html">Berita</a></li>
              <li><a class="dropdown-item" href="jenisKomodo.html">Jenis Hewan</a></li>
              <li><a class="dropdown-item" href="Kritikdansaran.html">Kritik & Saran</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <h2>Pembelian Tiket</h2>
    <br>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#ticketModal">+ Beli Tiket</button>

    <table class="table" id="ticketTable">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nama</th>
          <th scope="col">Tanggal Pembelian</th>
          <th scope="col">Jumlah Orang</th>
          <th scope="col">Status</th>
          <th scope="col">Ubah</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tickets as $index => $ticket) : ?>
        <tr data-id="<?= $ticket['id'] ?>">
          <th scope="row"><?= $index + 1 ?></th>
          <td class="name"><?= htmlspecialchars($ticket['name']) ?></td>
          <td class="date"><?= htmlspecialchars($ticket['date']) ?></td>
          <td class="people"><?= htmlspecialchars($ticket['people']) ?></td>
          <td class="status"><?= htmlspecialchars($ticket['status']) ?></td>
          <td>
            <button class="btn btn-warning btn-edit" data-id="<?= $ticket['id'] ?>">Edit</button>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <div class="modal fade" id="ticketModal" tabindex="-1" aria-labelledby="ticketModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ticketModalLabel">Pembelian Tiket</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
              <input type="hidden" id="ticketId" name="ticketId">
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nama Anda">
              </div>
              <div class="mb-3">
                <label for="date" class="form-label">Tanggal Pembelian Tiket</label>
                <input type="date" class="form-control" id="date" name="date">
              </div>
              <div class="mb-3">
                <label for="people" class="form-label">Jumlah Orang</label>
                <input type="number" class="form-control" id="people" name="people" placeholder="Jumlah Orang" min="1">
              </div>
              <div class="mb-3">
                <label class="form-label">Total Harga</label>
                <p id="totalPrice" class="form-control-plaintext">Rp. 0</p>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="saveButton">Simpan</button>
            <div id="confirmationMessage" class="text-warning mt-2"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const navLinks = document.querySelectorAll('.nav-link');
      const peopleInput = document.getElementById('people');
      const totalPriceOutput = document.getElementById('totalPrice');
      const pricePerPerson = 20000;
      const ticketTableBody = document.querySelector('#ticketTable tbody');

      navLinks.forEach(link => {
        link.addEventListener('click', function () {
          navLinks.forEach(link => link.classList.remove('active'));
          this.classList.add('active');
        });
      });

      peopleInput.addEventListener('input', function () {
        const numberOfPeople = parseInt(peopleInput.value) || 0;
        const totalPrice = numberOfPeople * pricePerPerson;
        totalPriceOutput.textContent = `Rp. ${totalPrice.toLocaleString()}`;
      });

      $('#saveButton').on('click', function () {
        const ticketId = $('#ticketId').val();
        const name = $('#name').val();
        const date = $('#date').val();
        const people = $('#people').val();
        const totalPrice = $('#totalPrice').text();

        if (name && date && people) {
          const confirmation = confirm('Apakah Anda sudah yakin?');
          if (confirmation) {
            $.ajax({
              url: '/JWD_TugasAkhir/src/Pelanggan/simpan_tiket.php',
              method: 'POST',
              data: {
                ticketId: ticketId,
                name: name,
                date: date,
                people: people,
                totalPrice: totalPrice
              },
              success: function (response) {
                $('#confirmationMessage').text(response);
                $('#confirmationMessage').css('color', 'green');
                $('#ticketModal').modal('hide');

                if (ticketId) {
                  // Edit existing entry
                  const row = document.querySelector(`tr[data-id='${ticketId}']`);
                  row.querySelector('.name').textContent = name;
                  row.querySelector('.date').textContent = date;
                  row.querySelector('.people').textContent = people;
                } else {
                  // Add new entry
                  const newRow = document.createElement('tr');
                  const id = new Date().getTime();
                  newRow.setAttribute('data-id', id);
                  newRow.innerHTML = `
                    <th scope="row">${ticketTableBody.children.length + 1}</th>
                    <td class="name">${name}</td>
                    <td class="date">${date}</td>
                    <td class="people">${people}</td>
                    <td class="status">Menunggu</td>
                    <td>
                      <button class="btn btn-warning btn-edit" data-id="${id}">Edit</button>
                    </td>
                  `;
                  ticketTableBody.appendChild(newRow);
                }
              },
              error: function (xhr, status, error) {
                $('#confirmationMessage').text('Terjadi kesalahan. Data gagal disimpan.');
                $('#confirmationMessage').css('color', 'red');
              }
            });
          }
        } else {
          alert('Harap isi semua bidang.');
        }
      });

      ticketTableBody.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-edit')) {
          const row = event.target.closest('tr');
          const id = row.getAttribute('data-id');
          const name = row.querySelector('.name').textContent;
          const date = row.querySelector('.date').textContent;
          const people = row.querySelector('.people').textContent;

          $('#ticketId').val(id);
          $('#name').val(name);
          $('#date').val(date);
          $('#people').val(people);
          $('#totalPrice').text(`Rp. ${(parseInt(people) * pricePerPerson).toLocaleString()}`);

          $('#ticketModal').modal('show');
        }
      });
    });
  </script>
</body>

</html>
