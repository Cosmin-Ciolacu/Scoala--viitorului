function deschidere() {
    document.getElementById("mySidenav").style.marginLeft = "0px";
}

function inchidere() {
    document.getElementById("mySidenav").style.marginLeft = "-500px";
}

$(document).ready(function(){
    $('#cautare').keyup(function(){
        $.ajax({
            url:'php/cautare.php',
            method:"POST",
            data:{cautare:$('#cautare').val()},
            success:function(data){
                $('#rezultat').html(data);
            },
            error:function(){
                alert("nu");
            }
        });
    });
    $('#item').click(function(){
        if($('#searchbox').css('margin-top') == '-60px') {
            $('#searchbox').css('margin-top','100px');
            $('#item').html('');
            $('#item').html('<i class="material-icons">close</i>');
        } else {
            $('#searchbox').css('margin-top','-60px');
            $('#item').html('');
            $('#item').html('<i class="material-icons">search</i>');
            $('#rezultat').html('');
        }
    });

    $('#form1').on('submit',function(e){
        e.preventDefault();
        $.ajax({  
            url:"php/lectie.php",  
            method:"POST",  
            data:new FormData(this),  
            contentType:false,  
            //cache:false,  
            processData:false,  
            success:function(data)  
            {  
                alert(data);
                //$('#myModal').modal('hide');
                afis_lectii();
            }  
       })  
    });
    function afis_clase(){
        $.ajax({
            url:"php/afisclase.php",
            success:function(data){
                $('#clase').html(data);
            }
        });
    }
    afis_clase();
    function afis_clase2(){
        $.ajax({
            url:"php/afis_clase.php",
            success:function(data){
                $('#clase').html(data);
            }
        });
    }
    afis_clase2();

    $('#form2').on('submit',function(e){
        e.preventDefault();
        $.ajax({  
            url:"php/Exercitii.php",  
            method:"POST",  
            data:new FormData(this),  
            contentType:false,  
            //cache:false,  
            processData:false,  
            success:function(data)  
            {  
                alert(data);
                afis_exercitii();
            }  
       })  
    });

    function afis_lectii(){
        $.ajax({
            url:"php/afislectii.php",
            success:function(data){
                $('#lectii').html(data);
            }
        });
    }
    afis_lectii();
    

    function afis_exercitii() {
        $.ajax({
            url:"php/afis_exercitii.php",
            success:function(data){
                $('#exercitii').html(data);
            }
        });
    }
    afis_exercitii();

    $('.Lectii').click(function(){
        if($('#exercitii').css('display') == 'none') {
            $('#exercitii').css('display','block');
            $('#lectii').css('display','none');
        } else {
            $('#lectii').css('display','block');
            $('#exercitii').css('display','none'); 
        }
        
    });

    $('.Exercitiu').click(function(){
        if($('#lectii').css('display') == 'none') {
            $('#lectii').css('display','block');
            $('#exercitii').css('display','none');
        } else {
            $('#lectii').css('display','none');
            $('#exercitii').css('display','block');
        }
    });

    function clase(){
        $.ajax({
            url:"php/afisclase.php",
            success:function(data){
                $('#clasa').html(data);
            }
        });
    }
    clase();

    function clase2(){
        $.ajax({
            url:"php/afisclase.php",
            success:function(data){
                $('#clasa2').html(data);
            }
        });
    }
    clase2();

    $(document).on('click','.raspunsuri',function(){
        var id = $(this).data('id');
    $('#answers').modal('show');
        $.ajax({
            url:"php/raspunsuri.php",
            method:"POST",
            data:{id:id},
            success:function(data){
                $('#listarasp').html(data);
            }
        });
    });
});
