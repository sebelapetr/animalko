<?php

namespace Eshopblank\Model;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * Class OrdersRepository
 * @package Eshopblank\Model
 *
 */

class OrdersRepository extends Repository{

    /**
     * Returns possible entity class names for current repository.
     * @return string[]
     */
    public static function getEntityClassNames(): array
    {
        return [Order::class];
    }
}