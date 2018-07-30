<?php
session_start();
include('db.php');
$output = '';
$clasa = $_POST['clasa'];
$id = $_SESSION["id_utilizator"];
if($clasa != '') {
    mysqli_query($con,"INSERT INTO clase(id_utilizator,nume_clasa) VALUES ('$id','$clasa')");
}
for($i = 0; $i < count($_POST['hidden_first_name']); $i++){
    $cod_confirm = rand();
    $username = $_POST['hidden_first_name'][$i];
    $mail = $_POST['hidden_last_name'][$i];
    mysqli_query($con, "INSERT INTO login(username, mail, parola, nume_poza, clasa, tip_cont, codconfirm) VALUES ('$username', '$mail', '', '', '$clasa', 'Elev', '$cod_confirm')");
    $mesaj = 'PROF'.$_SESSION["username"].' Te-a adougat in clasa virtuala apasa pe link-ul de mai jos pt crearea contului:\n
                  http://cosmin-ciolacu.co.ro/infoeducatie/creare_cont_elev.php?mail='.$_POST["hidden_last_name"][$i].'&codconfirm='.$cod_confirm.'';
mail($_POST["hidden_last_name"][$i],'Creare cont',$mesaj);
}
echo $output;
?>