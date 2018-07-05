<div class="container">
    <nav class="navbar is-transparent">
        <div class="navbar-brand">
            <a class="navbar-item" href="/">
                <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
            </a>
            <div class="navbar-burger burger" data-target="navbarExampleTransparentExample">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
        <div id="navbarExampleTransparentExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/">
                    Главная
                </a>
                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link" href="#">
                        Категории
                    </a>
                    <div class="navbar-dropdown is-boxed">
                        <?php foreach(getAllCategories() as $category):?>
                            <a class="navbar-item" href="/category/<?= $category['id'];?>">
                                <?= $category['title'];?>
                            </a>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</div>