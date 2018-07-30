<?php
session_start();
include ('php/db.php');
include ('php/functii.php');
$link_titlu = $_REQUEST["titlu"];
$sql = "SELECT * FROM test_2 WHERE titlu_test='$link_titlu'";
$rez = mysqli_query($con,$sql);
$output = '';
$nr_intrebare = 1;
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista lectii de afisat</div>';
} else {
    while ($row = mysqli_fetch_array($rez)) {
        $enunt = $row[2];
        $var_a = $row[3];
        $var_b = $row[4];
        $var_c = $row[5];
        $var_corect = $row[6];
        $fisier = $row[7];
        $id_var = $row[0];
        $raspunsuri[] = $var_corect;
        if (strpos($fisier, '.jpg') || strpos($fisier, '.png')) {
            $output .= '
             <div id="text" class="q'.$nr_intrebare.'" data-corect="' . $var_corect . '" data-id="' . $id_var . '">
               <div class="titlulectie">Intrebarea numarul ' . $nr_intrebare . '</div>
               <div id="indent">' . $enunt . '</div>
               <div id="tot2">
                 <center>
                    <button class="btn-outline-info rasp" data-corect="'.$var_corect.'" style="margin-left: 50px; width: 100px;">' . $var_a . '</button>  
                    <button class="btn-outline-info rasp" data-corect="'.$var_corect.'" style="margin-left: 50px; width: 100px;">' . $var_b . '</button>  
                    <button class="btn-outline-info rasp" data-corect="'.$var_corect.'" style="margin-left: 50px; width: 100px;">' . $var_c . '</button> 
                 </center>
               </div>
             </div>
            ';
        } else {
            $output .= '
             <div id="text" class="q'.$nr_intrebare.'" data-corect="' . $var_corect . '" data-id="' . $id_var . '">
               <div class="titlulectie">Intrebarea numarul ' . $nr_intrebare . '</div>
               <div id="indent">' . $enunt . '</div>
               
               <div id="tot2">
                 <center>
                    <button class="btn-outline-info rasp'.$nr_intrebare.'" data-corect="'.$var_corect.'" style="margin-left: 50px; width: 100px;">' . $var_a . '</button>  
                    <button class="btn-outline-info rasp'.$nr_intrebare.'" data-corect="'.$var_corect.'" style="margin-left: 50px; width: 100px;">' . $var_b . '</button>  
                    <button class="btn-outline-info rasp'.$nr_intrebare.'" data-corect="'.$var_corect.'" style="margin-left: 50px; width: 100px;">' . $var_c . '</button> 
                 </center>
               </div>
               
             </div>
            ';

        }
        $nr_intrebare += 1;
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
    <div class="text">REZOLVAREA TESTULUI</div>
</div>
<br><br><br>
<div id="teste"> <?php echo $output; ?> </div>
<div class="container">
    <center>
        <div class="form-group" style="margin-top: 50px;">
            <button class="btn btn-success" id="finish" data-titlu="<?php echo $link_titlu; ?>">FINALIZARE TEST</button>
        </div>
    </center>
</div>
<div id="text" class="text" style="display: none;">
    <div id="titlu" >REZULTATUL TESTULUI</div>
    <div id="indent" class="rezultat"></div>
</div>
</body>
</html>
<script>
    $(document).ready(function () {
        var score = 1;
        var nr = 0;


        $(document).on('click', '.rasp1', function () {
            var rasp_corect = $(this).data('corect');
            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
                console.log(score);
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });


        $(document).on('click', '.rasp2', function () {
            var rasp_corect = $(this).data('corect');
            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });



        $(document).on('click', '.rasp3', function () {
            var rasp_corect = $(this).data('corect');
            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });



        $(document).on('click', '.rasp4', function () {
            var rasp_corect = $(this).data('corect');

            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });



        $(document).on('click', '.rasp5', function () {
            var rasp_corect = $(this).data('corect');

            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });

        $(document).on('click', '.rasp6', function () {
            var rasp_corect = $(this).data('corect');

            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });
        $(document).on('click', '.rasp7', function () {
            var rasp_corect = $(this).data('corect');

            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });
        $(document).on('click', '.rasp8', function () {
            var rasp_corect = $(this).data('corect');

            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });
        $(document).on('click', '.rasp9', function () {
            var rasp_corect = $(this).data('corect');

            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });
        $(document).on('click', '.rasp10', function () {
            var rasp_corect = $(this).data('corect');

            $(this).removeClass('btn-outline-info');
            if ($(this).text() == rasp_corect) {
                $(this).removeClass('btn-outline-info');
                $(this).addClass('btn btn-success');
                score += 0.9
            } else {
                $(this).addClass('btn btn-danger');
                $(this).removeClass('btn-outline-info');
            }


        });



        function speak(text) {
            var vorbit = new SpeechSynthesisUtterance();
            vorbit.lang = "ro-RO";
            vorbit.text = text;
            window.speechSynthesis.speak(vorbit);
        }

        $('#finish').click(function () {
            var titlu = $(this).data('titlu');
            console.log(titlu);
            $('#teste').css('display','none');
            $('#finish').css('display','none');
            if(score<4)
                var text = "Ai greșit cam mult...studiazā mai profund!" ;
            else
            if(score<6)
                var text = "Este insuficient...încearcă să înveți mai mult!" ;
            else
            if(score<8)
                var text = "Bine....în mod cert poți obține mai mult!" ;
            else
                if(score == 10)
                    var text = "Felicitari! Se vede ca ai studiat!";
            $('.text').css('display','block');
            var text2 = text + '\n' + 'si ai optinut nota: ' + score;
            $('.rezultat').html(text2);
            add_to_db(titlu, score);
            speak(text2);
        });

        function add_to_db(titlu, pct) {
            $.ajax({
                url:"infoeducatie/se/php/fin_test.php",
                method:"POST",
                data:{
                    titlu:titlu,
                    pct:pct
                },
                success:function (data) {
                    console.log(data);
                }
            });
        }
    });
</script>