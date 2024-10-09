<?php
$host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "db_uts_muammarramadhanimaulizidan_sireg4b";


// conn buat connection ke database lu, pake mysqli_connect()
$conn = mysqli_connect($host, $db_user, $db_pass, $db_name);

// kalo ada error bakal ada mesej, kalau gada layarnya warna putih berarti connection udah benar
if (mysqli_connect_errno()) {
    die("Failed to connect to the database: " . mysqli_connect_error());
}
?>
