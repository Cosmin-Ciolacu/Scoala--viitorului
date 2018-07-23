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
    function afis_raspunsuri(){
        $.ajax({
            url:"php/afis_raspunsuri.php",
            success:function(data){
                $('#afis_raspunsuri').html(data);
            }
        });
    }
    afis_raspunsuri();

    $(document).on('click','.corect',function(){
        var id = $(this).data('id');
        $.ajax({
            url:"php/corect.php",
            method:"POST",
            data:{id:id},
            success:function(data){
                afis_raspunsuri();
                alert(data);
            }
        });
    });
    $(document).on('click','.gresit',function(){
        var id = $(this).data('id');
        $.ajax({
            url:"php/gresit.php",
            method:"POST",
            data:{id:id},
            success:function(data){
                alert(data);
                afis_raspunsuri();
            }
        });
    });
});
