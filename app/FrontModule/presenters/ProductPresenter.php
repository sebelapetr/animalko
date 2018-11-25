<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\Model\Orm;
use Tracy\Debugger;
use Eshopblank\FrontModule\Forms\NewQuoteForm;
use Eshopblank\FrontModule\Forms\INewQuoteFormFactory;

class ProductPresenter extends BasePresenter{

    /** @var array */
    public $categories = [];

    /** @var int */
    public $currentCategoryId;

    /**
     * @var INewQuoteFormFactory
     */
    public $newQuoteFormFactory;

    public function __construct(Orm $orm, INewQuoteFormFactory $newQuoteFormFactory)
    {
        parent::__construct($orm);
        $this->newQuoteFormFactory = $newQuoteFormFactory;
    }

    public function renderDefault($id)
    {
        $this->currentCategoryId = $id;
        $this->getTemplate()->products = $this->orm->products->getById($id);
        $this->getTemplate()->categories = $this->orm->categories->getById($id);
        //Debugger::barDump($this->getCategories($this->getCategory($id)));
    }

    public function getCategories($id){
        if($id == $this->currentCategoryId) {
            $this->categories[] = $id;
        }
        $isCategoryParent = $this->orm->categoryParents->findBy(["parent"=>$id])->countStored();
        if ($isCategoryParent<0){
            Debugger::barDump('a');
            $category = $this->getCategoryParents($id);
            foreach ($category as $categorie){
                $this->categories[] = $categorie->category->id;
                $this->getCategories($categorie->category->id);
            }

        }
        return $this->categories;
    }

    public function getCategory($id){
        $product = $this->orm->products->getById($id);
        return $product->category->id;
    }

    public function getCategoryParents($id){
        return $this->orm->categoryParents->findBy(["category"=>$id]);
    }

    public function createComponentNewQuoteForm(){
        return $this->newQuoteFormFactory->create($this->currentCategoryId);
    }
}