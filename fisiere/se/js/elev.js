function deschidere() {
    document.getElementById("mySidenav").style.marginLeft = "0px";
}

function inchidere() {
    document.getElementById("mySidenav").style.marginLeft = "-500px";
}
$(document).ready(function(){
    $('#cautare').keyup(function(){
        $.ajax({
            url:'php/cautare2.php',
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
    function afis_lectii(){
        $.ajax({
            url:"php/afislectii2.php",
            success:function(data){
                $('#lectii').html(data);
            }
        });
    }
    afis_lectii();
    $(document).on('click','.inteles',function(){
        var id = $(this).data('id');
        var cod = $(this).data('cod');
        $.ajax({
            url:"php/inteles.php",
            method:"POST",
            data:{id:id,cod:cod},
            success:function(data){
                if(data == 'ok') {
                    afis_lectii();
                }
            }
        });
    });
});
