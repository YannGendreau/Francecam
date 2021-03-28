//Limit character Title card

var list = document.getElementsByClassName('tableau');
var i;


for (i = 0; i < list.length; i++) {
	
	var over = document.getElementById("over");

	if (over.innerText.length >= 20){
		over.style.fontSize = ('1.5rem')
	}else if(over.innerText.length > 40){
		over.style.fontSize = ('1rem')
	}else{
		over.style.fontSize = ('2rem')
	}

}