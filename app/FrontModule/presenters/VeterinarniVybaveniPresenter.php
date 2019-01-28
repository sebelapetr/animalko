<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\FrontModule\Forms\IAddProductFormFactory;
use Eshopblank\FrontModule\Forms\INewQuoteFormFactory;
use Eshopblank\Model\Orm;
use Nette\Utils\DateTime;
use Nette\Utils\Paginator;
use Tracy\Debugger;
use LikeFilterFunction;

class VeterinarniVybaveniPresenter extends BasePresenter{

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

    /** @var int */
    public $currentCategoryId;

    /** @var array */
    public $productCategories = [];

    /** @var array */
    public $parentCategories = [];

    /** @var int */
    public $lastPage;

    /** @var int */
    public $currentProductId;

    /**
     * @var INewQuoteFormFactory
     */
    public $newQuoteFormFactory;

    /**
     * @var IAddProductFormFactory  */
    public $addProductFormFactory;

    public function __construct(Orm $orm, INewQuoteFormFactory $newQuoteFormFactory, IAddProductFormFactory $addProductFormFactory)
    {
        parent::__construct($orm);
        $this->newQuoteFormFactory = $newQuoteFormFactory;
        $this->addProductFormFactory = $addProductFormFactory;
    }

    public function renderDefault($id=1, $page=1, $orderBy = null, $direction = null){
        /* -NASTAVENÍ PROMĚNNÝCH- */
        $this->currentCategoryId = $id; /* -AKTUÁLNÍ KATEGORIE- */
        $this->limit = 15; /* -LIMIT PRODUKTŮ- */
        $offset = $page>0?($page-1)*$this->limit:$page; /* -OFFSET PRODUKTŮ- */
        /* ---------------------- */

        $this->getTemplate()->actualId = $this->currentCategoryId; /* -PŘEDÁNÍ ID AKTUÁLNÍ KATEGORIE DO TEMPLATY- */


        $this->getTemplate()->setFile(__DIR__ . "/../templates/VeterinarniVybaveni/kategorie.latte");

        $this->getCategoryPath($this->currentCategoryId); /* -SETNUTÍ NÁZVŮ KATEGORIÍ CESTY KD AKTUÁLNÍ KATEGORIE- */

        $this->getTemplate()->category = $this->getCategory($this->currentCategoryId); /* -AKTUÁLNÍ KATEGORIE- */

        $this->getTemplate()->categories = $this->getCategoryParents($this->currentCategoryId); /* -PODKATEGORIE AKTUÁLNÍ KATEGORIE (JEDNA ÚROVĚŇ POD)- */

        $this->getTemplate()->parentCategories = $this->orm->categoryParents->findBy(['parent'=>1, 'visible'=>1])->orderBy('priority', 'ASC'); /* -VŠECHNY RODIČOVSKÉ KATEGORIE VE VET. VYBAVENÍ- */

        $this->getProducts($this->currentCategoryId);
        /* -SETNUTÍ ID AKTUALNÍ KATEGORIE+VŠECH PODKATEGORIÍ AKTUÁLNÍ KATETGORIE PRO ZÍSKÁNÍ PRODUKTŮ Z DB (VRACÍ $this->categories)- */

        //$products = $this->orm->products->findBy(['category'=>$this->categories]);
        $this->getTemplate()->productsCount = 10155;//count($products);
        $products = $this->orm->products->findBy(['category'=>$this->categories])->limitBy($this->limit,$offset);//$products->limitBy($this->limit,$offset);
        if ($orderBy){
            $products = $products->orderBy($orderBy, $direction);
        }
        /* -ZÍSKÁNÍ PRODUKTŮ V KATEGORIÍCH Z $this->categories ($this->getProducts($this->currentId))- */

        $this->getTemplate()->products = $products; /* -VŠECHNY PRODUKTY VE VŠECH PODKATEGORIÍCH POD AKTUÁLNÍ KAT. + AKTUÁLNÍ KAT.- */

        $this->lastPage = ceil($this->orm->products->findBy(['category'=>$this->categories])->countStored()/$this->limit); /* -- */

        $this->getTemplate()->lastPage = $this->lastPage;
        $this->getTemplate()->orderBy = $orderBy;
        $this->getTemplate()->direction = $direction;
        $this->getTemplate()->pages = $this->getPages($page);
        $this->getTemplate()->actualPage = $page;
        $this->getTemplate()->pagesNumber = $this->pagesNumber;
        $this->getTemplate()->categoryPath = array_reverse($this->parentCategories, true);
        $this->getTemplate()->productInCart = $this->productInCart($id);
        $this->getTemplate()->session = $this->getSession()->getSection('products');
    }

