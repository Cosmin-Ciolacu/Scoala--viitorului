<?php
include('db.php');
include('functii.php');
$sql = "SELECT * FROM lectii ORDER BY id_lectie DESC";
$rez = mysqli_query($con,$sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista lectii de afisat</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id_lectie = $row[0];
        $id_utilizator = $row[1];
        $titlu = $row[2];
        $continut = $row[3];
        $fisier = $row[4];
        if(strpos($fisier,'.jpg') || strpos($fisier,'.png')) {
            $output .= '
             <div id="text">
             <div class="titlulectie">'.$titlu.' <div class="prof">Lectie adaugata de <br>'.getnume($con, $id_utilizator).'</div></div>               <div id="indent">'.$continut.'</div>
               <center><p><img src="php/fisiere/'.$fisier.'"></p></center>
             </div>
            ';
        } else if(strpos($fisier, '.docx') || strpos($fisier, '.pptx') || strpos($fisier, '.pdf')) {
            $output .= ' <div id="text">
            <div class="titlulectie">'.$titlu.'<div class="prof">Aplicatie adaugata de <br>'.getnume($con, $id_utilizator).'</div></div>
            <div id="indent">'.$continut.'</div>
            <a href="php/fisiere/'.$fisier.'">'.$fisier.'</a>
            </div>';
        }
    }
}
echo $output;
?>