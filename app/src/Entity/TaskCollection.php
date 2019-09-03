<?php

namespace App\Entity;

use Kaspi\Exception\Core\AppException;
use Kaspi\Orm\Collection;
use Kaspi\Orm\OrmException;
use Kaspi\Orm\Query\Limit;
use Kaspi\Orm\Query\Order;

class TaskCollection
{
    protected $page;
    protected $pageSize;
    protected $orderColumn;
    protected $orderType;
    /** @var Collection */
    protected $TaskCollection;

    public function __construct(int $page, int $pageSize, ?string $orderColumn, ?string $orderType)
    {
        $this->page = $page;
        $this->pageSize = $pageSize;
        $this->orderColumn = $orderColumn;
        $this->orderType = $orderType;
        $this->TaskCollection = new Collection(new Task());
    }

    public function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function page(): array
    {
        try {
            $this->TaskCollection->addLimit(new Limit($this->page, $this->pageSize));
            if ($this->orderColumn && $this->orderType) {
                $this->TaskCollection->addOrder((new Order())->add($this->orderColumn, $this->orderType));
            }

            return $this->TaskCollection->getCollection();
        } catch (OrmException $exception) {
            throw new AppException($exception->getMessage());
        }
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
