<?php
/** @var $this \Kaspi\View */
$this->layout('layouts/empty');
?>
<div class="columns is-vcentered">
    <div class="column is-4" style="font-size: 10rem;">404</div>
    <div class="column">
        <h1 class="title">Страница не найдена</h1>
        <h1 class="subtitle">Запрашиваемая страница &laquo;<?php echo $this->getExt('URI') ?>&raquo; не найдена</h1>
        <p>Проверьте адрес запрашиваемой страницы и попробкйте еще раз.</p>
    </div>
</div>
<?php if (!empty($trace)) { ?>
    <pre><code class="language-html"><?php echo $trace ?></code></pre>
<?php } ?>
