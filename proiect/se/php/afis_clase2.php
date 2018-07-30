<?php
include('db.php');
$output = '';
$sql = "SELECT * FROM clase";
$rez = mysqli_query($con,$sql);
if(mysqli_num_rows($rez) == 0) {
    $output .= '<option>nu exista clase de afisat</option>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $output .= '<option>'.$row[1].'</option>';
    }
}
echo $output;
?>