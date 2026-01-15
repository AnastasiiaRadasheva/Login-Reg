<?php if(isset($_GET['code'])){die(highlight_file(__FILE__,1));} ?>
<?php
require("nav.php");
require("config0.php");
global $yhendus;
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Tooted lehel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Tooted</h1>


    <?php

    $paring = $yhendus->prepare("SELECT tootedID, photo FROM tooded WHERE avalik=1");
    $paring->bind_result($id, $photo);
    $paring->execute();

    echo "<div class='uus1'><ul>";
    while($paring->fetch()){
        echo "<li>
                <a href='?id=$id'>
                    <img src='".htmlspecialchars($photo)."'>
                </a>
              </li>";
    }
    echo "</ul></div>";
    ?>

    <div class="uus2">
        <?php

        if(isset($_REQUEST["id"])) {
            $paring = $yhendus->prepare("SELECT tootedID, nimi, hind, kirjeldus, linn FROM tooded WHERE tootedID=?");
            $paring->bind_param("i", $_REQUEST["id"]);
            $paring->bind_result($id, $nimi, $hind, $kirjeldus, $linn);
            $paring->execute();

            if($paring->fetch()){
                echo "<h2>".htmlspecialchars($nimi)."</h2>";
                echo "<ul '>
                        <li>
                            <strong>Hind:</strong> ".htmlspecialchars($hind)."€
                        </li>
                        <li>
                            <strong>Kirjeldus:</strong><br>
                            ".nl2br(htmlspecialchars($kirjeldus))."
                        </li>
                        <li>
                            <strong>Linn:</strong><br>
                            ".nl2br(htmlspecialchars($linn))."
                        </li>
                      </ul>";
            } else {
                echo "<h3>Toodet ei leitud.</h3>";
            }
        }else {
            echo "<h3>Vali toode nimekirjast, et rohkem teada saada.
</h3>";
        }
        ?>
    </div>


<?php
$yhendus->close();
require("footer.php");
?>
