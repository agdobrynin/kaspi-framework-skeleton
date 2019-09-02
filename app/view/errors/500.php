<?php
/** @var $this \Kaspi\View */
$this->layout('layouts/empty');
?>

<div class="columns is-vcentered">
    <div class="column is-4 has-text-centered" style="font-size: 10rem;"><?php echo $code ?: 500?></div>
    <div class="column">
        <h1 class="title">Упс! У нас что-то сломалось</h1>
        <h1 class="subtitle"><?php echo $message ?></h1>
        <?php if (!empty($prevMessage)) {?>
            <p class="has-text-grey has-background-light">
                <span class="icon has-text-warning"><i class="fas fa-exclamation-triangle"></i></span>
                <?php echo $prevMessage?>
            </p>
        <?php } ?>
    </div>
</div>
<?php if (!empty($trace)) { ?>
    <pre><code class="language-html"><?php echo $trace ?></code></pre>
<?php } ?>
