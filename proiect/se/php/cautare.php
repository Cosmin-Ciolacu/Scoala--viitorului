<?php
include('db.php');
$cautare = $_POST["cautare"];
$output = '';
$sql = "SELECT * FROM login WHERE username LIKE '%$cautare%'";
$rez = mysqli_query($con,$sql);
$nr = mysqli_num_rows($rez);
if($nr == 0) {
    $output .= '<div id="rezultitem">nu exista rezultate</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $username = $row[1];
        $poza = $row[4];
        $id = $row[0];
        $output .= '<a href="user/'.$id.'">
                     <div id="rezultitem"> 
                        <img src="php/fisiere/'.$poza.'" />
                        '.$username.'
                    </div></a>';
    }
}
echo $output;
?>