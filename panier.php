<?php require 'header.php'; ?>
    <!-- Header Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="ogani-master/img/breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Panier de courses</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Accueil</a>
                            <span>Accueil >> menu >> vers le panier</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Articles</th>
                                    <th>Prix</th>
                                    <th>Quantite</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="data-output">
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__btns">
                        <a href="javascript:history.back()" class="primary-btn cart-btn">CONTINUER MES COURSES</a>
                        <a href="javascript:refresh()" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                            METTRE A JOUR LE PANIER</a>
                        <button style="border: none;" class="primary-btn cart-btn" id="vider">vider le panier</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Codes</h5>
                            <form action="#">
                                <input type="text" placeholder="Enter le code du coupon">
                                <button type="submit" class="site-btn">APPLIQUER LE COUPON</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Total du panier</h5>
                        <ul>
                            <li>Sous-total <span class="sommetotale"> </span></li>
                            <li>Total <span>...</span></li>
                        </ul>
                        <a href="commande.php" class="primary-btn">PAIEMENT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

    <!-- Footer Section Begin -->
    <?php require 'footer.php'; ?>