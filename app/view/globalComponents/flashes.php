<?php
use Kaspi\FlashMessages as FM;

$flashErrors = FM::displayAsObjects(FM::ERROR);
$flashSuccess = FM::displayAsObjects(FM::SUCCESS);
$flashWarnings = FM::displayAsObjects(FM::WARNING);
$flashInfo = FM::displayAsObjects(FM::INFO);

if (!empty($flashErrors)) { ?>
    <?php foreach ($flashErrors as $error) { ?>
        <div class="notification is-danger">
            <button class="delete"></button>
            <?php echo $error; ?>
        </div>
    <?php } ?>
<?php } ?>
<?php if (!empty($flashSuccess)) { ?>
    <?php foreach ($flashSuccess as $success) { ?>
        <div class="notification is-success">
            <button class="delete"></button>
            <?php echo $success; ?>
        </div>
    <?php } ?>
<?php } ?>
<?php if (!empty($flashWarnings)) { ?>
    <?php foreach ($flashWarnings as $warning) { ?>
        <div class="notification is-warning">
            <button class="delete"></button>
            <?php echo $warning; ?>
        </div>
    <?php } ?>
<?php } ?>
<?php if (!empty($flashInfo)) { ?>
    <?php foreach ($flashInfo as $info) { ?>
        <div class="notification is-info">
            <button class="delete"></button>
            <?php echo $info; ?>
        </div>
    <?php } ?>
<?php } ?>

