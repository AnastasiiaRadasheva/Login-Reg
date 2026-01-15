<?php
$servernimi = 'localhost';
$kasutajanimi = 'arvutipood';
$parool = 'arvutipood';
$andmebaasinimi = 'arvutipood';
$conn = new mysqli($servernimi, $kasutajanimi, $parool, $andmebaasinimi);
$conn->set_charset("utf8");
if (!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}
