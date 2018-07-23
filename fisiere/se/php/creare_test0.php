<?php
session_start();
include('db.php');
include('functii.php');
$titlu_test = $_POST["titlu_test"];
$link_titlu_test = con_to_link($titlu_test);
$clasa = $_POST["clasa"];
$nr_intrebari = $_POST["nr_intrebari"];
$id_utilizator = $_SESSION["id_utilizator"];
$rez = mysqli_query($con, "insert into teste(titlu_test, id_utilizator, clasa,link_titlu_test) VALUES ('$titlu_test','$id_utilizator','$clasa','$link_titlu_test')");
if($rez) {
    $_SESSION["titlu_test"] = $link_titlu_test;
    $_SESSION["nr_intrebari"] = $nr_intrebari;
    echo  $_SESSION["nr_intrebari"];
}


?>