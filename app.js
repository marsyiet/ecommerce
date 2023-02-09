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


})(jQuery);

/*(function($){
    $('.delpanier').click(function(event){
        event.preventDefault();
        $.get($(this).attr('href'),{},function(data){  
            if(data.error){
                alert(data.message);
            }else{
                const basket = new panier();  
                basket.remove(data);
            }
                   
        },'json');
        return false;
    });

})(jQuery);*/


let products = localStorage.getItem("panier");
let v = JSON.parse(products);
let placeholder = document.querySelector("#data-output");
let out = "";
for(let product of v) {
    out += `
        <tr id="tableau${product.id}" class="article">
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

}

placeholder.innerHTML = out;








