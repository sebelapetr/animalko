<?php

namespace Eshopblank\Model;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * Class ProductsRepository
 * @package Eshopblank\Model
 *
 * @method ICollection|Product[] findCategoriesNew()
 */

class ProductsRepository extends Repository{

    /**
     * Returns possible entity class names for current repository.
     * @return string[]
     */
    public static function getEntityClassNames(): array
    {
        return [Product::class];
    }
}