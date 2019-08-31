<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $pageTitle ?? ''?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
    <link rel="stylesheet" href="/assests/css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
</head>
<div class="container">

</div>
<div class="bd-main-container container">
    <section class="section">
        <div class="container">
            <?php $this->section()?>
        </div>
    </section>
</div>
<footer class="footer">
    <div class="content has-text-centered"></div>
</footer>
</body>
</html>
