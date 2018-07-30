<?php
include('db.php');
include('fisiere.php');
$username = $_POST["username"];
$email = $_POST["email"];
$parola = $_POST["parola"];
$folder = "fisiere/";
$numefisier = $_FILES["fisier"]["name"];
$tip = $_POST["tip"];
if(isset($_POST['clasa'])) {
    $clasa = $_POST['clasa'];
}
$rez =  mysqli_query($con,"INSERT INTO login(username,mail,parola,nume_poza,clasa,tip_cont) VALUES('$username','$email','$parola','$numefisier','$clasa','$tip')") or die('eroare.\n Incercati mai tarziu');
if($rez) {
    echo '1';
}
?>