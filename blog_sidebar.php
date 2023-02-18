<div class="col-lg-4 col-md-5">
    <div class="blog__sidebar">
        <div class="blog__sidebar__search">
            <form action="blog.php" method="get">
                <input type="text" placeholder="Recherchez directement ici..." name="recherche_barre_blog" id="recherche_blog">
            </form>
        </div>
        <div class="blog__sidebar__item">
            <h4>Catégories</h4>
            <ul>
                <li><a href="#">Toutes</a></li>
                <?php $all = $DB->query('SELECT * FROM cathegories');
                    foreach($all as $a): ?>
                <li><a ><?=$a->libelle?></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="blog__sidebar__item">
            <h4>Recent News</h4>
            <div class="blog__sidebar__recent">
                <a href="#" class="blog__sidebar__recent__item">
                    <div class="blog__sidebar__recent__item__pic">
                        <img src="ogani-master/img/blog/sidebar/sr-1.jpg" alt="">
                    </div>
                    <div class="blog__sidebar__recent__item__text">
                        <h6>09 Kinds Of Vegetables<br /> Protect The Liver</h6>
                        <span>MAR 05, 2019</span>
                    </div>
                </a>
            </div>
        </div>
        <div class="blog__sidebar__item">
            <h4>Search By</h4>
            <div class="blog__sidebar__item__tags">
                <a href="#">Apple</a>
                <a href="#">Beauty</a>
                <a href="#">Vegetables</a>
                <a href="#">Fruit</a>
                <a href="#">Healthy Food</a>
                <a href="#">Lifestyle</a>
            </div>
        </div>
    </div>
</div>