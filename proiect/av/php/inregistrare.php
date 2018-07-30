<?php
session_start();
include ('connect.php');
$nume = $_POST['nume'];
$sql = "INSERT INTO as_voc(nume, punctaj) VALUES ('$nume', '0')";
$rez = mysqli_query($con, $sql);
if($rez) {
    echo '1';
    $_SESSION['nume'] = $nume;
} else {
    echo '0';
}