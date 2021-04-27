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


import  './modules/OverFontSize';
import  './modules/TitleFontSize';
import  './modules/slideMenu';
import  './modules/charcount';
import  './modules/dynamicForm';
import  './modules/dynamicFields';
// import  './modules/Filter';






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


  
$(function(){

$('#cssmenu li.active').addClass('open').children('ul').show();
	$('#cssmenu li.has-sub>a').on('click', function(){

		if ($(this).hasClass('tlf')){
			$(this).attr('href');
			var element = $(this).parent('li');
		}
		else{
			$(this).removeAttr('href');
		var element = $(this).parent('li');
		if (element.hasClass('open')) {
			element.removeClass('open');
			element.find('li').removeClass('open');
			element.find('ul').slideUp(200);
			element.siblings('li').slideDown(200);
		
		}
		else {
			element.addClass('open');
			element.children('ul').slideDown(200);
			element.siblings('li').children('ul').slideUp(200);
			element.siblings('li').slideUp(200);
			element.siblings('li').removeClass('open');
			element.siblings('li').find('li').removeClass('open');
			element.siblings('li').find('li').display= "none";
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


const $post_category = $("#cam_list")
const $token = $("#film__token")

if($post_category){
    $post_category.on(function ()
{
    const $form = $(this).closest('form')
    const data ={}

    data[$token.attr('name')] = $token.val()
    data[$post_category.attr('name')] = $post_category.val()

    $.post($form.attr('action'), data).then(function (response)
    {
        $("#film_modele").replaceWith(
            $(response).find("#film_modele")
        )
    })
    

})
}
	



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

//Close up FlashMessage----------------------------------------------------

setTimeout(function() {
	$ ('#showflash').slideUp("slow");
}, 5000)
setTimeout(function() {
	$ ('.success').slideUp("slow");
}, 5000)


//FILTRE JS AJAX (en developpement)-----------------------------------------
import Filter from './modules/Filter';
new Filter(document.querySelector('.js-filter'));


//Change hauteur de la carte camera en fonction de la largeur---------------


  const camCard = document.getElementById("card");
  if(camCard){
	  camCard.style.height = (camCard.style.width / 1.5) + "px";
  
  }
  


//----------------------------------------------------------------------



const $marque = $('#camera_marque');
 
// When emprise gets selected ...
$marque.on('change', function() {
	// ... retrieve the corresponding form.
	const $form = $(this).closest('form');
	// Simulate form data, but only include the selected sport value.
	const data = {};
	data[$marque.attr('name')] = $marque.val();

	// Submit data via AJAX to the form's action path.
	$.ajax({
		url : $form.attr('action'),
		type: $form.attr('method'),
		data : data,
		success: function(html) {
			// console.log(data)
			// Replace current position field ...
			$('#camera_modele').replaceWith(
			// ... with the returned one from the AJAX response.
			$(html).find('#camera_modele')
			);
			// Position field now displays the appropriate positions.
			$('#camera_modele').select2();
		}
	});
});


const $marqueFilm = $('#film_camera_add_marque');

// When emprise gets selected ...
$marqueFilm.on('change', function() {
  // ... retrieve the corresponding form.
  const $form = $(this).closest('form');
  // Simulate form data, but only include the selected sport value.
  const data = {};
data[$marqueFilm.attr('name')] = $marqueFilm.val();

// Submit data via AJAX to the form's action path.
$.ajax({
url : $form.attr('action'),
type: $form.attr('method'),
data : data,
success: function(html) {
  console.log(data)
// Replace current position field ...
$('#film_camera_modele').replaceWith(
// ... with the returned one from the AJAX response.
$(html).find('#film_camera_modele')
);
// Position field now displays the appropriate positions.
}
});
});



// setup an "add a tag" link
var $addTagLink = $('<a href="#" class="add_tag_link"><button class="btnCamAdd">Ajouter</button></a>');
var $newLinkLi = $('<li class="add"></li>').append($addTagLink);


    // Get the ul that holds the collection of tags
   var $collectionHolder = $('ul#email-fields-list');
    
    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);
    
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);
    	$($newLinkLi).fadeIn().slideDown().dequeue();
    $addTagLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new tag form (see code block below)
        addTagForm($collectionHolder, $newLinkLi);
		
    });
    

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');
    
    // get the new index
    var index = $collectionHolder.data('index');
    
    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);
    
    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);
    
    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormLi = $('<li></li>').append(newForm);
   
    // also add a remove button, just for this example
    $newFormLi.append('<a href="#" class="remove-tag"><button class="btnCam">X</button></a>');
    
    $newLinkLi.before($newFormLi);

    $('select').select2({ width: 'resolve' });

    // handle the removal, just for this example
    $('.remove-tag').on('click', function(e) {
        e.preventDefault();
	
		$(this).parent().fadeOut("fast").slideUp(100).dequeue();
   
	

		
        
        
        return false;
    });

	
}






