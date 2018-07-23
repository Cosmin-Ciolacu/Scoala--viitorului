<?php
session_start();
include ('db.php');
$id_utilizator = $_SESSION['id_utilizator'];
$titlu = $_POST['titlu'];
$punctaj = $_POST['pct'];
$rez = mysqli_query($con, "INSERT INTO rez_teste(id_utilizator, link_titlu_test, punctaj) VALUES ('$id_utilizator', '$titlu', '$punctaj')");
if($rez) {
    echo 'ok';
}

