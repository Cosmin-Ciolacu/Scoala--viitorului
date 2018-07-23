<?php
session_start();
include('db.php');
$continut = $_POST["continut"];
$clasa = $_POST['clasa'];
$folder = "fisiere/";
$numefisier = $_FILES["pp"]["name"];
$id = $_SESSION["id_utilizator"];
//$extensie_fisier = strtolower(end(explode('.',$numefisier)));
$ok = 1;
if($_FILES['pp']['size'] > 300000) {
    echo 'Fisierul este prea mare';
    $ok = 0;
}
if($ok == 0){
    echo 'Eroare';
}
else {
    if(move_uploaded_file($_FILES["pp"]["tmp_name"],$folder.$numefisier)) {
        mysqli_query($con,"INSERT INTO Exercitii(id_utilizator,continut,fisier,clasa) VALUES('$id','$continut','$numefisier','$clasa')") or die('eroare.\n Incercati mai tarziu');
        echo 'Exercitiul sa adaugat cu succes';
    }
}
?>