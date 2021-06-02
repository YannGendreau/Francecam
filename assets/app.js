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
$('select').select2();

import  './modules/Filter';
import  './modules/OverFontSize';
import  './modules/TitleFontSize';
import  './modules/slideMenu';
import  './modules/charcount';
// import  './modules/menuHamburger';



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


// const $post_category = $("#cam_list")
// const $token = $("#film__token")

// if($post_category){
//     $post_category.on(function ()
// {
//     const $form = $(this).closest('form')
//     const data ={}

//     data[$token.attr('name')] = $token.val()
//     data[$post_category.attr('name')] = $post_category.val()

//     $.post($form.attr('action'), data).then(function (response)
//     {
//         $("#film_modele").replaceWith(
//             $(response).find("#film_modele")
//         )
//     })
    

// })
// }


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
					AJAX CAMERATYPE 
-------------------------------------------------------------------------------------*/
// Récupère l'input "marque"

const $marque = $('#camera_marque');
 
// Quand l'input est sélectionné et "change"...
$marque.on('change', function() {
	// ... on appelle le formulaire parent
	const $form = $(this).closest('form');
	// data =  tableau vide
	const data = {};
	//  désigne l'attribut "name" comme valeur de l'input
	data[$marque.attr('name')] = $marque.val();

	// Soumet les données au chemin d'action du formulaire.
	$.ajax({
		url : $form.attr('action'),
		type: $form.attr('method'),
		data : data,
		success: function(html) {
			// Remplace le champ actuel...
			$('#camera_modele').replaceWith(
			// ... par celui de la réponse en AJAX
			$(html).find('#camera_modele')
			);
			// liste de Select2
			$('#camera_modele').select2();
		}
	});
});

/*-------------------------------------------------------------------------------------
					AJAX COLLECTIONTYPE 
-------------------------------------------------------------------------------------*/
// Récupère l'input "marque"
const $marqueFilm = $('.js-marque-ajax');

// Quand l'input est sélectionné et "change"...
$marqueFilm.on('change', function() {
	// ... on appelle le formulaire
	const $form = $(this).closest('form');
	// data =  tableau vide
	const data = {};
	//  désigne l'attribut "name" comme valeur de l'input
	data[$marqueFilm.attr('name')] = $marqueFilm.val();

	// Soumet les données au chemin d'action du formulaire.
	$.ajax({
		url : $form.attr('action'),
		type: $form.attr('method'),
		data : data,
		success: function(html) {
			// Remplace le champ actuel...
			$('.js-modele-ajax').replaceWith(
			// ... par celui de la réponse en AJAX
			$(html).find('.js-modele-ajax')

			);
			// liste de Select2
			$('.js-modele-ajax').select2()
			
		}
	});
});

/*-------------------------------------------------------------------------------------
					AJOUT DE FORMULAIRE POUR LE COLLECTIONTYPE 
-------------------------------------------------------------------------------------*/

// Ajout d'un bouton 'ajouter'
// le bouton Ajouter <a><button></a>
var $addTagLink = $('<a href="#" class="add_tag_link"><button class="btnCamAdd">Ajouter</button></a>');
// attache 'ajouter' à une liste 'add'
var $newLinkLi = $('<li class="add"></li>').append($addTagLink);


// Récupère le 'ul' qui contient la collection de cameras
var $collectionHolder = $('ul#camera-fields-list');

// Attache le bouton "ajouter" au conteneur des cameras
$collectionHolder.append($newLinkLi);

// Compte les nombre de formulaires et ajoute un nouvel index a chaque nouveau formulaire
$collectionHolder.data('index', $collectionHolder.find(':input').length);

	$($newLinkLi).fadeIn().slideDown().dequeue();

$addTagLink.on('click', function(e) {
	// Le lien ne génère pas de # dans l'URL
	e.preventDefault();

	// add a new tag form (see code block below)
	// Ajouter une nouvelle caméra
	addTagForm($collectionHolder, $newLinkLi);

	// $(this).fadeIn("fast").slideDown(100).dequeue();
});


function addTagForm($collectionHolder, $newLinkLi) {
    // Récupère le prototype du collectionHolder
    var prototype = $collectionHolder.data('prototype');
    
    // Récupère l'index
    var index = $collectionHolder.data('index');
    
	// Remplace le $$name$$ dans le prototype par le nombre d'items
    var newForm = prototype.replace(/__name__/g, index);
    
    // incrémente les items
    $collectionHolder.data('index', index + 1);
    
	// affiche le formulaire dans un li avant le bouton "ajouter"
    var $newFormLi = $('<li class ="panel"></li>').append(newForm);
   
    // also add a remove button, just for this example
    // Ajoute un bouton "supprimer"
    $newFormLi.append('<a href="#" class="remove-tag"><button class="btnCam">X</button></a>');
    // avant le bouton "ajouter"
    $newLinkLi.before($newFormLi);
	// pillboxes select 2
    $('select').select2({ width: 'resolve' });

    // suppression du formulaire
    $('.remove-tag').on('click', function(e) {
        e.preventDefault();
	
		$(this).parent().fadeOut("fast").slideUp(100).dequeue();
        
        return false;
    });	
}

/*-------------------------------------------------------------------------------------
					FONDU DU BACKGROUND SUR "A PROPOS" 
-------------------------------------------------------------------------------------*/

function backgroundFade(mediaQueryList){
if (mediaQueryList.matches) {
	
	$('#about').on("mouseenter", function(){
		setTimeout (function(){	
		$('main').toggleClass('dark');}, 2000);

	}).on("mouseleave", function(){
	setTimeout (function(){	
	$('main').removeClass('dark');}, 2000);
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





