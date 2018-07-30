<?php
include('db.php');
$id = $_POST['id'];
$sql = "UPDATE raspunsuri SET corect='1',ok='1' WHERE id_raspuns='$id'";
$rez = mysqli_query($con,$sql);
if ($rez) {
    $sql2 = "SELECT * FROM raspunsuri WHERE id_raspuns='$id' LIMIT 1";
    $rez2 = mysqli_query($con,$sql2);
    while($row = mysqli_fetch_array($rez2)) {
        $id_utilizator = $row[1];
    }
    mysqli_query($con,"UPDATE login SET score=score+5 WHERE id_utilizator='$id_utilizator'");
    echo 'SUCCES';
}
?>