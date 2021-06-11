// déclaration des variables
var btnMenu = document.getElementById("clickMenu");
var btnClose = document.getElementById("close");
var btnRight = document.getElementById("clickRight");
var btnCloseRight = document.getElementById("closeRight");
var sidepanel = document.getElementById("mySidepanel");
var triangle = document.getElementById("clickMenu");
var showlist = document.getElementById("rightside");

function filterLeft(mediaQueryList) {
    // Si présence du bouton clickMenu ou de la div rightside
    if(btnMenu || showlist){
    // si les médiaqueries correspondent(max-width: 768px)
    if (mediaQueryList.matches) {
        // évènement au clic sur clickMenu
        btnMenu.addEventListener('click', function(){
            // change les taille et opacité de sidepanel 
            sidepanel.style.width = "70%";
            sidepanel.style.height = "100vh";
            sidepanel.style.opacity = "1";
            triangle.style.opacity = "0.2"

        });
        // évènement au clic sur close
        btnClose.addEventListener('click', function(){
            sidepanel.style.width = "0";
            sidepanel.style.height = "0";
            sidepanel.style.opacity = "0";
            triangle.style.opacity = "1"
        });
    } else {
        // si la taille correspond au desktop
        btnMenu.addEventListener('click', function(){
            sidepanel.style.width = "17%";
            sidepanel.style.height = "100vh";
            sidepanel.style.opacity = "1";
            triangle.style.opacity = "0.2"
        });
        btnClose.addEventListener('click', function(){
            sidepanel.style.width = "0";
            sidepanel.style.height = "0";
            sidepanel.style.opacity = "0";
            triangle.style.opacity = "1"
        }); 
    }
    //Si mode desktop : affichage à 8% de largeur, sinon 17%
    if(mediaQueryList.matches){
                sidepanel.style.width = '80%';
                
            }else{
                sidepanel.style.width = '17%';
            }
    }
  }

// Récupère la taille de la fenêtre
var mediaQueryList = window.matchMedia("(max-width: 767px)")
// injecté dans la fonction filterLeft
filterLeft(mediaQueryList) 
mediaQueryList.addListener(filterLeft)


// Si le bouton hamburger est présent
if(btnRight){
    // Ajoute un évènement au clic
    btnRight.addEventListener('click', function(){
        // déploie le menu sur 100% de la largeur de la fenêtre.
        document.getElementById("asideMenu").style.width = "100%";
        // Fondu en entrée des liens après 700ms
        setTimeout(function(){
            document.getElementById("cssmenu").style.opacity = "1";
        }, 700)
        // opacité du bouton hamburger à 0
        btnRight.style.opacity= '0';
    });
    // Ajoute un évènement au clic sur le bouton fermer
    btnCloseRight.addEventListener('click', function(){
        // replie le menu 
        document.getElementById("asideMenu").style.width = "0";
        // fondu en sortie des liens
        document.getElementById("cssmenu").style.opacity = "0";
        // opacité du bouton hamburger à 1
        btnRight.style.opacity= '1';
    });
}


