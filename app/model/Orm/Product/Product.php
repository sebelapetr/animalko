<?php

namespace Eshopblank\Model;

use Nextras\Orm\Entity\Entity;

/**
 * Class Product
 * @package Eshopblank\Model
 * @property int $id {primary}
 * @property string $name
 * @property int|NULL $normPrice
 * @property int|NULL $price
 * @property string|NULL $manufacturer
 * @property int|NULL $deliveryTime
 * @property int|NULL $weight
 * @property int|NULL $dumbellsWeight
 * @property int|NULL $length
 * @property int|NULL $width
 * @property int|NULL $height
 * @property string $image
 * @property string|NULL $description
 * @property int $visible
 * @property int $new
 * @property int $repaired
 * @property Category|NULL $category {m:1 Category::$product}
 * @property Quote|NULL $quote {1:m Quote::$product}
 */
class Product extends Entity{

}