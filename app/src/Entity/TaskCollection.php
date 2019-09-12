<?php

namespace App\Entity;

use Kaspi\Exception\Core\AppException;
use Kaspi\Orm\Collection;
use Kaspi\Orm\OrmException;
use Kaspi\Orm\Query\Limit;
use Kaspi\Orm\Query\Order;

class TaskCollection
{
    protected $pageSize;
    /** @var Collection */
    protected $TaskCollection;

    public function __construct(int $page, int $pageSize, ?string $orderColumn = null, ?string $orderType = null)
    {
        $this->pageSize = $pageSize;
        $orderType = strtoupper($orderType) === Order::ASC ? Order::ASC : Order::DESC;
        $this->TaskCollection = new Collection(new TaskForCollection());
        $this->TaskCollection->limit(new Limit($page, $this->pageSize));
        if ($orderColumn && $orderType) {
            $this->TaskCollection->order((new Order())->add($orderColumn, $orderType));
        }
        $this->TaskCollection->prepare();
    }

    public function collection(): Collection
    {
        return $this->TaskCollection;
    }

    public function pageTotal(): int
    {
        try {
            return ceil($this->TaskCollection->count() / $this->pageSize);
        } catch (OrmException $exception) {
            throw new AppException($exception->getMessage());
        }
    }
}
