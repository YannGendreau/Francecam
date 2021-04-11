/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)

//FICHIER CSS principal
import './styles/app.scss';



import  './modules/OverFontSize';
import  './modules/TitleFontSize';
import  './modules/slideMenu';
// import  './modules/Filter';






// import 'bootstrap/dist/css/bootstrap.min.css';

// import images
require('../assets/images/francecam-bg.jpg');

// js import 
const imagesContext = require.context('../assets/images', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
//JQUERY
import $ from 'jquery';
import 'select2';                      
import 'select2/dist/css/select2.css';

$('select').select2();

$("#clickMenu").on("click", function(){
    $(this).toggleClass("sidepanel__open sidepanel__close");
  });


  
	$(function(){
	
	$('#cssmenu li.active').addClass('open').children('ul').show();
		$('#cssmenu li.has-sub>a').on('click', function(){
			$(this).removeAttr('href');
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
		$('#cssmenu li.has-sub-log>a').on('click', function(){
			$(this).removeAttr('href');
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
	
	});
	



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


//FILTRE JS AJAX (en developpement)
import Filter from './modules/Filter';
new Filter(document.querySelector('.js-filter'));

//Change hauteur de la carte camera en fonction de la largeur


  const camCard = document.getElementById("card");
  camCard.style.height = (camCard.style.width / 1.5) + "px";
  console.log('Test cam')





//----------------------------------------------------------------------





