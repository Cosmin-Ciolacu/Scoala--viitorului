<?php
session_start();
include('php/db.php');
include ('php/functii.php');
$clasa = $_REQUEST["clasa"];
$sql = "SELECT * FROM lectii WHERE clasa='$clasa' ORDER BY id_lectie DESC";
$rez = mysqli_query($con,$sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista clase de afisat</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id_lectie = $row[0];
        $titlu = $row[2];
        $continut = $row[3];
        $fisier = $row[4];
        if(strpos($fisier,'.jpg') || strpos($fisier,'.png')) {
            $output .= '
             <div id="text">
               <div class="titlulectie">'.$titlu.' <button class="btn btn-outline-success edit" data-id="'.$id_lectie.'"  data-toggle="modal" data-target="#edit"style="float: right; width: 100px; background: #d6ea84e6; color: #2859a7; border-radius: 20%; border-color: #2859a7; margin-top: 0.5%;">Editeaza</button></div>
               <div id="indent">'.$continut.'</div>
               <center><p><img src="infoeducatie/se/php/fisiere/'.$fisier.'"></p></center>
             </div>
            ';
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
    <a href="infoeducatie/se/exercitiinoi2/<?php echo $clasa; ?>">APLICATIILE CLASEI</a>
    <a href="infoeducatie/se/teste_elev/<?php echo $clasa; ?>">TESTELE CLASEI</a>
    <a href="infoeducatie/se/elevi/<?php echo $clasa; ?>">ELEVII CLASEI</a>
    <a href="infoeducatie/se/deconectare.php">DECONECTARE</a>
</div>
<div id="header">
    <div class="text"><?php echo $clasa; ?></div>
</div>
<br><br><br>
<div class="container"><?php echo $output; ?></div>
<div class="modal fade" id="edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Editeaza lectia</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="edit_form">
            <div class="form-group">
                <label for="email">Titlu lectiei:</label>
                <input type="text" name="Titlu2" class="form-control" id="Titlu2">
            </div>
            <div class="form-group">
                <label for="email">Continut:</label>
                <textarea class="form-control" id="continut2" name="continut2" style="height: 150px;"></textarea>
            </div>
            <div class="form-group">
                <label for="email">Adauga un fisier:</label>
                <input type="file" name="fisier" style="height: 40px;" class="form-control" id="pp" required accept=".jpg,.png">
            </div>
            <button type="submit" class="btn btn-success">Editeaza lectia</button>
        </form>
      </div>
    </div>
  </div>
</div>
    </bady>
    </html>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.edit', function(){
                $.ajax({
                    url:"infoeducatie/se/php/afis_info.php",
                    dataType:"json",
                    method:"POST",
                    data:{id:$(this).data('id')},
                    success:function(data){
                        console.log(data);
                        $('#Titlu2').val(data.titlu);
                        $('#continut2').val(data.continut);
                    }
                });
            });
            $('#edit_form').on('submit',function(e){
        e.preventDefault();
        $.ajax({  
            url:"infoeducatie/se/php/edit_lectie.php",  
            method:"POST",  
            data:new FormData(this),  
            contentType:false,  
            //cache:false,  
            processData:false,  
            success:function(data)  
            {  
                alert(data);
            }  
       })  
    });
        });
    </script>