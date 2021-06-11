

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
