<?php
include('php/functions.php');
include('php/db.php');
include('php/functii.php');
if(! session_id() ) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Skranji" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <style>
    body
      {
        background-color:#f1f1f1;
      }
      #header{
            background: url(img/header.jpg);
            background-size: cover;
        }
    
    </style>
    <title>BINE AI VENIT PROF.<?php echo $_SESSION["username"]; ?></title>
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
        <a href="adauga.html">INVITĂ ELEVI</a>
        <a href="clase.php">CLASELE MELE</a>
        <a href="teste2.php">TESTE</a>
        <a href="deconectare.php">DECONECTARE</a>
    </div>
    <div id="header">
        <div class="text">PAGINA DE PORNIRE</div>
    </div>
    <br><br><br>
    <center>
    
        <div id="buttons">
            <div id="button" class="Lectii"><i class="fa fa-book"></i> Lectii </div>
            <div id="button" class="Exercitiu"><i class="fa fa-gamepad" aria-hidden="true"></i> Aplicatii</div>
        </div>
    </div>
    </center>
    <div id="lectii"></div>
    <div id="exercitii" style="display:none"></div>
    <div id="searchbox">
       <input type="text" id="cautare" name="cautare" placeholder="Cauta elevi sau lectii" >
       <div id="rezultat"></div>
    </div>
    <button id="adauga" data-toggle="modal" data-target="#myModal"><div id="align">+</div></button>
    <div class="modal fade" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Adauga...</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
      <center>
        <div id="modalitem" data-toggle="modal" data-target="#lectie">
           <img src="img/book.png" /> <br /> Adaugă o lecție
        </div>
        <div id="modalitem" data-toggle="modal" data-target="#exercitiu">
           <img src="img/controller.png" /> <br /> Adaugă o aplicație
        </div>
         <a href="creare_test.php" style="color: black;">
             <div id="modalitem" data-toggle="modal" data-target="#lectie">
              <img src="img/controller.png" /> <br /> Adaugă un test
          </div>
         </a>
      </center>
      </div>
    </div>
  </div>
  <div class="modal fade" id="lectie">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Adaugă o lecție</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="form1">
            <div class="form-group">
                <label for="email">Titlu lecției:</label>
                <input type="text" name="Titlu" class="form-control" id="Titlu2">
            </div>
            <div class="form-group">
                <label for="email">Conținut:</label>
                <textarea class="form-control" id="continut" name="continut" style="height: 150px;"></textarea>
            </div>
            <div class="form-group">
                <label for="email">Adaugă un fisier:</label>
                <input type="file" name="fisier" style="height: 40px;" class="form-control" id="fisier" required>
            </div>
            <div class="form-group">
                <label>Adaugă in clasa:</label>
                <select name="clasa" id="clasa" class+"form-control"></select>
            </div>
            <button type="submit" class="btn btn-success">Adaugă lecția</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exercitiu">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Adaugă o aplicație</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="form2">
            <div class="form-group">
                <label for="email">Enunțul aplicației:</label>
                <textarea class="form-control" id="Exercitiu" name="continut" style="height: 150px;"></textarea>
            </div>
            <div class="form-group">
                <label for="email">Adaugă un fisier:</label>
                <input type="file" name="fisier" style="height: 40px;" class="form-control" id="fisier" required>
            </div>
            <div class="form-group">
                <label>Adauga in clasa:</label>
                <select name="clasa" id="clasa2" class+"form-control"></select>
            </div>
            <button type="submit" class="btn btn-success">Adaugă aplicația</button>
        </form>
      </div>
    </div>
  </div>
</div>
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
                <input type="file" name="pp" style="height: 40px;" class="form-control" id="pp" required accept=".jpg,.png">
            </div>
            <button type="submit" class="btn btn-success">Editeaza lectia</button>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
<script src="js/prof.js"></script>