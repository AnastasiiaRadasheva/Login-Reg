<?php

session_start();

if (!isset($_SESSION["useruid"]) || $_SESSION["useruid"] !== "admin") {
    //et kasutaja ei saaks lehele siseneda peale administraatori .viga 403
    http_response_code(403); 
    exit();
}
if(isset($_GET['code'])) {
    die(highlight_file(__FILE__, 1));
}
global $yhendus;
require('config0.php');

if(isset($_REQUEST["uusleht"])) {
    $kask = $yhendus->prepare("INSERT INTO tooded (hind, kirjeldus, linn, photo, nimi, avalik) VALUES (?, ?, ?, ?, ?, ?)");
    $kask->bind_param("dssssi", $_REQUEST["hind"], $_REQUEST["kirjeldus"], $_REQUEST["linn"], $_REQUEST["photo"], $_REQUEST["nimi"], $_REQUEST["avalik"]);
    $kask->execute();
     header("Location:" . $_SERVER['PHP_SELF']);
    $yhendus->close();
    exit();
}

if(isset($_REQUEST["kustutusid"])) {
    $kask = $yhendus->prepare("DELETE FROM tooded WHERE tootedID=?");
    $kask->bind_param("i", $_REQUEST["kustutusid"]);
    $kask->execute();
}

if(isset($_REQUEST["muutmisid"])) {
    $kask = $yhendus->prepare("UPDATE tooded SET hind=?, kirjeldus=?, linn=?, photo=?, nimi=?, avalik=? WHERE tootedID=?");
    $kask->bind_param("dssssii", $_REQUEST["hind"], $_REQUEST["kirjeldus"], $_REQUEST["linn"], $_REQUEST["photo"], $_REQUEST["nimi"],$_REQUEST["avalik"], $_REQUEST["muutmisid"]);
    $kask->execute();
}
if(isset($_REQUEST['naita'])) {
    $kask = $yhendus->prepare("update tooded set avalik=1 where tootedID=?");
    $kask->bind_param('i', $_REQUEST['naita']);
    $kask->execute();
    header("Location:" . $_SERVER['PHP_SELF']);

}
if(isset($_REQUEST['peida'])) {
    $kask = $yhendus->prepare("update tooded set avalik=0 where tootedID=?");
    $kask->bind_param('i', $_REQUEST['peida']);
    $kask->execute();
    header("Location:" . $_SERVER['PHP_SELF']);

}


include("nav.php");
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Tooted lehel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>Toodete haldus</h1>

<?php

if (isset($_REQUEST["id"])) {
    $kask = $yhendus->prepare("SELECT tootedID, hind, kirjeldus, linn, photo, nimi, avalik FROM tooded WHERE tootedID=?");
    $kask->bind_param("i", $_REQUEST["id"]);
    $kask->bind_result($tootedID, $hind, $kirjeldus, $linn, $photo, $nimi, $avalik);
    $kask->execute();

    if ($kask->fetch()) {

        if (isset($_REQUEST["muutmine"])) {
            echo "
                <h2>Toote muutmine</h2>
                <form action='{$_SERVER["PHP_SELF"]}'>
                    <input type='hidden' name='muutmisid' value='$tootedID'/>
                    <table>
                        <tr><td>Nimi:</td><td><input type='text' name='nimi' value='".htmlspecialchars($nimi)."'></td></tr>
                        <tr><td>Hind:</td><td><input type='text' name='hind' value='".htmlspecialchars($hind)."'></td></tr>
                        <tr><td>Kirjeldus:</td><td><input type='text' name='kirjeldus' value='".htmlspecialchars($kirjeldus)."'></td></tr>
                        <tr><td>Linn:</td><td><input type='text' name='linn' value='".htmlspecialchars($linn)."'></td></tr>
                        <tr><td>Foto:</td><td><input type='text' name='photo' value='".htmlspecialchars($photo)."'></td></tr>
                        <tr>
                        <td>Status:</td><td><input type='text' name='avalik' value='".htmlspecialchars($avalik)."'>
                        </td>
                        </tr>
                    </table>
                    <input type='submit' value='Muuda'>
                </form>
            ";
        } 
        else {
            echo "<h2>".htmlspecialchars($nimi)."</h2>";
            echo "<p>Kirjeldus: ".htmlspecialchars($kirjeldus)."</p>";
            echo "<p>Hind: ".htmlspecialchars($hind)."</p>";
            echo "<p>Linn: ".htmlspecialchars($linn)."</p>";
            echo "<p><img src='".htmlspecialchars($photo)."' alt='' style='max-width:200px;'></p>";
            echo "<p>Avalik: ".htmlspecialchars($avalik)."</p>";
        }
         $kask->close();
    }
}



