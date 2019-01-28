<?php

namespace Eshopblank\Model;

use Nextras\Orm\Entity\Entity;

/**
 * Class Product
 * @package Eshopblank\Model
 * @property int $id {primary}
 * @property string|NULL $productName
 * @property string|NULL $brandName
 * @property int|NULL $vendorInternalId
 * @property string|NULL $vendorName
 * @property string|NULL $ean
 * @property int|NULL $catalogPrice
 * @property int|NULL $catalogPriceVat
 * @property int|NULL $clientPrice
 * @property int|NULL $clientPriceVat
 * @property int|NULL $retailPrice
 * @property int|NULL $vat
 * @property bool|NULL $inStock
 * @property int|NULL $minStockLevel
 * @property int|NULL $stockLevel
 * @property string|NULL $image
 * @property string|NULL $description
 * @property int|NULL $weight
 * @property bool|NULL $recept
 * @property int|NULL $active
 * @property string|NULL $sukl
 * @property string|NULL $pdkId
 * @property string|NULL $url
 * @property string|NULL $priceList
 * @property string|NULL $restrictions
 * @property string|NULL $tooOrder
 * @property Category|NULL $category {m:1 Category::$product}
 * @property Quote|NULL $quote {1:m Quote::$product}
 * @property OrdersItem|NULL $orderItem {1:m OrdersItem::$product}
 * @property int|NULL $saled
 */
class Product extends Entity{

    public function productInCart($id, $sessionProduct){
        if($sessionProduct->$id)
        {
            return true;
        }
        else{
            return false;
        }
    }
}