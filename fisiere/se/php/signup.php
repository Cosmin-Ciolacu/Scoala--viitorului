<?php
include('db.php');
$username = $_POST["username"];
$email = $_POST["email"];
$parola = $_POST["parola"];
$folder = "fisiere/";
$numefisier = $_FILES["pp"]["name"];
$tip = $_POST["tip"];
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
        mysqli_query($con,"INSERT INTO login(username,mail,parola,nume_poza,tip_cont) VALUES('$username','$email','$parola','$numefisier','$tip')") or die('eroare.\n Incercati mai tarziu');
        echo 'Inregistrarea sa facut cu succes';
    }
}
?>