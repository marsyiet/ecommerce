class panier{
    constructor(){
        let panier = localStorage.getItem("panier");
        if(panier == null){
            this.panier = [];
        } else {
            this.panier = JSON.parse(panier);
        } 
    }

    save(){
        localStorage.setItem("panier", JSON.stringify(this.panier));
    }

    add(produit){
        let foundProduit = this.panier.find(p => p.id == produit.id);
        if(!(foundProduit == undefined)){
            foundProduit.quantity ++;
        } else {
            produit.quantity = 1;
            this.panier.push(produit);
        }
        this.save();
    
    }

    remove(produit){
        this.panier = this.panier.filter(p => p.id == produit.id);
        this.save();
    }

    removeItemFromCart(produitId){
        let temp = this.panier.filter(item => item.id != produitId);
        localStorage.setItem("panier", JSON.stringify(temp));
    }

    vider(){
        localStorage.removeItem("panier");
    }

    changeQuantity(produit, quantity){
        let foundProduit = this.panier.find(p => p.id == produit.id);
        if(!foundProduit == undefined){
            foundProduit.quantity += quantity;
            if(foundProduit.quantity <= 0){
                remove(foundProduit);
    
            }
        }
        save();
    }

    change(produitId, qty){
        let foundProduit = this.panier.find(p => p.id == produitId);
        if(foundProduit == undefined){
            alert('ajouteq d abord nor');
        }
        foundProduit.quantity = qty;
        this.save();
    }

    addQuantity(produitId){
        let foundProduit = this.panier.find(p => p.id == produitId);
        foundProduit.quantity + 1;
    }

    reduceQuantity(produitId){
        let foundProduit = this.panier.find(p => p.id == produitId);
        if(foundProduit.quantity <= 0){
            remove(foundProduit);
        }
        else{
            foundProduit.quantity - 1;
        }
    }
    
    getNumberProduit(){
        let number = 0;
        for(let produit of this.panier){
            number += produit.quantity;
        }
        return number;
    }

    getPrixTotal(){
        let total = 0;
        for(let produit of this.panier){
            total += produit.quantity * parseFloat(produit.prix);
        }
        return total;
    }

    getTotalArticle(produitId){
        let foundProduit = this.panier.find(p => p.id == produitId);
        foundProduit.soustotalproduit = foundProduit.quantity * parseFloat(foundProduit.prix);
        this.save();
        return foundProduit.soustotalproduit;
    }

}

document.querySelector('#countpanier').append(new panier().getNumberProduit());
document.querySelector('#totalpanier').append(new panier().getPrixTotal());
document.querySelector('.sommetotale').append(new panier().getPrixTotal());
document.querySelector('#subtotalorder').append(new panier().getPrixTotal());

/*document.querySelector('#vider').addEventListener('click', function(){
    new panier().vider();
    window.location.reload();
})
*/
