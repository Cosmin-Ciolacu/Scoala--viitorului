<?php
session_start();
include('db.php');
$clasa = $_SESSION["clasa"];
$sql = "SELECT * FROM Exercitii WHERE clasa='$clasa' ORDER BY id_exercitii DESC";
$rez = mysqli_query($con,$sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista exercitii de afisat</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id = $row[0];
        $id_utilizator = $row[1];
        $continut = $row[2];
        $fisier = $row[3];
        $raspuns = $row[3];
        if(strpos($fisier,'.jpg') || strpos($fisier,'.png')) {
            $output .= '
             <div id="text">
             <div class="titlulectie">Aplicatia cu numarul '.$id.'</div>
               <div id="indent">'.$continut.'</div>
               <center><p><img src="php/fisiere/'.$fisier.'"></p></center>
               <button type="button" data-toggle="modal" data-target="#answers" class="btn btn-info raspuns" data-id="'.$id.'">Raspunde</button>
             </div>
            ';
        }
        else if(strpos($fisier, '.docx') || strpos($fisier, '.pptx') || strpos($fisier, '.pdf')) {
            $output .= '
             <div id="text">
             <div class="titlulectie">Aplicatia cu numarul '.$id.'</div>
               <div id="indent">'.$continut.'</div>
               <a href="php/fisiere/'.$fisier.'">'.$fisier.'</a>  
               <button type="button" data-toggle="modal" data-target="#answers" class="btn btn-info raspuns" data-id="'.$id.'">Raspunde</button>
               </div>
              ';
          }
    }
}
echo $output;
?>