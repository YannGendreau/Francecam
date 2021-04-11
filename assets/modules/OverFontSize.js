//Limit character Title card

var list = document.getElementsByClassName('tableau')
// var over = document.getElementById("over");
var i;

for (i = 0; i < list.length; i++) {
	
	var over = document.getElementById("over");

	if (over.innerText.length > 20 && over.innerText.length < 39){
		over.style.fontSize = ('1.5rem')
	}else if(over.innerText.length > 40){
		over.style.fontSize = ('1rem')
	}else{
		over.style.fontSize = ('2rem')
	}

	console.log('numero')

}

// if (over.innerText.length >= 20 && over.innerText.length < 39){
// 	over.style.fontSize = ('1.5rem')
// }else if(over.innerText.length > 40){
// 	over.style.fontSize = ('1rem')
// }else{
// 	over.style.fontSize = ('2rem')
// }

// const getFontSize = (textLength) => {
// 	const baseSize = 2.5
// 	if (textLength >= baseSize) {
// 	  textLength = baseSize - 2
// 	}
// 	const fontSize = baseSize - textLength
// 	return `${fontSize}vw`
//   }
  
//   const boxes = document.querySelectorAll('.cardSm h1')
	
//   boxes.forEach(box => {
// 	box.style.fontSize = getFontSize(box.textContent.length)
//   })

// ;