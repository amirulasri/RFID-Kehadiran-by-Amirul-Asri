<?php
include('../conn.php');
session_start();
if (isset($_SESSION['admin'])) {
} else {
    header("location:login");
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Laman Utama</a>
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
                    <a class="nav-link" href="logkeluar" onclick="return confirm('Adakah anda pasti ingin mengelog keluar?')">Log Keluar</a>
                </li>
            </ul>
        </div>
    </nav>

    <br><br>
    <div class="rfidcontainer">
        <div class="rfidcontainer2">
            <div class="rfidinterface">
                <table>
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</body>

</html>