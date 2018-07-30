<?php
session_start();
include('db.php');
$id_lectie = $_POST['id'];
$id_utilizator = $_SESSION['id_utilizator'];
$rez = mysqli_query($con,"UPDATE inteles SET ok='1' WHERE id_utilizator='$id_utilizator' AND id_lectie='$id_lectie'");
if($rez) {
    echo "ok";
}
?>