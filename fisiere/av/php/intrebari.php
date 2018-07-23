<?php
include ('connect.php');
mysqli_set_charset($con,"utf8");
$sql = "SELECT * FROM intrebari ORDER BY RAND() LIMIT 1";
$rez = mysqli_query($con, $sql);
$intrebare = '';
$raspuns = '';
while($row = mysqli_fetch_array($rez)) {
    $intrebare = $row[1];
    $raspuns = $row[2];
    $punctaj = $row[3];
    $info = $row[4];
}
$output = array(
    'intrebare' => $intrebare,
    'raspuns' => $raspuns,
    'punctaj' => $punctaj,
    'info' => $info
);
echo json_encode($output);
?>