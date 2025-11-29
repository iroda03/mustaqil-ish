<?php
$host = "localhost";  // OpenServer uchun
$user = "root";       // MySQL foydalanuvchi
$password = "root";       // OpenServer default parol
$dbname = "gullar_sayti";

$conn = mysqli_connect($host, $user, $password, $dbname);

if (!$conn) {
    die("MySQLga ulanishda xato: " . mysqli_connect_error());
}

echo "MySQLga muvaffaqiyatli ulandingiz!";
?>
