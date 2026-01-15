<?php
$servernimi = 'localhost';
$kasutajanimi = 'arvutipood';
$parool='arvutipood';
$andmebaasinimi = 'arvutipood';
$yhendus = new mysqli($servernimi, $kasutajanimi, $parool, $andmebaasinimi);
$yhendus->set_charset("utf8");