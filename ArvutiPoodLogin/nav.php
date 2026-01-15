
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>PHP Project 01</title>
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

            if (isset($_SESSION["useruid"]) && $_SESSION["useruid"] === "admin") {
                echo "<li><a href='index.php'>Adminlehel</a></li>";
            }
            if (isset($_SESSION["useruid"])) {
                echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else {
                echo "<li><a href='signup.php'>Sign up</a></li>";
                echo "<li><a href='login.php'>Log in</a></li>";
            }
            ?>
        </ul>
    </nav>


</header>
