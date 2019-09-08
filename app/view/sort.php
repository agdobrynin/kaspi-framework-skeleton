<?php
$sortDesc = strtolower(Kaspi\Orm\Query\Order::DESC);
$sortAsc = strtolower(Kaspi\Orm\Query\Order::ASC);
// sortOrder=asc&sortField=userName
$isUseAsc = [$sortFilter['sortField'], $sortFilter['sortOrder']] === [$sortField, $sortAsc];
$isUseDesc = [$sortFilter['sortField'], $sortFilter['sortOrder']] === [$sortField, $sortDesc];
?>
<a href="?sortField=<?php echo $sortField?>&sortOrder=<?php echo $sortAsc?>"><span class="icon"><i class="fas fa-arrow-down <?php echo $isUseAsc?'has-text-success':''?>"></i></span></a>
<a href="?sortField=<?php echo $sortField?>&sortOrder=<?php echo $sortDesc?>"><span class="icon"><i class="fas fa-arrow-up <?php echo $isUseDesc?'has-text-success':''?>"></i></span></a>