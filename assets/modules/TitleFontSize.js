// Limit character Title show

var cam = document.getElementById("cameraTitre");

// if(cam){
// 	// if (titleFilm.innerText.length >= 20 && titleFilm.innerText.length < 39){
// 	if (cam.innerText.length >= 14  && titleFilm.innerText.length < 24){
// 		cam.style.fontSize = ('3.8rem')
// 	}
// 	// else if(titleFilm.innerText.length >= 40){
// 	// 	titleFilm.style.fontSize = ('3rem')
// 	// }
// 	else if (cam.innerText.length > 24){
// 		cam.style.fontSize = ('3rem')
// 	}
// 	else{
// 		cam.style.fontSize = ('4.5rem')
// 	}
// }	

var titleFilm = document.getElementById("titleFilm");

if(titleFilm){
	if (titleFilm.innerText.length >= 20 && titleFilm.innerText.length < 39){
	// if (titleFilm.innerText.length >= 20){
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
