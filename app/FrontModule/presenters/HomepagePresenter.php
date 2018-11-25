<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\Model\Orm;
use Tracy\Debugger;

class HomepagePresenter extends BasePresenter{

    public function __construct(Orm $orm)
    {
        parent::__construct($orm);
    }

    public function renderDefault(){
        $this->getPresenter()->redirect("Produkty:default");
    }
}

