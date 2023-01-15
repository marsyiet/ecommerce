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

    remove(){
        local.removeItem("panier");
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
            total += produit.quantity * produit.prix;
        }
        return total;
    }
}
