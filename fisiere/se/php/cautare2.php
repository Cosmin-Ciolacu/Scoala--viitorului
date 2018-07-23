<?php
include('db.php');
$cautare = $_POST["cautare"];
$output = '';
$sql = "SELECT * FROM lectii WHERE titlu LIKE '%$cautare%' OR continut LIKE '%$cautare%'";
$rez = mysqli_query($con,$sql);
$nr = mysqli_num_rows($rez);
if($nr == 0) {
    $output .= '<div id="rezultitem">nu exista rezultate</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $titlu = $row[2];
        $continut = $row[3];
        $id = $row[0];
        $output .= '<a href="lectie2/'.$id.'">
                     <div id="rezultitem" style="height: 80px;"> 
                        <h3>'.$titlu.'</h3>
                        '.substr($continut,0,100).'
                    </div></a>';
    }
}
$output .= '<div id="rezultitem"><h2>Exercitii:</h2></div>';
$sql2 = "SELECT * FROM Exercitii WHERE continut LIKE '%$cautare%'";
$rez2 = mysqli_query($con,$sql2);
if(mysqli_num_rows($rez2)) {
    $output .= '<div id="rezultitem">Nu exista exercitii</div>';
} else {
    while($row2 = mysqli_fetch_array($rez2)) {
        $continut2 = $row2[2];
        $id2 = $row2[0];
        $output .= '<a href="exercitii2/'.$id2.'">
                      <div id="rezultitem" style="height: 80px;">'.substr($continut2,0,100).'</div>
                    </a>';
    }
}
echo $output;
?>