<?php
include('db.php');
$username = $_POST['username'];
$output = '';
$sqlrez = mysqli_query($con,"SELECT * FROM login WHERE username='$username'");
$nr = mysqli_num_rows($sqlrez);
if($nr == 0) {
    $output = '<p style="color:green">USERNAME VALID</p>';
} else {
    $output = '<p style="color:red">USERNAME INVALID </p>';
}
echo $output;
?>