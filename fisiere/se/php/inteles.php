<?php
session_start();
include('db.php');
$id_utilizator = $_SESSION['id_utilizator'];
$id_clasa = $_POST['id'];
$cod = $_POST['cod'];
$sql = "INSERT INTO inteles(id_utilizator,id_lectie,cod) VALUES('$id_utilizator','$id_clasa','$cod')";
$rez = mysqli_query($con,$sql);
if($rez) {
    echo 'ok';
    //mysqli_query($con,"UPDATE inteles SET ok='0' WHERE id_utilizator='$id_utilizator' AND id_clasa='$id_clasa'");
}
?>