/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

//FICHIER CSS principal
import './styles/app.scss';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
//JQUERY
import $ from 'jquery';
global.$ = global.jQuery = $;

import 'select2';                      
import 'select2/dist/css/select2.css';
import  './modules/Filter';
import  './modules/TitleFontSize';
import  './modules/slideMenu';
import  './modules/charcount';

$('select').select2();
$('.cameras').select2({width:'resolve'});

// import 'bootstrap/dist/css/bootstrap.min.css';

// import images
require('../assets/images/francecam-bg.jpg');

// js import 
const imagesContext = require.context('../assets/images', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);



$("#clickMenu").on("click", function(){
    $(this).toggleClass("sidepanel__open sidepanel__close");
});


checkFontSize();


function checkFontSize() {
  var elems = document.querySelectorAll(".description__overlay");
  
  [].forEach.call(elems, function(el) {
    scaleFontSize(el);
  });  

}

function scaleFontSize(element) {

    element.style.fontSize = "100%";

    if (element.scrollWidth > element.clientWidth) {
        element.style.letterSpacing = "-0.05em";
    }

    if (element.scrollWidth > element.clientWidth) {
        element.style.letterSpacing = "0";
        element.style.fontSize = "80%";
    }
}


// Menu hamburger open/close
$(function(){
// Applique la classe open sur l'élément li.active
$('#cssmenu li.active').addClass('open').children('ul').show();
// au clic sur le <a> du premier niveau
	$('#cssmenu li.has-sub>a').on('click', function(){
		// Active le lien du <a> s'il a la classe tlf
		if ($(this).hasClass('tlf')){
			$(this).attr('href');
			// récupère le <li> parent du <a>
			var element = $(this).parent('li');
		}else{
			// sinon retire le lien
			$(this).removeAttr('href');
			// récupère le <li> parent du <a>
			var element = $(this).parent('li');
			// Si le <li> a la classe open 
			if (element.hasClass('open')) {
				// on lui retire la classe
				element.removeClass('open');
				// Retire la classe open aux <li> enfants
				element.find('li').removeClass('open');
				// Animation de repli vers le haut du <ul> enfant
				element.find('ul').slideUp(200);
				// Animation de repli vers le bas du <li> du même niveau
				element.siblings('li').slideDown(200);
		
			}else{
				// Si le <li> a la classe open 
				element.addClass('open');
				// Animation de repli vers le bas du <ul> enfant
				element.children('ul').slideDown(200);
				// Animation de repli vers le haut du <li> du même niveau et de son <ul> enfant
				element.siblings('li').children('ul').slideUp(200);
				// Animation de repli vers le haut du <li> du même niveau
				element.siblings('li').slideUp(200);
				// Retire la classe open aux <li> du même niveau
				element.siblings('li').removeClass('open');
				// Retire la classe open aux <li> du <li> du même niveau
				element.siblings('li').find('li').removeClass('open');
				// Cache les <li> enfants des <li> du même niveau
				element.siblings('li').find('li').display= "none";
				// Animation de repli vers le haut du <ul> enfants du <li> du même niveau
				element.siblings('li').find('ul').slideUp(200);
			}
		}
	});
	$('#cssmenu li.has-sub-log>a').on('click', function(){
	
	
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp(200);
		}
		else {
			element.addClass('open');
			element.children('ul').slideDown(200);
			element.siblings('li').children('ul').slideUp(200);
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp(200);
		}
	});
	$('#cssmenu li.has-sub-reg>a').on('click', function(){
		// $(this).removeAttr('href');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp(200);
		}
		else {
			element.addClass('open');
			element.children('ul').slideDown(200);
			element.siblings('li').children('ul').slideUp(200);
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('ul').slideUp(200);
		}
	});
	$('#cssmenu li.has-sub>a.tlf').on('click', function(){
		// $(this).attr('href');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			// element.find('li').removeClass('open');
			// element.find('ul').slideUp(200);
		}
		else {
			element.addClass('open');
			// element.children('ul').slideDown(200);
			// element.siblings('li').children('ul').slideUp(200);
			// element.siblings('li').removeClass('open');
			// element.siblings('li').find('li').removeClass('open');
			// element.siblings('li').find('ul').slideUp(200);
		}
	});

});

//TOGGLE TABS PAGE FILM, CAMERA, MARQUE-----------------------------------

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

//Change les tableaux quand le bouton est activé------------------------
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

/*-------------------------------------------------------------------------------------
					FERMETURE FLASH MESSAGE
-------------------------------------------------------------------------------------*/


setTimeout(function() {
	$ ('#showflash').slideUp("slow");
}, 5000)

setTimeout(function() {
	$ ('.success').slideUp("slow");
}, 5000)

/*-------------------------------------------------------------------------------------
					IMPORT FILTRE AJAX FILM/CAMERA
-------------------------------------------------------------------------------------*/
//FILTRE JS AJAX
import Filter from './modules/Filter';
new Filter(document.querySelector('.js-filter'));


/*-------------------------------------------------------------------------------------
					CARTE HAUTEUR
-------------------------------------------------------------------------------------*/

//Change hauteur de la carte camera en fonction de la largeur---------------

const camCard = document.getElementById("card");

if(camCard){
	camCard.style.height = (camCard.style.width / 1.5) + "px";
}

/*-------------------------------------------------------------------------------------
					FONDU DU BACKGROUND SUR "A PROPOS" 
-------------------------------------------------------------------------------------*/

function backgroundFade(mediaQueryList){
if (mediaQueryList.matches) {
	
	$('#about').on("mouseenter", function(){
		setTimeout (function(){	
		$('main').toggleClass('dark');}, 1000);

	}).on("mouseleave", function(){
	setTimeout (function(){	
	$('main').removeClass('dark');}, 5000);
	})
}else{$('#about').on("mouseenter", function(){
	
	$('main').removeClass('dark');

})

}
}

var mediaQueryList = window.matchMedia("(min-width: 1023px)")
	backgroundFade(mediaQueryList) 
	mediaQueryList.addListener(backgroundFade)

	/**------------------------------- */

/*-------------------------------------------------------------------------------------
					A PROPOS FLECHES HAUT ET BAS
-------------------------------------------------------------------------------------*/


$('#clickDown').on('click', function(){
	
	$('#about').animate({scrollTop: '+=600px'});
})
$('#clickUp').on('click', function(){
	
	$('#about').animate({scrollTop: '-=600px'});
})





