<?php

namespace Eshopblank\FrontModule\Presenters;

use Nette\Application\UI\Presenter;
use Eshopblank\Model\Orm;

abstract class BasePresenter extends Presenter{

    /** @var Orm  */
    protected $orm;

    public function __construct(Orm $orm)
    {
        parent::__construct();
        $this->orm = $orm;
    }

    public function handleLogOut(){
        $this->getPresenter()->getUser()->logout();
        $this->flashMessage("Logout success");
        $this->getPresenter()->redirect(":Front:Homepage:default");
    }
}