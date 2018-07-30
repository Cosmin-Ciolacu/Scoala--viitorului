<?php
session_start();
include ('db.php');
include ('fisiere.php');
$numefisier = $_FILES["fisier"]["name"];
$enunt = $_POST["enunt"];
$var1 = $_POST["var1"];
$var2 = $_POST["var2"];
$var3 = $_POST["var3"];
$varc= $_POST["varc"];
$titlu_test = $_SESSION["titlu_test"];
$rez = mysqli_query($con, "insert into test_2(titlu_test,enunt,var_a,var_b,var_c,var_corect,fisier) values('$titlu_test','$enunt','$var1','$var2','$var3','$varc','$file_name')");
if($rez) {
    echo 'ok';
    $_SESSION["nr_intrebari"] += 1;
}

?>