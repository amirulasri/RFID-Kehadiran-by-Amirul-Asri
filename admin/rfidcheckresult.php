<?php
include('../conn.php');
session_start();
if (isset($_SESSION['admin'])) {
} else {
    header("location:login");
}
$rfid = "";
if (isset($_GET['rfid']) && !empty($_GET['rfid'])) {
    $rfid = $_GET['rfid'];
    $queryrfid = mysqli_query($conn, "SELECT * FROM pengguna WHERE rfid='$rfid'");
    if (mysqli_num_rows($queryrfid) == 0) {
        echo '<script>alert("Kad yang anda sentuh pada pembaca masih belum didaftar ke dalam sistem. (KAD BARU)"); window.location="rfid?checkrfid=1";</script>';
    } else {
        $getdatarfid = mysqli_fetch_assoc($queryrfid);
        $nama = $getdatarfid['nama'];
        $kppengguna = $getdatarfid['kppengguna'];
        $notel = $getdatarfid['notel'];
        $emel = $getdatarfid['emel'];
        $jantina = $getdatarfid['jantina'];
    }
} else {
    echo '<script>alert("Berlaku masalah pada mendapatkan ID kad. Cuba semula."); window.location="rfid?checkrfid=1";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=8.0">
    <title>Admin <?php echo $namasistem; ?></title>
    <script src="../jquery/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/interface.css">
    <script src="../js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg <?php if ($jenismod == 'on') {
                                                        echo 'navbar-dark bg-dark';
                                                    } else {
                                                        echo 'navbar-light bg-light';
                                                    } ?>">
        <a class="navbar-brand" href="#"><?php echo $namasistem; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Laman Utama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pengguna">Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kehadirankeseluruhan">Rekod kehadiran</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="rfid?checkrfid=1">Periksa RFID</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logkeluar">Log Keluar</a>
                </li>
            </ul>
        </div>
    </nav>

    <br><br>
    <div class="rfidcontainer">
        <div class="rfidcontainer2">
            <div class="rfidinterface">
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th colspan="2">Data pengguna pada kad RFID</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="table-primary">
                            <td>Nama</td>
                            <td><?php echo $nama; ?></td>
                        </tr>
                        <tr class="table-primary">
                            <td>RFID</td>
                            <td><?php echo $rfid ?></td>
                        </tr>
                        <tr class="table-primary">
                            <td>Nombor Kad Pengenalan</td>
                            <td><?php echo $kppengguna ?></td>
                        </tr>
                        <tr class="table-warning">
                            <td>Nombor Telefon</td>
                            <td><?php if (empty($notel)) {
                                    echo "Tiada";
                                } else {
                                    echo $notel;
                                } ?></td>
                        </tr>
                        <tr class="table-warning">
                            <td>E-Mel</td>
                            <td><?php if (empty($emel)) {
                                    echo "Tiada";
                                } else {
                                    echo $emel;
                                } ?></td>
                        </tr>
                        <tr class="table-danger">
                            <td>Jantina</td>
                            <td><?php echo $jantina ?></td>
                        </tr>
                    </tbody>
                </table>
                <p>* Anda boleh terus menyentuh KAD yang lain pada pembaca untuk mendapatkan data pengguna yang seterusnya</p>
                <form action="rfidcheckresult" method="get">
                    <input type="text" name="rfid" id="rfid" style="background: none; border:none; outline:none;">
                </form>
            </div>
        </div>
    </div>
    <script>
        function inputFocus() {
            document.getElementById("rfid").focus();
        }
        window.onkeydown = inputFocus;
    </script>
</body>