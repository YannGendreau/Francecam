/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

//FICHIER CSS principal
import './styles/app.scss';

//FILTRE JS AJAX (en developpement)
// import Filter from './modules/Filter';
import Filter from './modules/TitleFontSize';

//JQUERY
// new Filter(document.querySelector('.js-filter'));

// import 'bootstrap/dist/css/bootstrap.min.css';

// import images
require('../assets/images/francecam-bg.jpg');

// js import 
const imagesContext = require.context('../assets/images', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';
import 'select2';                      
import 'select2/dist/css/select2.css';
$('select').select2();

//TOGGLE TABS PAGE FILM, CAMERA, MARQUE

//Boutons de description
var tabs = document.querySelectorAll(".buttonContainer button");
var tab_wraps = document.querySelectorAll(".tabPanel");

//Change les boutons au clic
tabs.forEach(function(tab, tab_index){
	tab.addEventListener("click", function(){
		tabs.forEach(function(tab){
			tab.classList.remove("active");
		})
		tab.classList.add("active");

//Change les tableaux quand le bouton est activé
		tab_wraps.forEach(function(content, content_index){
			if(content_index == tab_index){
				content.style.display = "block";
			}
			else{
				content.style.display = "none";
			}
		})
	})
})

//Close up FlashMessage

setTimeout(function() {
	$ ('#showflash').slideUp("slow");
}, 5000)
setTimeout(function() {
	$ ('.success').slideUp("slow");
}, 5000)



// Limit character Title show

var titleFilm = document.getElementById("titleFilm");


	if (titleFilm.innerText.length >= 20 && titleFilm.innerText.length < 39){
		titleFilm.style.fontSize = ('3.5rem')
	}else if(titleFilm.innerText.length >= 40){
		titleFilm.style.fontSize = ('3rem')
	}else{
		titleFilm.style.fontSize = ('4.5rem')
	}


//----------------------------------------------------------------------





