<?php
/** @var \Kaspi\View $this */
$pageTitle = 'Просмотр задачи';
$formAction = $this->getExt('pathFor', 'task.add');
$this->layout('layouts/main', compact('pageTitle'));
/** @var App\Entity\Task $Task */
?>
<div class="card">
    <header class="card-header">
        <p class="card-header-title is-one-fifth">
            <abbr title="<?php echo (int)$Task->completed ? 'Задача завершена' : 'Задача в работе' ?>">
                <span class="icon"><i class="fas fa-flag <?php echo (int)$Task->completed ? 'has-text-success' : 'has-text-warning' ?>"></i></span>
            </abbr>
            <abbr title="<?php echo (int)$Task->editByAdmin ? 'Изменена администратором' : 'Создана пользователем' ?>">
                <span class="icon"><i class="fas <?php echo (int)$Task->editByAdmin ? 'fa-user-shield has-text-info' : 'fa-user has-text-success' ?>"></i></span>
            </abbr>
        </p>
        <p class="card-header-title">Задача № <?php echo $Task->id ?></p>
    </header>
    <header class="card-header">
        <p class="card-header-title"><span class="icon"><i class="fas fa-address-card"></i></span><?php echo $Task->userName ?></p>
        <p class="card-header-title"><span class="icon"><i class="fas fa-envelope"></i></span><?php echo $Task->email ?>
        </p>
    </header>
    <div class="card-content">
        <div class="content">
            <?php echo nl2br($Task->content) ?>
        </div>
    </div>
    <?php if(\App\Auth::isAuth()){?>
    <footer class="card-footer">
        <a href="<?php echo $this->getExt('pathFor', 'task.edit', ['id' => $Task->id]) ?>" class="card-footer-item">Изменить</a>
    </footer>
    <?php }?>
</div>