<?php
session_start();
include('db.php');
include ('fisiere.php');
$numefisier = $_FILES["fisier"]["name"];
$id = $_SESSION['id_lectie'];
$rez = mysqli_query($con, "update lectii set titlu='".$_POST['Titlu2']."',continut='".$_POST['continut2']."',fisier='".$_FILES['fisier']['name']."' where id_lectie='$id'");
if($rez) {
    echo 'Lectia a fost editata cu succes!';
} else {
    echo 'A aparut o eroare';
}