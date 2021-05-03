<?php
include('../conn.php');
$nokp = $_GET['nokp'];
$query = mysqli_query($conn, "SELECT * FROM pengguna WHERE kppengguna = '$nokp'");
$getdatapelanggan = mysqli_fetch_assoc($query);
?>

<form action="prosesupdatepengguna.php" method="post">
    <input type="hidden" name="nokplama" value="<?php echo $getdatapelanggan['kppengguna'] ?>">
    <label for="">Nama:</label>
    <input type="text" class="form-control" value="<?php echo $getdatapelanggan['nama'] ?>" name="nama" required><br>
    <label for="">Nombor Kad Pengenalan</label>
    <input type="text" class="form-control" value="<?php echo $getdatapelanggan['kppengguna'] ?>" name="nokp" required><br>
    <label for="">Jantina</label>
    <select name="jantina" class="form-control" id="" required>
        <option value="">--Jantina--</option>
        <option value="Lelaki" <?php if($getdatapelanggan['jantina'] == 'Lelaki'){echo 'selected';} ?>>Lelaki</option>
        <option value="Perempuan" <?php if($getdatapelanggan['jantina'] == 'Perempuan'){echo 'selected';} ?>>Perempuan</option>
    </select><br>
    <label for="">Nombor telefon (Jika ada)</label>
    <input type="text" class="form-control" value="<?php echo $getdatapelanggan['notel'] ?>" name="notel"><br>
    <label for="">E-Mel (Jika ada)</label>
    <input type="text" class="form-control" value="<?php echo $getdatapelanggan['emel'] ?>" name="emel"><br>
    <input type="submit" value="Kemaskini" class="btn btn-primary btn-block"><br>
    <a href="rfid?tukarrfidpengguna=1&nokp=<?php echo $nokp; ?>">Tukar kad RFID baru</a>
</form>