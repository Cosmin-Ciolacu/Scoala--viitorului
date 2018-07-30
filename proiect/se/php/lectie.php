<?php
session_start();
include('db.php');
include('functii.php');
include('fisiere.php');
$titlu= $_POST["Titlu"];
$link_titlu = con_to_link($titlu);
$continut = $_POST["continut"];
$clasa = $_POST["clasa"];
$folder = "fisiere/";
$numefisier = $_FILES["fisier"]["name"];
$id = $_SESSION["id_utilizator"];
$cod = rand();
//$extensie_fisier = strtolower(end(explode('.',$numefisier)));
$rez =  mysqli_query($con,"INSERT INTO lectii(id_utilizator,titlu,continut,fisier,clasa,cod,titlu_link) VALUES('$id','$titlu','$continut','$numefisier','$clasa','$cod','$link_titlu')") or die('eroare.\n Incercati mai tarziu');
if($rez) {
    echo 'Lectia sa adaugat cu succes';
}
?>