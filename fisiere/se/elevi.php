<?php
session_start();
include('php/db.php');
include ('php/functii.php');
$clasa = $_REQUEST["clasa"];
$output = '';
$sql = "SELECT * FROM login WHERE clasa='$clasa' ORDER BY score DESC";
$rez = mysqli_query($con, $sql);
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista elevi de afisat</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id = $row[0];
        $nume = $row[1];
        $nume_poza = $row[4];
        $score = $row[9];
        $output .= '<li class="clasa">
                         <a href="infoeducatie/se/user/'.$id.'">
                         <div class="nume_clasa" style="background:url(infoeducatie/se/php/fisiere/'.$nume_poza.'); background-size:cover">
                         '.$nume.'
                         </div>
                         <div class="nr_elev">'.$score.' puncte</div>
                         </a>
                    </li>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="infoeducatie/se/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Skranji" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="infoeducatie/se/js/meniu.js"></script>
    <title>APLICATII NOI</title>
    <style>
        body{
            background: #f1f1f1;
        }
        a {
            text-decoration:none;
            color: #343a40;
        }
        #header{
            background: url(infoeducatie/se/img/header.png);
            background-size: cover;
        }
    </style>
</head>
<body>

<div id="bar" style="position:fixed;z-index: 10;">
    <span style="font-size:30px;cursor:pointer;color:#c99e10;/*float:left*/left:0;" onclick="deschidere()">&#9776; Meniu</span>
    <div id="item2"><div style="background-image:url('img/notificare_icon.svg'); width: 100%;height:100%;background-size:100% 100%;"></div></div>
    <div id="item"><i class="material-icons">search</i></div>
    <div id="notificari"></div>
</div>

<div id="mySidenav" class="meniu">
    <div class="nume"><?php echo $_SESSION["username"]; ?></div>
    <center>
        <img src="infoeducatie/se/img/<?php echo get_image($con, $_SESSION['username']); ?>" class="imagine" />
    </center>
    <a href="javascript:void(0)" class="closebtn" onclick="inchidere()">&times;</a>
    <a href="infoeducatie/se/exercitiinoi2/<?php echo $clasa; ?>">APLICATIILE CLASEI</a>
    <a href="infoeducatie/se/teste_elev/<?php echo $clasa; ?>">TESTELE CLASEI</a>
    <a href="infoeducatie/se/elevi/<?php echo $clasa; ?>">ELEVII CLASEI</a>
    <a href="infoeducatie/se/deconectare.php">DECONECTARE</a>
</div>
<div id="header">
    <div class="text">ELEVII CLASEI <?php echo $clasa; ?></div>
</div>
<br><br><br>
<div class="container"><?php echo $output; ?></div>
    </bady>
    </html>