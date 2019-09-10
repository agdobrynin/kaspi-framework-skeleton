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
    <p>&nbsp;</p>
<?php } ?>