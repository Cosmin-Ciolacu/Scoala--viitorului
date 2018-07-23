function deschidere() {
    document.getElementById("mySidenav").style.marginLeft = "0px";
}

function inchidere() {
    document.getElementById("mySidenav").style.marginLeft = "-500px";
}
/*
$(document).ready(function(){
    $(window).scroll(function(event){
        var y = $(this).scrollTop();
        console.log(y);
        if(y >= 50 && y< 200){
            $('#text1').addClass('animate');
        } else  if(y >= 200 && y < 420) {
            $('#text2').addClass('animate');
        } else if(y >= 420 && y < 800){
            $('#text3').addClass('animate');
        }
		  else if(y >= 800 && y < 1500){
            $('#text4').addClass('animate');
        }
		  else if(y >= 1500){
            $('#text5').addClass('animate');
        }
    });

    $('#myModal').click(function(){
        inchidere();
    });
});
*/