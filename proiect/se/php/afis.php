<?php
include('db.php');
$sql = "SELECT * FROM lectii ORDER BY id DESC";
$rez = mysqli_query($con,$sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista lectii de afisat</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $titlu = $row[2];
        $continut = $row[3];
        $fisier = $row[4];
        if(strpos($fisier,'.jpg') || strpos($fisier,'.png')) {
            $output .= '
             <div id="text">
               <div class="titlulectie">'.$titlu.'</div>
               <div id="indent">'.$continut.'</div>
               <center><p><img src="php/fisiere/'.$fisier.'"></p></center>
             </div>
            ';
        }
    }
}
echo $output;
$sql2 = "SELECT * FROM Exercitii ORDER BY id DESC";
$rez2 = mysqli_query($con,$sql2);
$output2 = '';
if(mysqli_num_rows($rez2) == 0) {
    $output2 .= '<div id="titlu">nu exista exercitii de afisat</div>';
} else {
    while($row2 = mysqli_fetch_array($rez2)) {
        $continut2 = $row2[2];
        $fisier2 = $row2[3];
        if(strpos($fisier2,'.jpg') || strpos($fisier2,'.png')) {
            $output2 .= '
             <div id="text">
               <div id="indent">'.$continut2.'</div>
               <center><p><img src="php/fisiere/'.$fisier2.'"></p></center>
             </div>
            ';
        }
    }
}
echo $output2;
$data = array(
    "lectii" => $output,
    "exercitii" => $output2
);
echo json_encode($data);
?>