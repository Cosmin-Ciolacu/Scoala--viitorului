<?php
include ('php/db.php');
include ('php/functii.php');
session_start();
$titlu = $_REQUEST['titlu'];
$rez1 = mysqli_query($con,"SELECT * FROM rez_teste where link_titlu_test='$titlu' AND punctaj <= 4");
$note1 = mysqli_num_rows($rez1);
$rez2 = mysqli_query($con,"SELECT * FROM rez_teste where link_titlu_test='$titlu' AND punctaj >= 4");
$note2 = mysqli_num_rows($rez2);
//echo $note1 . ' ' . $note2;
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
        <img src="php/fisiere/<?php echo get_image($con, $_SESSION['username']); ?>" class="imagine" />
    </center>
    <a href="javascript:void(0)" class="closebtn" onclick="inchidere()">&times;</a>
    <a href="infoeducatie/se/adauga.html">ADAUGA CLASE SAU ELEVI</a>
    <a href="infoeducatie/se/clase.php">CLASELE MELE</a>
    <a href="infoeducatie/se/teste2.php">TESTE</a>
    <a href="infoeducatie/se/deconectare.php">DECONECTARE</a>
</div>
<div id="header">
    <div class="text">REZULTATELE TESTULUI</div>
</div>
<div id="searchbox">
    <input type="text" id="cautare" name="cautare" placeholder="Cauta elevi sau lectii" >
    <div id="rezultat"></div>
</div>
<div id="piechart" style="width: 60%; height: 500px; margin-top: 5%; margin: 0 auto;"></div>
</body>
</html>
<script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

        var data = google.visualization.arrayToDataTable([
            ['Rezultate', 'Note optinute la test'],
            ['Note mai mici decat 4', <?php echo $note1; ?>],
            ['Note mai mari decat 4', <?php echo $note2; ?>]
        ]);

        var options = {
            title: 'Diagrama cu rezultatele acestui text',
            backgroundColor:'#f1f1f1',
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }
</script>