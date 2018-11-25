<?php

namespace Eshopblank\Model;

/**
 * Class Category
 * @package Eshopblank\Model
 * @property int $id {primary}
 * @property string $name
 * @property string|NULL $description
 * @property int $visible
 * @property Product[] $product {1:m Product::$category}
 * @property CategoryParent[] $category {1:m CategoryParent::$category}
 * @property CategoryParent[]|NULL $parent {1:m CategoryParent::$parent}
 */
use Nextras\Orm\Entity\Entity;

class Category extends Entity{

}