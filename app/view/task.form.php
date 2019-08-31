<?php
/** @var \Kaspi\View $this */
$pageTitle = empty($Task->id) ? 'Добавить новую задачу' : 'Редактирование задачи';
$this->layout('layouts/main', compact('pageTitle'));
$formAction = $this->pathFor('task.add');
?>

<form class="form-horizontal" method="post" action="<?php echo $formAction?>">
    <input type="hidden" name="taskId" value="<?php echo $Task->id ?? 0; ?>">
    <?php /*мидлвара app/src/Middleware/CsrfMiddleware.php */
    echo $xCsrf; ?>

    <div class="field">
        <label class="label">Имя</label>
        <div class="control has-icons-left has-icons-right">
            <input type="text" <?php echo !empty($Task->id) ? 'readonly ' : ''; ?>
                   required
                   class="input <?php echo !empty($formValidation->userName) ? 'is-danger' : '' ?>"
                   name="userName"
                   value="<?php echo htmlentities($Task->userName ?? ''); ?>"/>
            <span class="icon is-small is-left"><i class="fas fa-user"></i></span>
            <?php if (!empty($formValidation->userName)) { ?>
                <span class="icon is-small is-right"><i class="fas fa-exclamation-triangle"></i></span>
            <?php }?>
        </div>
        <?php if (!empty($formValidation->userName)) { ?>
            <p class="help is-danger"><?php echo $formValidation->userName ?></p>
        <?php } ?>
    </div>

    <div class="field">
        <label class="label">Email</label>
        <div class="control has-icons-left has-icons-right">
            <input type="email" <?php echo !empty($Task->id) ? 'readonly ' : ''; ?>
                   required
                   class="input <?php echo !empty($formValidation->email) ? 'is-danger' : '' ?>"
                   name="email"
                   value="<?php echo htmlentities($Task->email ?? ''); ?>"/>
            <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
            <?php if (!empty($formValidation->email)) { ?>
                <span class="icon is-small is-right"><i class="fas fa-exclamation-triangle"></i></span>
            <?php }?>
        </div>
        <?php if (!empty($formValidation->email)) { ?>
            <p class="help is-danger"><?php echo $formValidation->email?></p>
        <?php } ?>
    </div>

    <div class="field">
        <label class="label">Задача</label>
        <div class="control has-icons-left has-icons-right">
            <textarea rows="5" name="content" required class="textarea"><?php echo $Task->content ?? ''; ?></textarea>
            <span class="icon is-small is-left"><i class="fas fa-globe"></i></span>
        </div>
    </div>

    <?php if (App\Auth::isAuth() && !empty($Task->id)) { ?>
        <div class="field">
            <div class="control">
                <label class="checkbox" value="1" name="completed"
                    <?php echo $Task->completed ? 'checked' : ''; ?>><input type="checkbox"> Выполено</label>
            </div>
        </div>
    <?php } ?>

    <div class="field is-grouped">
        <div class="control">
            <input type="submit" class="button is-link" value="Сохранить">
        </div>
    </div>
</form>
