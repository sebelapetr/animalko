<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\Model\Orm;
use Tracy\Debugger;

class ProduktyPresenter extends BasePresenter{

    /** @var int */
    public $limit;

    /** @var array  */
    public $pages = [];

    /** @var int */
    public $pagesNumber;

    /** @var  int */
    public $productsNumber;

    public function __construct(Orm $orm)
    {
        parent::__construct($orm);
    }

    public function renderDefault($page=1){
        $this->limit = 8;
        $offset = $page>0?($page-1)*$this->limit:$page;
        $this->getTemplate()->setFile(__DIR__ . "/../templates/Produkty/default.latte");
        $this->getTemplate()->categories = $this->orm->categoryParents->findBy(["parent"=>NULL]);
        $this->getTemplate()->products = $this->orm->products->findAll()->limitBy($this->limit,$offset);
        $this->getTemplate()->pages = $this->getPages();
        $this->getTemplate()->actualPage = $page;
        $this->getTemplate()->pagesNumber = $this->pagesNumber;
        $this->getTemplate()->productsNumber = $this->productsNumber;
    }

    public function renderNove($page=1){
        $this->limit = 8;
        $offset = $page>0?($page-1)*$this->limit:$page;
        $this->getTemplate()->setFile(__DIR__ . "/../templates/Produkty/nove.latte");
        $this->getTemplate()->categories = $this->orm->categoryParents->findBy(["parent"=>NULL]);
        $this->getTemplate()->products = $this->orm->products->findBy(['new'=>1])->limitBy($this->limit,$offset);
        $this->getTemplate()->pages = $this->getPagesArgument('new');
        $this->getTemplate()->actualPage = $page;
        $this->getTemplate()->pagesNumber = $this->pagesNumber;
        $this->getTemplate()->productsNumber = $this->productsNumber;
    }

    public function renderRepasovane($page=1){
        $this->limit = 8;
        $offset = $page>0?($page-1)*$this->limit:$page;
        $this->getTemplate()->setFile(__DIR__ . "/../templates/Produkty/repasovane.latte");
        $this->getTemplate()->categories = $this->orm->categoryParents->findBy(["parent"=>NULL]);
        $this->getTemplate()->products = $this->orm->products->findBy(['repaired'=>1])->limitBy($this->limit,$offset);
        $this->getTemplate()->pages = $this->getPagesArgument('repaired');
        $this->getTemplate()->actualPage = $page;
        $this->getTemplate()->pagesNumber = $this->pagesNumber;
        $this->getTemplate()->productsNumber = $this->productsNumber;
    }

    public function renderPrislusenstvi($page=1){
        $this->limit = 8;
        $offset = $page>0?($page-1)*$this->limit:$page;
        $this->getTemplate()->setFile(__DIR__ . "/../templates/Produkty/prislusenstvi.latte");
        $this->getTemplate()->categories = $this->orm->categoryParents->findBy(["parent"=>NULL]);
        $this->getTemplate()->products = $this->orm->products->findBy(['category'=>1])->limitBy($this->limit,$offset);
        $this->getTemplate()->pages = $this->getPagesArgument('category');
        $this->getTemplate()->actualPage = $page;
        $this->getTemplate()->pagesNumber = $this->pagesNumber;
        $this->getTemplate()->productsNumber = $this->productsNumber;
    }

    public function getPages(){
        $this->productsNumber = $this->orm->products->findAll()->countStored();
        $count = $this->productsNumber;
        $this->pagesNumber = ceil($count/$this->limit);
        for ($i = 1; $i<=$this->pagesNumber; $i++){
            $this->pages[] = $i;
        }
        return $this->pages;
    }

    public function getPagesArgument($argument){
        $this->productsNumber = $this->orm->products->findBy([$argument=>1])->countStored();
        $count = $this->productsNumber;
        $this->pagesNumber = ceil($count/$this->limit);
        for ($i = 1; $i<=$this->pagesNumber; $i++){
            $this->pages[] = $i;
        }
        return $this->pages;
    }
}

