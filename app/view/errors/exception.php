<?php
$pageTitle = !empty($errorTitle) ? $errorTitle : 'Ошибка приложения';
$this->layout('layouts/empty', compact('pageTitle'));
?>
<h1 class="title">
    <?php echo $pageTitle?>
</h1>
<h2 class="subtitle"><?php echo $Message?></h2>
<?php if (!empty($TraceAsString)) {?>
<pre><code><?php print_r($TraceAsString)?></code></pre>
<?php } ?>