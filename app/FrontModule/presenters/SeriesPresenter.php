<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\Model\Orm;

class SeriesPresenter extends BasePresenter{

    public function __construct(Orm $orm)
    {
        parent::__construct($orm);
    }

    public function renderDefault($serieId)
    {
        $this->getTemplate()->series = $this->orm->series->getById($serieId);
    }
}