<?php
include('conn.php');

$rfid = $_POST['rfid'];

//GENERATE TARIKH
date_default_timezone_set('Asia/Kuala_Lumpur');
$date = date('Y-m-d');

//GENERATE MASA
$masa = date("h:i A");

//PERIKSA SAMA ADA ORANG ITU TELAH PUN SENTUH KAD TETAPI SENTUH LAGI SEKALI
$querycheck = mysqli_query($conn, "SELECT * FROM rekodkehadiran WHERE rfid='$rfid' AND tarikh='$date' AND masa='$masa'");
if(mysqli_num_rows($querycheck) > 0){
    die('<script>window.location="index?masaduplicate=1";</script>');
}

$query = mysqli_query($conn, "INSERT INTO rekodkehadiran VALUES (NULL,'$rfid','$date','$masa','Rumah')");
if($query){
    echo '<script>window.location="index";</script>';
}else{
    $errorno = mysqli_errno($conn);
    echo "<script>window.location='index?fail=".$errorno."'</script>";
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