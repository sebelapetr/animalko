<?php

namespace Eshopblank\Model;

use Nextras\Orm\Mapper\Mapper;

class ProductsMapper extends Mapper{

    public function findCategoriesNew(){
        $builder = $this->connection->query(
            "SELECT * FROM `products` WHERE `new` = '1'"
        );
        return $builder;
    }
}