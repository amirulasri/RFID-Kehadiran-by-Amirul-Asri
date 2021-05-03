<?php
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
                if(isset($_GET['tukarrfidpengguna'])){
                ?>
                <!-- Kemaskini RFID -->
                <form action="prosesubahrfidpengguna.php" method="post">
                <input type="hidden" name="nokp" value="<?php echo $_GET['nokp'] ?>">
                    <h2 class="titlecolor">SENTUH RFID YANG BARU PADA READER</h2>
                    <p>Sebaik sahaja anda menukar kad RFID baru, kad yang lama akan dipadamkan.</p>
                    <input class="rfidinput" type="text" id="rfid" name="rfid" required autofocus>
                </form>

                <?php } ?>
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