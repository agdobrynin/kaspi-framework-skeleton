<?php
use Kaspi\FlashMessages as FM;
$flashFormValidator = FM::displayAsObjects(FM::FROM_VALIDATOR);
$pageTitle= 'Задачи в списке';
$this->layout('layouts/main', compact(['pageTitle', 'flashFormValidator']));
