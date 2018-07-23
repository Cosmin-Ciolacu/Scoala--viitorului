<?php
include('php/db.php');
include ('php/functii.php');
session_start();
$id = $_REQUEST['id'];
$sql = "SELECT * FROM login WHERE id_utilizator='$id'";
$rez = mysqli_query($con,$sql);
while($row = mysqli_fetch_array($rez)) {
    $username = $row[1];
    $mail = $row[2];
    $img = $row[4];
    $score = $row[9];
}
$rasp_corecte = mysqli_num_rows(mysqli_query($con,"SELECT * FROM raspunsuri WHERE id_utilizator='$id' AND corect='1'"));
$rasp_gresite = mysqli_num_rows(mysqli_query($con,"SELECT * FROM raspunsuri WHERE id_utilizator='$id' AND corect='0'"));
$le = mysqli_num_rows(mysqli_query($con,"SELECT * FROM inteles WHERE id_utilizator='$id'"));
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
            background: url(infoeducatie/se/img/bg2.jpg);
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
    <a href="infoeducatie/se/javascript:void(0)" class="closebtn" onclick="inchidere()">&times;</a>
    <a href="infoeducatie/se/adauga.html">ADAUGA CLASE SAU ELEVI</a>
    <a href="infoeducatie/se/clase.php">CLASELE MELE</a>
    <a href="infoeducatie/se/teste2.php">TESTE</a>
    <a href="infoeducatie/se/deconectare.php">DECONECTARE</a>
</div>
<div id="header">
<div class="titlu"><?php echo $_SESSION["username"]; ?></div>
    <center>
        <img src="infoeducatie/se/php/fisiere/<?php echo get_image($con, $_SESSION['username']); ?>" class="imagine" />
    </center>
</div>
    <center>
    <table class="table table-striped" style="width: 50%; left:50px; margin-top:80px;">
    <tbody>
      <tr>
        <td>Nume de utilizator: </td>
        <td><?php echo $username; ?></td>
      </tr>
      <tr>
        <td>Mail:</td>
        <td><?php echo $mail; ?></td>
      </tr>
      <tr>
        <td>Punctaj:</td>
        <td><?php echo $score; ?></td>
      </tr>
      <tr>
        <td>Raspunsuri corecte:</td>
        <td><?php echo $rasp_corecte; ?></td>
      </tr>
      <tr>
        <td>Raspunsuri gresite:</td>
        <td><?php echo $rasp_gresite; ?></td>
      </tr>
      <tr>
        <td>Lectii intelese:</td>
        <td><?php echo $le; ?></td>
      </tr>
    </tbody>
    </table>
      </center>
      <center><div id="piechart" style="width: 900px; height: 300px; background: #f1f1f1;"></div></center> 
    </body>
    </html>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['RASPUNSURI CORECTE', 'RASPUNSURI GRESITE'],
          ['RASPUNSURI CORECTE', <?php echo $rasp_corecte; ?>],
          ['RASPUNSURI GRESITE', <?php echo $rasp_gresite; ?>]

        ]);

        var options = {
          backgroundColor:'#f1f1f1'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>