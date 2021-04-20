const btnMenu = document.getElementById("clickMenu");
const btnClose = document.getElementById("close");
const btnRight = document.getElementById("clickRight");
const btnCloseRight = document.getElementById("closeRight");
const sidepanel = document.getElementById("mySidepanel");
const triangle = document.getElementById("triangle");
const showlist = document.getElementById("rightside");




function filterLeft(mediaQueryList) {
    if(btnMenu || showlist){
    if (mediaQueryList.matches) {
       
        btnMenu.addEventListener('click', function(){
            sidepanel.style.width = "80%";
            sidepanel.style.height = "100vh";
            sidepanel.style.opacity = "1";

        });
        btnClose.addEventListener('click', function(){
            sidepanel.style.width = "0";
            sidepanel.style.height = "0";
            sidepanel.style.opacity = "0";

        });
    } else {
        
        btnMenu.addEventListener('click', function(){
            sidepanel.style.width = "17%";
            sidepanel.style.height = "100vh";
            sidepanel.style.opacity = "1";
        });
        btnClose.addEventListener('click', function(){
            sidepanel.style.width = "0";
            sidepanel.style.height = "0";
            sidepanel.style.opacity = "0";
        }); 
    }
    if(mediaQueryList.matches){
                sidepanel.style.width = '80%';
                
            }else{
                sidepanel.style.width = '17%';
            }
    }
  }

  
  var mediaQueryList = window.matchMedia("(max-width: 767px)")
filterLeft(mediaQueryList) 
mediaQueryList.addListener(filterLeft)


if(btnRight){
btnRight.addEventListener('click', function(){
    document.getElementById("asideMenu").style.width = "100%";

    setTimeout(function(){
        document.getElementById("cssmenu").style.opacity = "1";
    }, 700)

    // 


    btnRight.style.opacity= '0';

});
btnCloseRight.addEventListener('click', function(){
    document.getElementById("asideMenu").style.width = "0";
    
    document.getElementById("cssmenu").style.opacity = "0";
    btnRight.style.opacity= '1';
});
}



