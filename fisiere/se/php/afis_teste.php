<?php
session_start();
include ('db.php');
$clasa = $_SESSION["clasa"];
$output = '';
$rez = mysqli_query($con, "select * from teste where clasa='$clasa'");
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista exercitii de afisat</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $titlu_test = $row[1];
        $link_titlu = $row[4];
        $output .= '
             <div id="text">
               <div class="titlulectie">'.$titlu_test.'</div>
               <div id="indent">
                        <center>                    
                        <a href="rez_test/'.$link_titlu.'" class="btn btn-info" style="margin-top: 25px">REZOLVA TESTUL</a>
                </center>
               </div>
             </div>
            ';
    }
}
echo $output;
?>