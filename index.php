<?php
include('conn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekod <?php echo $namasistem; ?></title>
    <script src="jquery/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: rgb(38, 38, 38);
        }

        .rfidinput {
            width: 90%;
            height: 70px;
            font-size: 40px;
            text-align: center;
            border-radius: 40px;
            border: none;
            outline: none;
        }

        .containerrfid {
            text-align: center;
        }

        .containerrfid2 {
            padding-left: 5%;
            padding-right: 5%;
        }

        .jam {
            font-size: 25px;
            color: black;
            background-color: lightskyblue;
            display: inline;
            border-radius: 25px;
            padding: 9px;
        }

        .ruangmesej {
            float: right;
            position: relative;
            top: 53px;
            right: 11px;
        }
    </style>
</head>

<body>
    <br>
    <h1 style="color:white; text-align:center;"><?php echo $namasistem ?></h1>
    <p style="color:white; text-align:center;">Sentuh kad RFID pada pembaca, data anda diproses secara automatik</p>
    <div class="containerrfid2">
        <div class="ruangmesej">
            <p id="jam" class="jam"></p>&nbsp;
            <p class="jam" id="tarikh">Tarikh</p>
        </div>
    </div>
    <div class="containerrfid">
        <form action="daftarrekodkehadiran.php" onsubmit="matikaninput()" method="post">
            <input type="password" name="rfid" class="rfidinput" id="rfid" autofocus required>
        </form>
    </div><br>
    <div class="containerrfid2">
        <div class="containerrfidtable">
            <?php
            $errorno = "";
            if (isset($_GET['fail'])) {
                $errorno = $_GET['fail'];

                if ($errorno == '1452') {
            ?>
                    <div style="text-align: center; font-size:20px;" class="alert alert-danger" id="mesejsistem" role="alert">
                        <b>KAD yang disentuh tidak SAH</b>

                    <?php } else { ?>
                        <b>Terdapat masalah pada penyimpanan data, data tidak dapat direkodkan. Cuba semula. Jika berterusan, hubungi Admin</b>
                <?php }
            } ?>

                    </div>
                    <?php
                    if (isset($_GET['masaduplicate'])) {
                        $masasemasa = date('s');
                        $hasilmasatinggal = 60 - intval($masasemasa);
                    ?>
                        <div style="text-align: center; font-size:20px;" class="alert alert-danger" id="mesejsistem" role="alert">
                            <b>Anda sentuh kad lebih dari satu kali pada masa yang sama. Cuba semula selepas <?php echo $hasilmasatinggal ?> Saat.</b>
                        </div>
                    <?php
                    }
                    ?>
                    <?php
                    $querymax = mysqli_query($conn, "SELECT MAX(id) AS idakhir FROM rekodkehadiran");
                    $getdatamax = mysqli_fetch_assoc($querymax);
                    $idakhir = $getdatamax['idakhir'];
                    ?>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th>Nama</th>
                                <th>Tarikh</th>
                                <th>Masa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $querylistrekod = mysqli_query($conn, "SELECT * FROM rekodkehadiran INNER JOIN pengguna ON pengguna.rfid = rekodkehadiran.rfid ORDER BY id DESC LIMIT 10");
                            while ($getdatarekod = mysqli_fetch_array($querylistrekod)) {
                            ?>
                                <tr class="<?php if ($getdatarekod['id'] == $idakhir) {
                                                echo 'table-light';
                                            } else {
                                                echo 'table-primary';
                                            } ?>" style="<?php if ($getdatarekod['id'] == $idakhir) {
                                                                echo 'font-size: 30px;';
                                                            } ?>">
                                    <td><?php echo $getdatarekod['nama'];
                                        if ($getdatarekod['id'] == $idakhir) {
                                            echo ' <b>(Terkini)</b>';
                                        } ?></td>
                                    <td><?php $tarikhsemasa = $getdatarekod['tarikh'];
                                        $date = new DateTime($tarikhsemasa);
                                        echo $date->format('d-m-Y');
                                        ?></td>
                                    <td><?php echo $getdatarekod['masa'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
        </div>
    </div>

    <script>
        function inputFocus() {
            document.getElementById("rfid").focus();
        }
        window.onkeydown = inputFocus;

        $("#mesejsistem").fadeTo(5000, 500).slideUp(300, function() {
            $("#mesejsistem").slideUp(500);
        });

        function matikaninput() {
            var inputrfid = document.getElementById("rfid").setAttribute('readonly', 'true');
        }


        function jam() {
            var date = new Date(),
                hour = date.getHours(),
                minute = checkTime(date.getMinutes()),
                ss = checkTime(date.getSeconds());

            function checkTime(i) {
                if (i < 10) {
                    i = "0" + i;
                }
                return i;
            }

            if (hour > 12) {
                hour = hour - 12;
                if (hour == 12) {
                    hour = checkTime(hour);
                    document.getElementById("jam").innerHTML = hour + ":" + minute + ":" + ss + " AM";
                } else {
                    hour = checkTime(hour);
                    document.getElementById("jam").innerHTML = hour + ":" + minute + ":" + ss + " PM";
                }
            } else {
                document.getElementById("jam").innerHTML = hour + ":" + minute + ":" + ss + " AM";;
            }
            var time = setTimeout(jam, 500);
        }

        jam();

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = dd + '-' + mm + '-' + yyyy;
        document.getElementById("tarikh").innerHTML = today;
    </script>
</body>

</html>