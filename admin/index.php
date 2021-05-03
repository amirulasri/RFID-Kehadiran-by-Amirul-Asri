<?php
include('../conn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=8.0">
    <title>Admin <?php echo $namasistem; ?></title>
    <link rel="stylesheet" href="../style/bootstrap.css">
    <link rel="stylesheet" href="../style/interface.css">
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
                    <a class="nav-link" data-toggle="modal" data-target="#settings" href="#">Periksa RFID</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logkeluar">Log Keluar</a>
                </li>
            </ul>
        </div>
    </nav>
</body>

</html>