$kask = $yhendus->prepare("SELECT tootedID, nimi, hind, kirjeldus, linn, photo,  avalik FROM tooded");
$kask->bind_result($tid, $tnimi, $thind, $tkirjeldus, $tlinn, $tphoto, $tavalik);
$kask->execute();

echo "<table border='1' cellpadding='5' color = 'white'>
<tr>
    <th>ID</th>
    <th>Nimi</th>
    <th>Hind</th>
    <th>Kirjeldus</th>
    <th>Linn</th>
    <th>Foto</th>
    <th>Muuda</th>
    
    <th>Haldus</th>
    <th>Staatus</th>

    <th>Kustuta</th>
</tr>";

while ($kask->fetch()) {

    $tekst = "näita";
    $seisund = "naita";
    $tekstLehel = "peidatud";

    if ($tavalik == 1) {
        $tekst = 'peida';
        $seisund = 'peida';
        $tekstLehel = 'näidatud';
    }

    echo "<tr>";

    echo "<td>{$tid}</td>";
    echo "<td>" . htmlspecialchars($tnimi) . "</td>";
    echo "<td>" . htmlspecialchars($thind) . "</td>";
    echo "<td>" . htmlspecialchars($tkirjeldus) . "</td>";
    echo "<td>" . htmlspecialchars($tlinn) . "</td>";
    echo "<td><img src='" . htmlspecialchars($tphoto) . "' width='80'></td>";

    echo "<td><a href=\"" . $_SERVER["PHP_SELF"] .
         "?id={$tid}&muutmine=jah\">Muuda</a></td>";
    
    echo "<td><a href='?$seisund={$tid}'>$tekst</a></td>";
    echo "<td>$tekstLehel</td>";
    echo "<td><a href=\"" . $_SERVER["PHP_SELF"] .
         "?kustutusid={$tid}\">Kustuta</a></td>";
    echo "</tr>";
}



echo "</table>";


?>
</div>
<br><br>
<div id="menyykiht">
<h2>Uue toote lisamine</h2>
<form action="<?=$_SERVER["PHP_SELF"]?>">
    <input type="hidden" name="uusleht" value="jah" />
    <table>
        <tr><td>Nimi:</td><td><input type="text" name="nimi"></td></tr>
        <tr><td>Hind:</td><td><input type="number" name="hind"></td></tr>
        <tr><td>Kirjeldus:</td><td><input type="text" name="kirjeldus"></td></tr>
        <tr><td>Linn:</td><td><input type="text" name="linn"></td></tr>
        <tr><td>Foto:</td><td><input type="text" name="photo"></td></tr>
        <tr>

        <td> Status:</td>
        <td>
        <select name="avalik" id="avalik" required>
        <option value="1">Avalik</option>
        <option value="0">Peidetud</option></select>
        </td>
        </tr>
    </table>
    <input type="submit" value="Sisesta">
</form>

</div>


<br><br>
</body>
</html>
<?php
$yhendus->close();
?>
<?php
require("footer.php");
?>

<?php if(isset($_GET['code'])) {die(highlight_file(__FILE__, 1));}?>
