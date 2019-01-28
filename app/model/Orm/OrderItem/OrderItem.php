<?php

namespace Eshopblank\Model;

use Nette\Utils\DateTime;
use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;

/**
 * Class OrdersItem
 * @package Eshopblank\Model
 * @property int $id {primary}
 * @property int $type
 * @property string $name
 * @property int $price
 * @property int $priceVat
 * @property int $quantity
 * @property int $vat
 * @property DateTimeImmutable|NULL $createdAt
 * @property int|NULL $categoryType
 * @property Product|NULL $product {m:1 Product::$orderItem}
 * @property Order|NULL $order {m:1 Order::$ordersItems}

 */
Class OrdersItem extends Entity{

}