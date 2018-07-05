<footer class="section hero is-light">
    <div class="container">
        <div class="content has-text-centered">
            <div class="tabs">
                <ul>
                    <li><a href="/">Главная</a></li>
                    <?php foreach(getAllCategories() as $category):?>
                        <li><a href="/category/<?= $category['id'];?>"><?= $category['title'];?></a></li>
                    <?php endforeach;?>
                </ul>
            </div>
            <p class="is-size-7">
                All rights reserved. 2018
            </p>
        </div>
    </div>
</footer>
