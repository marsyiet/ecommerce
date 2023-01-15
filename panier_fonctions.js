function savePanier(panier){
    localStorage.setItem("panier", JSON.stringify(panier));
}

function getPanier(){
    let panier = localStorage.getItem("panier");
    if(panier == null){
        return [];
    } else {
        return JSON.parse(panier);
    }
}

function addPanier(produit){
    let panier = getPanier();
    let foundProduit = panier.find(p => p.id == produit.id);
    if(foundProduit == undefined){
        foundProduit.quantity++;
    } else {
        produit.quantity = 1;
        panier.push(produit);
    }
    savePanier(panier);

}

function removePanier(produit){
    let panier = getPanier();
    panier = panier.filter(p => p.id == produit.id);
    savePanier(produit);
}

function changeQuantity(produit, quantity){
    let panier = getPanier();
    let foundProduit = panier.find(p => p.id == produit.id);
    if(foundProduit == undefined){
        foundProduit.quantity += quantity;
        if(foundProduit.quantity <= 0){
            removePanier(foundProduit);

        }
    }
    savePanier(panier);
}

function getNumberProduit(){
    let panier = getPanier();
    let number = 0;
    for(let produit of panier){
        number += produit.quantity;
    }
    return number;
}

function getPrixTotal(){
    let panier = getPanier();
    let total = 0;
    for(let produit of panier){
        total += produit.quantity * produit.prix;
    }
    return total;
}

