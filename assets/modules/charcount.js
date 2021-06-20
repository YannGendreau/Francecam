const max = 500;
const i = document.getElementById("film_synopsis");
const c = document.getElementById("count");
if(i){

c.innerHTML = max - i.value.length;



   i.addEventListener("keydown",count);

function count(e){
    var len =  i.value.length;
    if (len >= max){
       c.innerHTML = "Vous avez atteint la limite"
      //  e.preventDefault();
    } else{
       c.innerHTML = max - len-1;   
    }
}
}    
