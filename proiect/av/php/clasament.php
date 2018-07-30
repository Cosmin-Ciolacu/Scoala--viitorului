<?php
session_start();
include('connect.php');
$output = '';
$sql = "select * from as_voc order by punctaj desc";
$rez = mysqli_query($con, $sql);
if(mysqli_num_rows($rez) == 0){
    $output .= '<div class="item">Momentan nu exista niciun clasament!</div>';
} else {
    while($row = mysqli_fetch_array($rez)){
        $nume = $row[1];
        $punctaj = $row[2];
        if($nume == $_SESSION['nume']) {
            $nume = ' <div class="nume" style="color:green">'.$nume.'</div>
            <div class="punctaj" style="color:green">'.$punctaj.' puncte</div>'; 
        } else {
            $nume = ' <div class="nume">'.$nume.'</div>
            <div class="punctaj">'.$punctaj.' puncte</div>';
        }
        $output .= '<div class="item">
                       '.$nume.'
                    </div>';
    }
}
echo $output;
?>
