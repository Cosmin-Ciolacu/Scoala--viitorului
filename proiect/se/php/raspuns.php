<?php
session_start();
include('db.php');
$id_utilizator = $_SESSION['id_utilizator'];
$id_lectie= $_POST['id'];
$raspuns = $_POST['raspuns'];
$sql = "INSERT INTO raspunsuri(id_utilizator,id_exercitii,raspuns) VALUES('$id_utilizator','$id_lectie','$raspuns')";
$rez = mysqli_query($con,$sql);
if($rez) {
    echo 'Raspunsul a fost adaugat';
}
?>