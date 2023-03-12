(function($){
    $('.addpanier').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},function(data){  
            if(data.error){
                alert(data.message);
            }else{
                const basket = new panier();  
                basket.add(data);
                $('#countpanier').empty().append(basket.getNumberProduit());
                $('#totalpanier').empty().append(basket.getPrixTotal());
            }
                   
        },'json');
        return false;
    });

    $('.addfavori').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},function(data){  
            if(data.error){
                alert(data.message);
            }else{
                javascript.history.back();
            }
                   
        },'json');
        return false;
    });


})(jQuery);

// -------------- les elements du panier ---------------

let products = localStorage.getItem("panier");
let v = JSON.parse(products);
let placeholder = document.querySelector("#data-output");
let placeholdercom = document.querySelector("#orderlist");
let out = "";
let outs = "";
for(let product of v) {
    out += `
        <tr id="tableau${product.id}" class="article">
                <td class="shoping__cart__item">
                    <img src="images/${product.image}" alt="" width="50px" height="50px">
                    <a  href="detail.php?id=${product.id}&&nom=${product.nom}">
                    <h5>${product.nom}</h5>
                    </a>
                </td>
            <td class="shoping__cart__price">
            ${product.prix}
            </td>
            <td class="shoping__cart__quantity">
                <div class="quantity">
                    <div class="pro-qty">
                        <input type="text" value="${product.quantity}" name="${product.id}">
                    </div>
                </div>
            </td>
            <td class="shoping__cart__total">
                <span id="soustotalproduit${product.id}">${product.soustotalproduit}</span>
            </td>
            <td class="shoping__cart__item__close">
                <span id="${product.id}" class="delpanier"><i class="fa fa-close"></i></span>
            </td>
        </tr>
    `;
    outs += `
        <li>${product.nom}  <span>${product.prix}</span></li>
    `;

}

placeholder.innerHTML = out;
placeholdercom.innerHTML = outs;



// ----------------------------------------------------------------LES MODALS ----------------------------------------------------------------

let modalAlreadyShowed = false

// popup de la page d'acceuil 
let modalAlreadyShowedAccueil = false

window.addEventListener('scroll', function(e) {
  if( ! modalAlreadyShowedAccueil ) {
    setTimeout( () => {
    document.getElementById('modal_accueil').style.display = 'block'
    }, 2000 )
    modalAlreadyShowedAccueil = true
  }
});

document.getElementById('modal-close').addEventListener('click', function(e) {
document.getElementById('modal_accueil').style.display = 'none'
})

var confirmExiting = false


// popup du panier

document.querySelector('#vide').addEventListener('click', function(e) {
    document.getElementById('modal_panier').style.display = 'block'
    modalAlreadyShowed = true
  });

document.getElementById('modal-close').addEventListener('click', function(e) {
document.getElementById('modal_panier').style.display = 'none'
})


// popup connexion

document.getElementById('modal-close').addEventListener('click', function(e) {
document.getElementById('modal_commande').style.display = 'none'
})


window.addEventListener('beforeunload', function (e) {
  if( confirmExiting ) {
    e.preventDefault();
    e.returnValue = '';
  }
});

// popup detail
document.getElementById('heart_icon').addEventListener('click', function(e) {
  document.getElementById('modal_detail').style.display = 'block'
  modalAlreadyShowed = true
});

document.getElementById('modal-close').addEventListener('click', function(e) {
document.getElementById('modal_detail').style.display = 'none'
})



