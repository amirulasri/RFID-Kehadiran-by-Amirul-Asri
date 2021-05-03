<?php
include('../conn.php');
$nokp = $_POST['nokp'];
$rfidbaru = $_POST['rfid'];

//CHECK RFID SAMA ADA TELAH DIGUNAKAN DALAM SISTEM
$querycheck = mysqli_query($conn, "SELECT rfid FROM pengguna WHERE rfid='$rfidbaru'");
if(mysqli_num_rows($querycheck) > 0){
    die('<script>alert("RFID yang anda sentuh pada pembaca telah digunakan. Guna RFID yang baru!"); window.location="rfid?tukarrfidpengguna=1&nokp='.$nokp.'";</script>');
}

$query = mysqli_query($conn, "UPDATE pengguna SET rfid='$rfidbaru' WHERE kppengguna='$nokp'");

if($query){
    echo '<script>alert("Berjaya dikemaskini"); window.location="pengguna";</script>';
}else{
    echo '<script>alert("Kemaskini gagal!"); window.location="pengguna";</script>';
}