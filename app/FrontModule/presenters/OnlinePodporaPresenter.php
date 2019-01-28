<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\FrontModule\Forms\INewQuoteFormFactory;
use Eshopblank\Model\Orm;

Class OnlinePodporaPresenter extends BasePresenter{
    public function __construct(Orm $orm)
    {
        parent::__construct($orm);
    }

    public function renderDefault(){
        $this->getTemplate()->setFile(__DIR__ . "/../templates/OnlinePodpora/default.latte");
    }
}