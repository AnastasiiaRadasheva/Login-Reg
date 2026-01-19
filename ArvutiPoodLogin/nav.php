<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Arvutipood</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <h3><a href="tervislik_lehed.php">Arvutipood</a></h3>
        <ul>

            <li><a href="tervislik_lehed.php">Meist</a></li>
            <li><a href="tooted.php">Tooted</a></li>
            <li><a href="tooted(1).php">Galerii</a></li>

            <?php
            if (isset($_SESSION["useruid"])) {
                if ($_SESSION["useruid"] == "admin") {
                    echo "<li><a href='index.php'>Admin-leht</a></li>";
                }
                echo "<li><a href='logout.php'>Väljalogimine</a></li>";

                echo "<li class='current-user'>Tere, " . htmlspecialchars($_SESSION["useruid"]) . "!</li>";

            } else {
                echo "<li><a href='signup.php'>Registreerimine</a></li>";
                echo "<li><a href='login.php'>Logi sisse</a></li>";
            }
            ?>
        </ul>
    </nav>


</header>
