<?php
session_start();
include('db.php');
include('functii.php');
$id_utilizator = $_SESSION['id_utilizator'];
$output = '';
$sql = "select * from clase";
$rez = mysqli_query($con, $sql);
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista exercitii de afisat</div>';
} else {
    $output = '<ul>';
    while($row = mysqli_fetch_array($rez)) {
        $nume_clasa = $row[1];
        $nr_elev = nr_elevi($con, $nume_clasa);
        /*
        $output .= '
                    <a href="clasa/'.$nume_clasa.'">
                        <li class="clasa">
                            <div class="nume_clasa">
                                '.$nume_clasa.'
                            </div>
                            <div class="nr_elev">'.$nr_elev.' elevi</div>
                        </li>
                    </a>';
        */
        $output .= '<li class="clasa">
                         <a href="clasa/'.$nume_clasa.'">
                         <div class="nume_clasa">
                         '.$nume_clasa.'
                         </div>
                         <div class="nr_elev">'.$nr_elev.' elevi</div>
                         </a>
                    </li>';
    }
}
$output .= '</ul>';
echo $output;
?>