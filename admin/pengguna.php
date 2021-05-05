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
                <li class="nav-item">
                    <a class="nav-link" href="index">Laman Utama</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#">Pengguna</a>
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
                <h2 class="titlecolor">Pengguna <?php echo $namasistem ?></h2>
                <button class="btn btn-primary" data-toggle="modal" data-target="#tambahpenggunabaru">Tambah Pengguna Baru +</button><br><br>
                <table class="table">
                    <thead class="table-dark">
                        <tr>
                            <th>Nama</th>
                            <th>Jantina</th>
                            <th>Menu</th>
                        </tr>
                    </thead>
                    <tbody class="table-primary">
                        <?php
                        $querylistpengguna = mysqli_query($conn, "SELECT * FROM pengguna");
                        while ($getdatapelanggan = mysqli_fetch_array($querylistpengguna)) {
                        ?>
                            <tr>
                                <td><?php echo $getdatapelanggan['nama']; ?></td>
                                <td><?php echo $getdatapelanggan['jantina']; ?></td>
                                <td><button class="btn btn-secondary" id="<?php echo $getdatapelanggan['kppengguna']; ?>" onclick="papardatasemasa(this.id)" data-toggle="modal" data-target="#editpengguna">Edit</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                <div id="ruangloader"></div>
            </div>
        </div>
    </div>

    <!-- Modal tambah pengguna baru -->
    <div class="modal fade" id="tambahpenggunabaru" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="rfid.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="prosespengguna" value="daftarbaru">
                        <label for="">Nama:</label>
                        <input type="text" class="form-control" name="nama" required><br>
                        <label for="">Nombor Kad Pengenalan</label>
                        <input type="text" class="form-control" name="nokp" required><br>
                        <label for="">Jantina</label>
                        <select name="jantina" class="form-control" id="" required>
                            <option value="">--Jantina--</option>
                            <option value="Lelaki">Lelaki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select><br>
                        <label for="">Nombor telefon (Jika ada)</label>
                        <input type="text" class="form-control" name="notel"><br>
                        <label for="">E-Mel (Jika ada)</label>
                        <input type="text" class="form-control" name="emel">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <input type="submit" class="btn btn-primary" value="Seterusnya (RFID)">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal edit pengguna -->
    <div class="modal fade" id="editpengguna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Pengguna</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="ruangeditpengguna">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function loader(id) {
            document.getElementById('ruangloader').innerHTML = '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>';
        }

        function papardatasemasa(str) {
            if (str == "") {
                document.getElementById("ruangeditpengguna").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("ruangeditpengguna").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "ajaxeditdatapengguna.php?nokp=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</body>

</html>