const btnMenu = document.getElementById("clickMenu");
const btnClose = document.getElementById("close");
const btnRight = document.getElementById("clickRight");
const btnCloseRight = document.getElementById("closeRight");
const sidepanel = document.getElementById("mySidepanel");
const triangle = document.getElementById("triangle");

if(btnMenu){
btnMenu.addEventListener('click', function(){
    sidepanel.style.width = "17%";
    // sidepanel.style.width = "100%";
    sidepanel.style.height = "800px";
    sidepanel.style.opacity = "1";
    btnMenu.style.opacity= '0';
    triangle.style.opacity= '0';
});
btnClose.addEventListener('click', function(){
    sidepanel.style.width = "0";
    sidepanel.style.height = "0";
    sidepanel.style.opacity = "0";
    btnMenu.style.opacity= '1';
    triangle.style.opacity= '1';
});
}
if(btnRight){
btnRight.addEventListener('click', function(){
    document.getElementById("asideMenu").style.width = "100%";


    btnRight.style.opacity= '0';

});
btnCloseRight.addEventListener('click', function(){
    document.getElementById("asideMenu").style.width = "0";
    btnRight.style.opacity= '1';
});
}