    public function renderKategorie($id, $page=1, $orderBy = null, $direction = null)
    {
        /* -NASTAVENÍ PROMĚNNÝCH- */
        $this->currentCategoryId = $id; /* -AKTUÁLNÍ KATEGORIE- */
        $this->limit = 15; /* -LIMIT PRODUKTŮ- */
        $offset = $page>0?($page-1)*$this->limit:$page; /* -OFFSET PRODUKTŮ- */
        /* ---------------------- */

        $this->getTemplate()->actualId = $this->currentCategoryId; /* -PŘEDÁNÍ ID AKTUÁLNÍ KATEGORIE DO TEMPLATY- */


        $this->getTemplate()->setFile(__DIR__ . "/../templates/VeterinarniVybaveni/kategorie.latte");

        $this->getCategoryPath($this->currentCategoryId); /* -SETNUTÍ NÁZVŮ KATEGORIÍ CESTY KD AKTUÁLNÍ KATEGORIE- */

        $this->getTemplate()->category = $this->getCategory($this->currentCategoryId); /* -AKTUÁLNÍ KATEGORIE- */

        $this->getTemplate()->categories = $this->getCategoryParents($this->currentCategoryId); /* -PODKATEGORIE AKTUÁLNÍ KATEGORIE (JEDNA ÚROVĚŇ POD)- */

        $this->getTemplate()->parentCategories = $this->orm->categoryParents->findBy(['parent'=>1, 'visible'=>1])->orderBy('priority', 'ASC'); /* -VŠECHNY RODIČOVSKÉ KATEGORIE VE VET. VYBAVENÍ- */

        $this->getProducts($this->currentCategoryId);
        /* -SETNUTÍ ID AKTUALNÍ KATEGORIE+VŠECH PODKATEGORIÍ AKTUÁLNÍ KATETGORIE PRO ZÍSKÁNÍ PRODUKTŮ Z DB (VRACÍ $this->categories)- */

        $products = $this->orm->products->findBy(['category'=>$this->categories]);
        $this->getTemplate()->productsCount = count($products);
        $products = $products->limitBy($this->limit,$offset);
        if ($orderBy){
            $products = $products->orderBy($orderBy, $direction);
        }
        /* -ZÍSKÁNÍ PRODUKTŮ V KATEGORIÍCH Z $this->categories ($this->getProducts($this->currentId))- */

        $this->getTemplate()->products = $products; /* -VŠECHNY PRODUKTY VE VŠECH PODKATEGORIÍCH POD AKTUÁLNÍ KAT. + AKTUÁLNÍ KAT.- */

        $this->lastPage = ceil($this->orm->products->findBy(['category'=>$this->categories])->countStored()/$this->limit); /* -- */

        $this->getTemplate()->lastPage = $this->lastPage;
        $this->getTemplate()->orderBy = $orderBy;
        $this->getTemplate()->direction = $direction;
        $this->getTemplate()->pages = $this->getPages($page);
        $this->getTemplate()->actualPage = $page;
        $this->getTemplate()->pagesNumber = $this->pagesNumber;
        $this->getTemplate()->categoryPath = array_reverse($this->parentCategories, true);
        $this->getTemplate()->productInCart = $this->productInCart($id);
        $this->getTemplate()->session = $this->getSession()->getSection('products');
    }

    public function renderProdukt($id)
    {
        $this->currentProductId = $id;
        $product = $this->orm->products->getById($id);

        $currentTime = new DateTime();
        $deliveryTime = DateTime::from($currentTime);
        if ($deliveryTime->format("N") == 5) {
            $days = 5;
        } elseif ($deliveryTime->format("N") == 6) {
            $days = 4;
        } elseif ($deliveryTime->format("N") == 7) {
            $days = 3;
        }
        else {
            $days = 3;
        }
        $deliveryTime->modify('+'.$days.' days');
        $this->getTemplate()->product = $product;
        $this->getTemplate()->relatedProducts = $this->orm->products->findBy(['category'=>$product->category])->limitBy(4,0);
        $this->getTemplate()->categories = $this->orm->categories->getById($id);
        $this->getTemplate()->deliveryDate = $deliveryTime;
        $this->getTemplate()->productInCart = $this->productInCart($id);
        $this->getTemplate()->actualId = $id;
        $this->getTemplate()->den = $this->cesky_den(1);
        $this->getCategoryPath($product->category); /* -SETNUTÍ NÁZVŮ KATEGORIÍ CESTY KD AKTUÁLNÍ KATEGORIE- */
        $this->getTemplate()->categoryPath = array_reverse($this->parentCategories, true);
        $this->getTemplate()->session = $this->getSession()->getSection('products');
    }

