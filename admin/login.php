<?php
include('../conn.php');
session_start();
$namapengguna = "";
$katalaluan = "";
if(isset($_POST['namaadmin']) && isset($_POST['katalaluan'])){
    $namapengguna = $_POST['namaadmin'];
    $katalaluan = $_POST['katalaluan'];
    $querylogin = mysqli_query($conn, "SELECT * FROM `admin` WHERE namapengguna='$namapengguna' AND katalaluan='$katalaluan'");
    if ($getdatalogin = mysqli_fetch_assoc($querylogin)) {
        $_SESSION['admin'] = $namapengguna;
        header("location: index");
    } else {
        echo '<script>alert("Nama pengguna atau kata laluan salah"); window.location="login"</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.8">
    <title>Log Masuk</title>
    <link rel="stylesheet" href="../style/adminlogin.css">
    <link rel="stylesheet" href="../style/bootstrap.css">
</head>
<body>
    <div class="logincenter">
        <h2>Log Masuk</h2>
        <form action="" method="post">
            <div class="textfield">
                <label for="">Nama Pengguna</label>
                <input type="text" class="form-control" name="namaadmin" id="" required>
            </div><br>
            <div class="textfield">
                <label for="">Kata Laluan</label>
                <input type="password" class="form-control" name="katalaluan" id="" required>
            </div><br>
            <input type="submit" class="btn btn-primary btn-block btn-lg" value="Log Masuk">
        </form>
    </div>
</body>
</html>