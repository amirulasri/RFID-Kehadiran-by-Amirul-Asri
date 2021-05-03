<?php
include('../conn.php');
$nama = $_POST['nama'];
$nokp = $_POST['nokp'];
$jantina = $_POST['jantina'];
$notel = $_POST['notel'];
$emel = $_POST['emel'];
$rfid = $_POST['rfid'];

$query = mysqli_query($conn, "INSERT INTO pengguna VALUES ('$nokp','$rfid','$nama','$notel','$emel','$jantina')");
if($query){
    echo '<script>alert("Pendaftaran berjaya!");window.location="pengguna";</script>';
}else{
    $error = mysqli_error($conn);
    echo '<script>alert("Pendaftaran GAGAL!:'.$error.'");window.location="pengguna";</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mendaftar</title>
    <style>
        body{
            background-color: rgb(38, 38, 38);
        }
    </style>
</head>
<body>
    
</body>
</html>