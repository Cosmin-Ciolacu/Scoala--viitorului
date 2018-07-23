<?php
session_start();
include('db.php');
$id = $_POST['id'];
$_SESSION['id_lectie'] = $id;
$rez = mysqli_query($con, "select * from lectii where id_lectie='$id' limit 1");
while($row = mysqli_fetch_array($rez)) {
    $titlu = $row[2];
    $continut = $row[3];
}
$output = array(
    'titlu' => $titlu,
    'continut' => $continut
);
echo json_encode($output);