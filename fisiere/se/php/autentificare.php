<?php
session_start();
include_once("db.php");
include('functii.php');
if ($_POST['username'] != "" && $_POST['parola'] != '' && $_POST["tip"] != '') {
    $username = $_POST['username'];
    if(exista_cont($con, $username)) {
        $password = $_POST['parola'];
        $tip = $_POST["tip"];
        $output = '';
        if($username == 'admin' && $password == 'admin')
            header('Location: admin.php');
        else
        {
            $query = "SELECT * FROM login WHERE username = '$username' LIMIT 1";
            $result = mysqli_query($con,$query);
            while($row=mysqli_fetch_array($result)){
                $db_username=$row['username'];
                $db_password=$row['parola'];
                $db_confirmat=$row['confirmat'];
                $clasa = $row["clasa"];
                $id = $row[0];
            }
            if($username==$db_username&&$password==$db_password)
            {
                if($db_confirmat==1)
                {
                    $output = '1';
                    if($tip == 'Profesor') {
                        $_SESSION["username"] = $username;
                        $_SESSION["id_utilizator"] = $id;
                        header("location:../prof.php");
                    } else {
                        $_SESSION["username"] = $username;
                        $_SESSION["id_utilizator"] = $id;
                        $_SESSION["clasa"] = $clasa;
                        header("location:../elev.php");
                    }
                }
                else
                {
                    $output = "Contul nu este activat";
                }
            }
            else
            {
                $output = "Datele nu sunt valide";
            }
        }
    } else {
        $output = 'Nu exista un cont cu acest nume de utilizator';
    }
}
echo $output;
?>
