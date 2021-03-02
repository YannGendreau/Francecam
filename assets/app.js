/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';
// import './styles/menu.scss';
// import './styles/film.scss';
// import './styles/film2.scss';
// import './styles/cartefilmfinal.scss';

// import 'bootstrap/dist/css/bootstrap.min.css';

// import images
require('../assets/images/francecam-bg.jpg');

// js import 
const imagesContext = require.context('../assets/images', true, /\.(png|jpg|jpeg|gif|ico|svg|webp)$/);
imagesContext.keys().forEach(imagesContext);

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery';

console.log('Hello Webpack Encore! Edit me in assets/app.js');



var col = document.getElementsByClassName("coll");
var i;

for (i = 0; i < col.length; i++) {
  col[i].addEventListener("click", function() {
    this.classList.toggle("active");

    var content = this.nextElementSibling;

    if (content.style.maxHeight) {
		content.style.maxHeight = "0px";
    } else {
		content.style.maxHeight = content.scrollHeight + "px";
    }
  });
}



/**
 * -------------------------------------------------------------
 */
// $(function() {
// 	var b = $("#collapsible");
// 	var w = $("#content");
// 	var l = $("#list");
	
// 	w.height(l.outerHeight(true));
  
// 	b.on( function() {
		
// 		  if(w.hasClass('open')) {
// 		w.removeClass('open');
// 		w.height(0);
// 	  } else {
// 		w.addClass('open');
// 		w.height(l.outerHeight(true));
// 	  }

// 	  if(b.hasClass('active')) {
// 		b.removeClass('active');
// 	  }else{
// 		b.addClass('active');
// 	  }
// 	});
//   });

/**
 * -------------------------------------------------------------
 */

// var coll = document.getElementsByClassName("collapsible");
// var i;

// for (i = 0; i < coll.length; i++) {
//   coll[i].addEventListener("click", function() {
//     this.classList.toggle("active");
//     var content = this.nextElementSibling;
//     if (content.style.display === "block") {
//       content.style.display = "none";
//     } else {
//       content.style.display = "block";
//     }
//   });
// }


var tabs = document.querySelectorAll(".buttonContainer button");
var tab_wraps = document.querySelectorAll(".tabPanel");
var border = document.getElementsByClassName(".borderBottom")[0];

tabs.forEach(function(tab, tab_index){
	tab.addEventListener("click", function(){
		tabs.forEach(function(tab){
			tab.classList.remove("active");
		})
		tab.classList.add("active");

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
