<?php
include('db.php');
$id = $_POST['id'];
$sql = "SELECT * FROM raspunsuri WHERE id_lectie='$id'";
$rez = mysqli_query($con,$sql);
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="rasp"><div id="indent">Nu exista raspunsuri la acest exercitiu</div></div>';
}
?>