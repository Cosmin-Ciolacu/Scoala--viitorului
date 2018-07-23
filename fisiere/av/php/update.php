<?php
session_start();
include ('connect.php');
$nume = $_SESSION['nume'];
$punctaj = $_POST['punctaj'];
$rez = mysqli_query($con, "UPDATE as_voc SET punctaj='$punctaj' WHERE nume='$nume'");
if($rez) {
    echo '1';
} else {
    echo '0';
}