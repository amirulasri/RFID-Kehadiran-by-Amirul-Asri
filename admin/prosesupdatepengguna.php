<?php
include('../conn.php');
$nama = $_POST['nama'];
$jantina = $_POST['jantina'];
$nokp = $_POST['nokp'];
$nokplama = $_POST['nokplama'];
$notel = NULL;
$emel = NULL;
if (isset($_POST['emel'])) {
    $emel = $_POST['emel'];
}
if (isset($_POST['notel'])) {
    $notel = $_POST['notel'];
}

$query = mysqli_query($conn, "UPDATE pengguna SET nama='$nama', jantina='$jantina', kppengguna='$nokp', notel='$notel', emel='$emel' WHERE kppengguna='$nokplama'");

if($query){
    echo '<script>alert("Berjaya dikemaskini"); window.location="pengguna";</script>';
}else{
    echo '<script>alert("Kemaskini gagal!"); window.location="pengguna";</script>';
}