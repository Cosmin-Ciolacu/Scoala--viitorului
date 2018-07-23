<?php
session_start();
include('db.php');
include('functii.php');
$id = $_SESSION["id_exercitii"];
$id_utilizator2 = $_SESSION["id_utilizator"];
$output = '';
$sql ="SELECT * FROM raspunsuri WHERE id_exercitii='$id'";
$rez = mysqli_query($con,$sql);
if(mysqli_num_rows($rez) == 0){
    $output .= '<div id="text">Nu exista raspunsuri la acest exercitiu</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id_raspuns = $row[0];
        $id_utilizator = $row[1];
        $id_exercitii = $row[2];
        $raspuns = $row[3];
        $nr = mysqli_num_rows(mysqli_query($con,"SELECT * FROM raspunsuri WHERE id_raspuns='$id_raspuns' AND ok='1'"));
        //echo $nr;
        $buttons = '';
        if($nr == 0) {
            $buttons = '<center>
            <button type="button" class="btn btn-success corect" data-id="'.$id_raspuns.'">Raspuns corect </button>
            <button type="button" class="btn btn-danger gresit" style="margin-left:40px;" data-id="'.$id_raspuns.'">Raspuns gresit </button>
          </center>';
        } else {
            $buttons = '';
        }
        $output .= '<div id="text" style="font-size:22px;">
                      <div class="titlulectie" style="text-align:left;">'.getnume($con,$id_utilizator).'</div>
                       <div id="indent">'.$raspuns.'</div>
                       '.$buttons.'
                    </div>';
    }
}
echo $output;
?>