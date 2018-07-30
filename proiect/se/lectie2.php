<?php
include('php/db.php');
include ('php/functii.php');
session_start();
$titlu_lectie = $_REQUEST['titlu'];
$sql = "SELECT * FROM lectii WHERE titlu_link='$titlu_lectie' LIMIT 1";
$rez = mysqli_query($con,$sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="text"><div id="titlu">nu exista lectii de afisat</div></div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id = $row[0];
        $id_utilizator = $row[1];
        $titlu = $row[2];
        $continut = $row[3];
        $fisier = $row[4];
        if(!(inteles($con,$_SESSION['id_utilizator'],$id))) {
            $buton = '
            <button type="button" class="btn btn-info inteles" data-id="'.$id.'" id="butona">
            Am inteles lectia
            </button>';
        } else {
            $buton = '';
        }
        ///echo inteles($con,$id_utilizator,$id);
        if(strpos($fisier,'.jpg') || strpos($fisier,'.png')) {
            $output .= ' <div id="text">
            <div class="titlulectie">'.$titlu.' <div class="prof">Lectie adaugata de <br>'.getnume($con, $id_utilizator).'</div></div>
            <div id="indent">'.$continut.'</div>
            <center><p><img src="infoeducatie/se/php/fisiere/'.$fisier.'"></p></center>
            '.$buton.'
          </div>';
        } else if(strpos($fisier, '.docx') || strpos($fisier, '.pptx') || strpos($fisier, '.pdf')) {
            $output .= ' <div id="text">
            <div class="titlulectie">'.$titlu.'</div>
            <div id="indent">'.$continut.'</div>
            <a href="infoeducatie/se/php/fisiere/'.$fisier.'">'.$fisier.'</a>
            '.$buton.'
          </div>';

        }
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
        <img src="infoeducatie/se/php/fisiere/<?php echo get_image($con, $_SESSION['username']); ?>" class="imagine" />
    </center>
    <a href="javascript:void(0)" class="closebtn" onclick="inchidere()">&times;</a>
    <a href="infoeducatie/se/elev.php">LECTII NOI</a>
    <a href="infoeducatie/se/exercitiinoi.php">APLICATII NOI</a>
    <a href="infoeducatie/se/teste.php">TESTE</a>
    <a href="infoeducatie/se/deconectare.php">DECONECTARE</a>
</div>
<div id="header">
    <div class="text">REZULTATELE CAUTARII</div>
</div>
    <br><br><br>
    <?php echo $output;?>
    </body>
    </html>