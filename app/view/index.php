<?php
use Kaspi\FlashMessages as FM;
$flashFormValidator = FM::displayAsObjects(FM::FROM_VALIDATOR);
$pageTitle = 'Задачи в списке';
/** @var \Kaspi\View $this */
$this->layout('layouts/main', compact(['pageTitle', 'flashFormValidator']));
$sort = $sortFilterString ? '?' . $sortFilterString : '';
?>
<?php if ($totalPages) { ?>
    <nav class="pagination" role="navigation" aria-label="pagination">
        <?php if ($page > 1) { ?>
            <a href="<?php echo $this->getExt('pathFor', 'task.page', ['page' => $page - 1]).$sort ?>"
               class="pagination-previous">назад</a>
        <?php } ?>
        <?php if ($page < $totalPages) { ?>
            <a href="<?php echo $this->getExt('pathFor', 'task.page', ['page' => $page + 1]).$sort ?>"
               class="pagination-next">вперед</a>
        <?php } ?>
        <ul class="pagination-list">
            <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                <li><a
                            href="<?php echo $this->getExt('pathFor', 'task.page', ['page' => $i]).$sort ?>"
                            class="pagination-link <?php echo $i === (int)$page ? 'is-current' : '' ?>"><?php echo $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>
<p>&nbsp;</p>
<?php if ($totalPages) { ?>
    <div class="table-container">
        <table class="table  is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr>
                <th><abbr title="Номер задачи">№</abbr></th>
                <th>Пользователь
                    <?php $this->include('sort.php', ['sortFilter' => $sortFilter, 'sortField' => 'userName'])?>
                </th>
                <th>Email
                    <?php $this->include('sort.php', ['sortFilter' => $sortFilter, 'sortField' => 'email'])?>
                </th>
                <th><abbr title="Статус задачи, Изменена администратором">Статус</abbr>
                    <?php $this->include('sort.php', ['sortFilter' => $sortFilter, 'sortField' => 'completed'])?>
                </th>
                <?php if (App\Auth::isAuth()) { ?>
                    <th> </th>
                <?php } ?>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($Tasks as $Task) {
                /** @var App\Entity\Task $Task */
                ?>
                <tr>
                    <td><?php echo $Task->id ?></td>
                    <td>
                        <a href="<?php echo $this->getExt('pathFor', 'task.view', ['id' => $Task->id]) ?>"><?php echo $Task->userName ?></a>
                    </td>
                    <td><?php echo $Task->email ?></td>
                    <td>
                        <abbr title="<?php echo (int)$Task->completed ? 'Задача завершена' : 'Задача в работе'?>">
                            <span class="icon"><i class="fas fa-flag <?php echo (int)$Task->completed?'has-text-success':'has-text-warning'?>"></i></span></abbr>
                        <abbr title="<?php echo (int)$Task->editByAdmin ? 'Изменена администратором' : 'Создана пользователем'?>">
                            <span class="icon"><i class="fas <?php echo (int)$Task->editByAdmin?'fa-user-shield has-text-info':'fa-user has-text-success'?>"></i></span></abbr>
                    </td>
                    <?php if (App\Auth::isAuth()) { ?>
                        <td class="has-text-centered">
                        <a href="<?php echo $this->getExt('pathFor', 'task.edit', ['id' => $Task->id]) ?>" class="button is-small is-link">Изменить</a>
                        </td>
                    <?php } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else {?>
    <article class="message">
        <div class="message-body">
            <p>Для тестового проекта можно сгенерировать тестовые данные в автоматическом режиме.</p>
            <p><a class="button is-success" href="/fake/create">Сгенерировать тестовые данные</a></p>
        </div>
    </article>
<?php } ?>
