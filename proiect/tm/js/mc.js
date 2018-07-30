
function deschidere() {
    document.getElementById("mySidenav").style.marginLeft = "0px";
}

function inchidere() {
    document.getElementById("mySidenav").style.marginLeft = "-500px";
}


/*$(document).ready(function(){
    $(window).scroll(function(event){
        var y = $(this).scrollTop();
        console.log(y);
        if(y >= 400 && y < 840){
            $('#text1').addClass('animate');
        } else if(y >= 840 && y < 1800){
            $('#text2').addClass('animate');    
        } else if(y >= 1800 && y < 3600){
            $('#text3').addClass('animate');
        } else if(y >= 3600 && y < 4000){
            $('#text4').addClass('animate');
        } else if(y >= 4000){
            $('#text5').addClass('animate');
        }
    });
});*/