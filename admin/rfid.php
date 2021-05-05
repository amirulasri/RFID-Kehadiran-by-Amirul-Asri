<?php
include('../conn.php');

session_start();
if (isset($_SESSION['admin'])) {
} else {
    header("location:login");
}

$prosespengguna = "";
if (isset($_POST['prosespengguna'])) {
    $prosespengguna = $_POST['prosespengguna'];
    if ($prosespengguna == 'daftarbaru') {
        $nama = $_POST['nama'];
        $jantina = $_POST['jantina'];
        $nokp = $_POST['nokp'];

        $notel = NULL;
        $emel = NULL;
        if (isset($_POST['emel'])) {
            $emel = $_POST['emel'];
        }
        if (isset($_POST['notel'])) {
            $notel = $_POST['notel'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SENTUH RFID</title>
    <script src="../jquery/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/interface.css">
    <script src="../js/bootstrap.min.js"></script>
    <style>
        .rfidinput {
            width: 60%;
            height: 70px;
            text-align: center;
            font-size: 40px;
        }
    </style>
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
                    <a class="nav-link" href="index">Laman Utama</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="pengguna">Pengguna</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kehadirankeseluruhan">Rekod kehadiran</a>
                </li>
                <li class="nav-item">
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
            <div class="rfidinterface" style="text-align: center;">
                <?php
                if ($prosespengguna == 'daftarbaru') {
                ?>
                    <form action="prosesdaftarpengguna.php" method="post">
                        <input type="hidden" name="nama" value="<?php echo $nama ?>">
                        <input type="hidden" name="nokp" value="<?php echo $nokp ?>">
                        <input type="hidden" name="jantina" value="<?php echo $jantina ?>">
                        <input type="hidden" name="notel" value="<?php echo $notel ?>">
                        <input type="hidden" name="emel" value="<?php echo $emel ?>">
                        <h2 class="titlecolor">SENTUH RFID BARU PADA READER</h2>
                        <input class="rfidinput" type="text" id="rfid" name="rfid" required autofocus>
                    </form>
                <?php } ?>

                <?php
                if (isset($_GET['tukarrfidpengguna'])) {
                    $nokpget = $_GET['nokp'];
                    $querynama = mysqli_query($conn, "SELECT * FROM pengguna WHERE kppengguna = '$nokpget'");
                    $getdatanama = mysqli_fetch_assoc($querynama);
                    $namapengguna = $getdatanama['nama'];
                ?>
                    <!-- Kemaskini RFID -->
                    <form action="prosesubahrfidpengguna.php" method="post">
                        <input type="hidden" name="nokp" value="<?php echo $nokpget ?>">
                        <h2 class="titlecolor">SENTUH RFID YANG BARU PADA READER</h2>
                        <h4><?php echo $namapengguna; ?></h4>
                        <p>Sebaik sahaja anda menukar kad RFID baru, kad yang lama akan dipadamkan.</p>
                        <input class="rfidinput" type="text" id="rfid" name="rfid" required autofocus>
                    </form>

                <?php } ?>

                <?php
                if (isset($_GET['checkrfid'])) {
                ?>
                    <!-- Periksa RFID sahaja -->
                    <form action="rfidcheckresult.php" method="get">
                        <h2 class="titlecolor">SENTUH RFID PADA READER</h2>
                        <p>Periksa sama ada kad RFID yang disentuh sudah didaftar dalam sistem atau masih baru.</p>
                        <input class="rfidinput" type="text" id="rfid" name="rfid" required autofocus>
                    </form>
                <?php
                }
                ?>
                <div id="ruangloader"></div>
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

</html>