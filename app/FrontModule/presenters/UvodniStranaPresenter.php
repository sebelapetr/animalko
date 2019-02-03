<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\FrontModule\Forms\INewQuoteFormFactory;
use Eshopblank\Model\Orm;
use Nette\Caching\Storages\FileStorage;
use ondrs\Hi\Hi;
use Tracy\Debugger;

Class UvodniStranaPresenter extends BasePresenter{
    public function __construct(Orm $orm)
    {
        parent::__construct($orm);
    }

    public function renderDefault(){
        $recommendedItems = [94998,995,28965];
        $topSalesVeterinary = [35999,25367,28965,1862,1845];
        $topSalesBreeding = [17594,46874,69398,93759,25431];
        $this->getTemplate()->setFile(__DIR__ . "/../templates/UvodniStrana/default.latte");
        //$this->getTemplate()->topSalesVeterinary = $this->orm->ordersItems->findBy(['type'=>1, 'categoryType'=>1,'product!=' => null])->orderBy('id', 'DESC')->limitBy(5);
        //$this->getTemplate()->topSalesBreeding = $this->orm->ordersItems->findBy(['type'=>1, 'categoryType'=>2,'product!=' => null])->orderBy('id', 'DESC')->limitBy(5);
        //$this->getTemplate()->recommended = $this->orm->ordersItems->findBy(['type'=>1, 'categoryType'=>2,'product!=' => null])->orderBy('id', 'DESC')->limitBy(3);
        $this->getTemplate()->topSalesVeterinary = $this->orm->products->findBy(['id'=>$topSalesVeterinary]);
        $this->getTemplate()->topSalesBreeding = $this->orm->products->findBy(['id'=>$topSalesBreeding]);
        $this->getTemplate()->recommended = $this->orm->products->findBy(['id'=>$recommendedItems]);
    }
}