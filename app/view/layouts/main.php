<?php /** @var $this \Kaspi\View*/?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle ?? 'Hello world'?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <link rel="stylesheet" href="/assests/css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<div class="container">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
               data-target="navbarMain">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarMain" class="navbar-menu">
            <div class="navbar-start">

                <a class="navbar-item" href="<?php echo isRouteName('main') ? '#' : $this->getExt('pathFor', 'main'); ?>">
                <span class="icon"><i class="fas fa-home"></i></span>&nbsp;Home
                </a>
                <a class="navbar-item" href="<?php echo isRouteName('task.add') ? '#' : $this->getExt('pathFor', 'task.add'); ?>">
                    <span class="icon"><i class="fas fa-plus"></i></span>&nbsp;Добавить задачу
                </a>
                <a class="navbar-item"  href="<?php echo isRouteName('fake.delete') ? '#' : ($this->getExt('pathFor', 'fake.delete') ?? '#'); ?>">
                    <span class="icon"><i class="fas fa-trash"></i></span>&nbsp;Удалить тестовые данные
                </a>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <?php if (!App\Auth::isAuth()) {?>
                            <a class="button is-warning" href="<?php echo $this->getExt('pathFor', 'login')?>">
                                <span class="icon"><i class="fas fa-lock"></i></span>
                                <span>Вход</span>
                            </a>
                        <?php } else {?>
                            <a class="button is-link" href="<?php echo $this->getExt('pathFor', 'logout')?>">
                                <span class="icon"><i class="fas fa-lock-open"></i></span>
                                <span>Выход</span>
                            </a>
                        <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
<div class="bd-main-container container">
    <?php $this->include('globalComponents/flashes.php')?>

    <section class="section">
        <div class="container">
            <?php $this->section()?>
        </div>
    </section>
</div>
<footer class="footer">
    <div class="content has-text-centered">
        <p>
            <strong>Kaspi-Framework</strong> by <a href="https://kaspi.ru">Kaspi-Soft</a>. The source code is licensed
            <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
            is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC BY NC SA 4.0</a>.
        </p>
    </div>
</footer>
<script src="/assests/js/app.js"></script>
</body>
</html>
