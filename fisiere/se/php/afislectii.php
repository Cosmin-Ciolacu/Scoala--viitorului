<?php
include('db.php');
$sql = "SELECT * FROM lectii ORDER BY id_lectie DESC";
$rez = mysqli_query($con,$sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista lectii de afisat</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id_lectie = $row[0];
        $titlu = $row[2];
        $continut = $row[3];
        $fisier = $row[4];
        if(strpos($fisier,'.jpg') || strpos($fisier,'.png')) {
            $output .= '
             <div id="text">
               <div class="titlulectie" style="text-align:center">'.$titlu.'</div>
               <div id="indent">'.$continut.'</div>
               <center><p><img src="php/fisiere/'.$fisier.'"></p></center>
             </div>
            ';
        }
    }
}
echo $output;
?>