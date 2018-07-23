<?php
session_start();
include('db.php');
include('functii.php');
error_reporting(E_ALL);
$clasa = $_SESSION["clasa"];
$sql = "SELECT * FROM lectii WHERE clasa='$clasa' ORDER BY id_lectie DESC";
$rez = mysqli_query($con,$sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="text"><div id="titlu">nu exista lectii de afisat</div></div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id = $row['id_lectie'];
        $id_utilizator = $row['id_utilizator'];
        //echo $id_utilizator.' ';
        $titlu = $row[2];
        $continut = $row[3];
        $fisier = $row[4];
        $cod = $row[6];
        $buton = '';
        if(!(inteles($con,$id_utilizator,$id,$cod))) {
            $buton = '
            <button type="button" class="btn btn-info inteles" data-id="'.$id.'" data-cod="'.$cod.'" id="butona">
            Am inteles lectia
            </button>';
        } else {
            $buton = '';
        }
        ///echo inteles($con,$id_utilizator,$id);
        if(strpos($fisier,'.jpg') || strpos($fisier,'.png')) {
            $output .= ' <div id="text">
            <div class="titlulectie">'.$titlu.'</div>
            <div id="indent">'.$continut.'</div>
            <center><p><img src="php/fisiere/'.$fisier.'"></p></center>
            '.$buton.'
          </div>';
        } else if(strpos($fisier, '.docx') || strpos($fisier, '.pptx') || strpos($fisier, '.pdf')) {
            $output .= ' <div id="text">
            <div class="titlulectie">'.$titlu.'</div>
            <div id="indent">'.$continut.'</div>
            <a href="php/fisiere/'.$fisier.'">'.$fisier.'</a>
            '.$buton.'
          </div>';
        }
    }
}
echo $output;
?>