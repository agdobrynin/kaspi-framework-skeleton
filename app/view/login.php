<?php
/** @var \Kaspi\View $this */
$pageTitle = 'Авторзация';
$this->layout('layouts/main', compact('pageTitle'));

$loginPath = $this->getExtension('pathFor')('login');
?>
<form class="form-horizontal" method="post" action="<?php echo $loginPath?>">
    <input type="hidden" name="referer" value="<?php echo $referer ?? ''; ?>">
    <?php echo $xCsrf; ?>
    <div class="field">
        <label class="label">Логин</label>
        <div class="control has-icons-left">
            <input type="text" class="input" required name="login">
            <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
        </div>
    </div>
    <div class="field">
        <label class="label">Логин</label>
        <div class="control has-icons-left">
            <input type="password" class="input" required name="password">
            <span class="icon is-small is-left"><i class="fas fa-key"></i></span>
        </div>
    </div>
    <div class="control">
        <input type="submit" class="button is-link" value="Авторизация">
    </div>
</form>
