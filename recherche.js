// fonction de filtre dynamique

function filterData(letters, elements){
    for(let i = 0; i < elements.length; i++){
        if(elements[i].textContent.toLowerCase().includes(letters)){
            elements[i].style.display = 'block';
        } else {
            elements[i].style.display = 'none';
        }
    }
}  

// barre de recherche site
var barre = document.querySelector('#barre');

barre.addEventListener('input', (e) => {
    console.log(e.target.value);
    const searchedLetters = e.target.value;
    const results = document.querySelectorAll('.resultats');
    filterData(searchedLetters, results)
})


//barre de recherche blog
var recherche_blog = document.querySelector('#recherche_blog');

recherche_blog.addEventListener('input', (e) => {
    console.log(e.target.value);
    const searchedLetters = e.target.value;
    const results = document.querySelectorAll('.resultat_blog');
    filterData(searchedLetters, results)
})

// la grille

var minamount = document.querySelector('#minamount')
var maxamount = document.querySelector('#maxamount')

//function de la grille
function grille(elements, element) {
    var elements = document.querySelectorAll('.grille_' + elements)

    for(var i = 0; i < elements.length; i++) {
        elements[i].addEventListener('change', (e)=>{
            const items = document.querySelectorAll('.product__item');
            const elemetnInput = document.querySelectorAll('.'+ element +e.target.value)
            for(let item of items){ 
                item.style.display = 'none';
            } 
            for(let inp of elemetnInput){
                inp.parentElement.parentElement.style.display = 'block';   
            }
        })
    }
}

// cathegories
grille('cathegories', 'cathegorie')

// les couleurs
grille('couleurs', 'couleur');

// taille 
grille('tailles', 'taille');

// prix
const bar = document.querySelector('.price-range');

bar.addEventListener('click', (e) => {
    var prices = document.querySelectorAll('.prix')
    for(let price of prices) {
        if(price.value >= minamount.value && price.value <= maxamount.value) {
            price.parentElement.parentElement.style.display = 'block';
        }else{
            price.parentElement.parentElement.style.display = 'none';
        }
    }
})

minamount.addEventListener('input', function(){
    var prices = document.querySelectorAll('.prix')
    for(let price of prices) {
        if(price.value >= minamount.value && price.value <= maxamount.value) {
            price.parentElement.parentElement.style.display = 'block';
        }else{
            price.parentElement.parentElement.style.display = 'none';
        }
    }
})

maxamount.addEventListener('input', function(){
    var prices = document.querySelectorAll('.prix')
    for(let price of prices) {
        if(price.value >= minamount.value && price.value <= maxamount.value) {
            price.parentElement.parentElement.style.display = 'block';
        }else{
            price.parentElement.parentElement.style.display = 'none';
        }
    }
})



