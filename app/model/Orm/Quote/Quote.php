<?php

namespace Eshopblank\Model;

use Nette\Utils\DateTime;
use Nextras\Dbal\Utils\DateTimeImmutable;
use Nextras\Orm\Entity\Entity;

/**
 * Class Quote
 * @package Eshopblank\Model
 * @property int $id {primary}
 * @property string $name
 * @property string $email
 * @property string|NULL $city
 * @property string|NULL $zip
 * @property Product|NULL $product {m:1 Product::$quote}
 * @property DateTimeImmutable|null $createdAt
 * @property int $state {default 0}
 * @property string|NULL $text
 */
Class Quote extends Entity{

}