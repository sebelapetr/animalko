<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\Model\Orm;
use Tracy\Debugger;

class CategoryPresenter extends BasePresenter{

    /** @var int */
    public $limit;

    /** @var array  */
    public $pages = [];

    /** @var int */
    public $pagesNumber;

    /** @var  int */
    public $productsNumber;

    /** @var array */
    public $categories = [];

    /** @var array  */
    public $products = [];

    /** @var int */
    public $currentCategoryId;

    /** @var array */
    public $productCategories = [];

    public function __construct(Orm $orm)
    {
        parent::__construct($orm);
    }

    public function renderDefault($id, $page=1)
    {
        $this->currentCategoryId = $id;
        $this->limit = 8;
        $offset = $page>0?($page-1)*$this->limit:$page;
        $this->getTemplate()->setFile(__DIR__ . "/../templates/Category/default.latte");
        $this->getTemplate()->categories = $this->getCategoryParents($this->currentCategoryId);
        $this->getTemplate()->categorie = $this->getCategory($this->currentCategoryId);
        $this->productCategories = $this->getProducts($this->currentCategoryId);
        $this->getTemplate()->products = $this->orm->products->findBy(['category'=>$this->productCategories])->limitBy($this->limit,$offset);
        $this->getTemplate()->pages = $this->getPages();
        $this->getTemplate()->actualPage = $page;
        $this->getTemplate()->pagesNumber = $this->pagesNumber;
        $this->getTemplate()->productsNumber = $this->orm->products->findBy(["category"=>$this->currentCategoryId])->countStored();
    }

    public function getPages(){
        $count = $this->orm->products->findBy(['category'=>$this->productCategories])->countStored();
        $this->pagesNumber = ceil($count/$this->limit);
        for ($i = 1; $i<=$this->pagesNumber; $i++){
            $this->pages[] = $i;
        }
        return $this->pages;
    }

    public function getProducts($id){
        if($id == $this->currentCategoryId) {
            $this->categories[] = $id;
        }
        $isCategoryParent = $this->orm->categoryParents->findBy(["parent"=>$id])->countStored();
        if ($isCategoryParent>0){
            $category = $this->getCategoryParents($id);
            foreach ($category as $categorie){
                $this->categories[] = $categorie->category->id;
                $this->getProducts($categorie->category->id);
            }

        }
        return $this->categories;
    }

    public function getCategory($id){
        return $this->orm->categories->getById($id);
    }

    public function getCategoryParents($id){
        return $this->orm->categoryParents->findBy(["parent"=>$id]);
    }
}