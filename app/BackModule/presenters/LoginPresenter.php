<?php

namespace Eshopblank\BackModule\Presenters;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Eshopblank\BackModule\Forms\ILoginFormFactory;
use Eshopblank\Model\Orm;

class LoginPresenter extends BasePresenter{

    /**
     * @var ILoginFormFactory
     */
    public $loginFormFactory;

    public function __construct(Orm $orm, ILoginFormFactory $loginFormFactory)
    {
        parent::__construct($orm);
        $this->loginFormFactory = $loginFormFactory;
    }

    public function renderDefault(){
        $this->getTemplate()->setFile(__DIR__  .  "/../templates/Login/default.latte");
    }

    protected function createComponentLoginForm(){
        return $this->loginFormFactory->create();
    }

}
