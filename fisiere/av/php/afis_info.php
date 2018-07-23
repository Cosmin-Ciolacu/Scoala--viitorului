<?php
include('connect.php');
mysqli_set_charset($con,"utf8");
$raspuns = $_POST['raspuns'];
$sql = "SELECT * FROM intrebari WHERE raspuns='$raspuns'";
$rez = mysqli_query($con, $sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output = '<p>Nu exista informatii';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $info = $row[4];
        $img = $row[5];
        if($img == '') {
            $output .= '<p>'.$info.'</p>';
        } else {
            $output .= '<p>'.$info.'</p>
                        <img src="img/'.$img.'" />';   
        }
    }
}
echo $output;
?>