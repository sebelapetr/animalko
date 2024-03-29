<?php

namespace Eshopblank\FrontModule\Presenters;

use Eshopblank\FrontModule\Forms\IFindFormFactory;
use Eshopblank\FrontModule\Forms\INewsletterFormFactory;
use Nette\Application\UI\Presenter;
use Eshopblank\Model\Orm;

abstract class BasePresenter extends Presenter{

    /** @var Orm  */
    protected $orm;

    /**
     * @var INewsletterFormFactory @inject
     */
    public $newsletterFormFactory;

    /**
     * @var IFindFormFactory @inject
     */
    public $findFormFactory;

    public function __construct(Orm $orm)
    {
        parent::__construct();
        $this->orm = $orm;
    }

    public function handleLogOut(){
        $this->getPresenter()->getUser()->logout();
        $this->flashMessage("Logout success");
        $this->getPresenter()->redirect(":Front:UvodniStrana:default");
    }

    public function beforeRender()
    {
        parent::beforeRender(); // TODO: Change the autogenerated stub
        $this->template->veterinaryParents = $this->getVeterinaryParents();
        $this->template->breedingParents = $this->getBreedingParents();
    }

    public function getVeterinaryParents(){
        return $this->orm->categoryParents->findBy(['parent'=>1])->orderBy('priority', 'asc');
    }

    public function getBreedingParents(){
        return $this->orm->categoryParents->findBy(['parent'=>2])->orderBy('priority', 'asc');
    }


    protected function createComponentNewsletterForm(){
        return $this->newsletterFormFactory->create();
    }

    protected function createComponentFindForm(){
        return $this->findFormFactory->create();
    }
}