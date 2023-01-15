(function($){
    $('.addpanier').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},function(data){  
            if(data.error){
                alert(data.message);
            }else{
                const basket = new panier();  
                basket.add(data);
            }
                   
        },'json');
        return false;
    });

})(jQuery);


let products = localStorage.getItem("panier");
let v = JSON.parse(products);
let placeholder = document.querySelector("#data-output");
let out = "";
for(let product of v) {
    out += `
        <tr>
            <td class="shoping__cart__item">
                <img src="images/${product.image}" alt="" width="50px" height="50px">
                <h5>${product.nom}</h5>
            </td>
            <td class="shoping__cart__price">
            ${product.prix}
            </td>
            <td class="shoping__cart__quantity">
                <div class="quantity">
                    <div class="pro-qty">
                        <input type="text" value="${product.quantity}">
                    </div>
                </div>
            </td>
            <td class="shoping__cart__total">
                <span id="soustotalproduit"></span>
            </td>
            <td class="shoping__cart__item__close">
                <span id=${product.id}" class="delpanier"><i class="fa fa-close"></i></span></a>
            </td>
        </tr>
    `;

}

placeholder.innerHTML = out;


let classes = document.querySelectorAll('.delpanier');

for(let classic of classes) {
    
    classic.addEventListener('click', function(event) {
        event.preventDefault();
        const basket = new panier();
        basket.removeItemFromCart(11);
    })
}

let places = document.querySelectorAll('.totalpanier');

for(let classic of places) {
    const basket = new panier();
    classic.append(basket.getPrixTotal);
}

let countes = document.querySelectorAll('.countpanier');

for(let classic of countes) {
    const basket = new panier();
    classic.append(basket.getNumberProduit);
}