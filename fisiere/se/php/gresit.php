<?php
include('db.php');
$id = $_POST["id"];
$rez = mysqli_query($con,"UPDATE raspunsuri SET corect='0',ok='1' WHERE id_raspuns='$id'");
if ($rez) {
    echo 'succes';
}
?>