// Limit character Title show

var cam = document.getElementById("cameraTitre");


var titleFilm = document.getElementById("titleFilm");

if(titleFilm){
	if (titleFilm.innerText.length >= 20 && titleFilm.innerText.length < 39){
		titleFilm.style.fontSize = ('3.5rem')
	}
	else if(titleFilm.innerText.length >= 40){
		titleFilm.style.fontSize = ('3rem')
	}
	else{
		titleFilm.style.fontSize = ('4.5rem')
	}
	
}


var show = document.getElementById("titleFilmShow");

if(show){
	if (show.innerText.length >= 20 && show.innerText.length < 39){
	// if (titleFilm.innerText.length >= 20){
		show.style.fontSize = ('3rem')
	}
	else if(show.innerText.length >= 40){
		show.style.fontSize = ('2.5rem')
	}
	else{
		show.style.fontSize = ('4rem')
	}

}