    function cesky_den($den) {
        static $nazvy = array('neděle', 'pondělí', 'úterý', 'středa', 'čtvrtek', 'pátek', 'sobota');
        return $nazvy[$den];
    }

    public function handleAddProductToCart($id, $currentCategory){
        $product = $this->orm->products->getById($id);
        //$array = ['id'=>$id, 'productName'=>$product->productName,'catalogPriceVat'=>$product->catalogPriceVat,'quantity'=>1, 'photo'=>$product->image];
        $productsSession = $this->getSession()->getSection('products');
        $productsSession->$id = array();
        $productsSession->$id['id'] = $id;
        $productsSession->$id['productName'] = $product->productName;
        $productsSession->$id['catalogPriceVat'] = $product->catalogPriceVat;
        $productsSession->$id['quantity'] = 1;
        $productsSession->$id['photo'] = $product->image;
        $this->flashMessage('Produkt byl přidán do košíku');
        $this->redirect('kategorie', $currentCategory);
    }

    public function handleAddProductToCartFromProduct($id, $currentProduct){
        $product = $this->orm->products->getById($id);
        //$array = ['id'=>$id, 'productName'=>$product->productName,'catalogPriceVat'=>$product->catalogPriceVat,'quantity'=>1, 'photo'=>$product->image];
        $productsSession = $this->getSession()->getSection('products');
        $productsSession->$id = array();
        $productsSession->$id['id'] = $id;
        $productsSession->$id['productName'] = $product->productName;
        $productsSession->$id['catalogPriceVat'] = $product->catalogPriceVat;
        $productsSession->$id['quantity'] = 1;
        $productsSession->$id['photo'] = $product->image;
        $this->redirect('produkt', $currentProduct);
    }

    public function getPages($actualPage){

        $count = $this->orm->products->findBy(['category'=>$this->categories])->countStored();
        $paginator = new Paginator();
        $paginator->setItemCount($count);
        $paginator->setItemsPerPage($this->limit);
        $paginator->setPage($actualPage);

        if(ceil($count/$this->limit)>5) {
            if($paginator->isLast()) $actualPage--;
            $rozdil = 4 - $actualPage;
            $actualPage <= 5 ? $actualPage = $actualPage + $rozdil + 1 : '';
            for ($i = ($actualPage - 4); $i <= ($actualPage + 1); $i++) {
                $this->pages[] = $i;
            }
        }
        else{
            for ($i = ($actualPage-($actualPage-1)); $i <= (ceil($count/$this->limit)); $i++) {
                $this->pages[] = $i;
            }
        }
        return $this->pages;
    }

    public function getProducts($id){
        if($id == $this->currentCategoryId) {
            $this->categories[] = intval($id);
        }
        $isCategoryParent = $this->orm->categoryParents->findBy(["parent"=>$id])->countStored();
        if ($isCategoryParent>0){
            $category = $this->getCategoryParents($id);
            foreach ($category as $categorie){
                $this->categories[] = $categorie->category->id;
                $this->getProducts($categorie->category->id);
            }

        }
        //return ($this->categories);
    }

    public function getCategory($id){
        return $this->orm->categories->getById($id);
    }

    public function getCategoryParents($id){
        return $this->orm->categoryParents->findBy(["parent"=>$id, "visible"=>1])->orderBy('priority', 'ASC');
    }

    public function getCategoryPath($id){
        $category = $this->orm->categoryParents->getBy(['category'=>$id]);
        if($category) {
            if ($category->parent !== null) {
                $this->parentCategories[$category->category->id] = $category->category->categorySingleName;
                $this->getCategoryPath($category->parent->id);
            } else {
                $this->parentCategories[$category->category->id] = $category->category->categorySingleName;
            }
        }
    }

    public function productInCart($id){
        $sessionProduct = $this->getSession()->getSection('products');
        if($sessionProduct->$id)
        {
            return true;
        }
        else{
            return false;
        }
    }

    protected function createComponentNewQuoteForm(){
        return $this->newQuoteFormFactory->create($this->currentProductId);
    }

    protected function createComponentAddProductForm(){
        return $this->addProductFormFactory->create($this->currentProductId);
    }
}