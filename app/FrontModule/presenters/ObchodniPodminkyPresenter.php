<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\Model\Orm;
use Tracy\Debugger;

class ObchodniPodminkyPresenter extends BasePresenter{

    public function __construct(Orm $orm)
    {
        parent::__construct($orm);
    }

    public function renderDefault(){

    }
}

