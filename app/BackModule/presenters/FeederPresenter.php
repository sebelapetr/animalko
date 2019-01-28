<?php

namespace Eshopblank\BackModule\Presenters;

use Eshopblank\BackModule\Model\FeederService;
use Eshopblank\Model\CategoryService;
use Eshopblank\Model\Orm;

Class FeederPresenter extends BasePresenter{

    /** @var FeederService */
    public $feederService;

    public function __construct(Orm $orm, FeederService $feederService)
    {
        parent::__construct($orm);
        $this->feederService = $feederService;
    }

    public function renderDefault()
    {
        $this->getTemplate()->setFile(__DIR__ . "/../templates/Feeder/default.latte");
    }

    public function renderOneHour()
    {
        $this->feederService->feedStock();
    }

    public function renderOneDay()
    {
        $this->feederService->feedOneHourCategories();
        $this->feederService->feedOneHourProducts();
        $this->feederService->feedOneHourProductsCategories();
    }

    public function renderOneWeek()
    {

    }

    public function renderInit(){
        set_time_limit(1800);
        /*
        echo "start<br>";
        $this->feederService->initCats();
        echo "categories done<br>";
        *///$this->feederService->feedOneHourProducts();/*
        //echo "products done<br>";
        $this->feederService->initImagesAndDescription();
        //echo "images done<br>";
    }
}