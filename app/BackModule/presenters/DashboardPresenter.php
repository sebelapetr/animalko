<?php

namespace Eshopblank\BackModule\Presenters;

class DashboardPresenter extends BasePresenter{

    public function renderDefault(){
        if ($this->getPresenter()->getUser()->isLoggedIn()){
            $this->getTemplate()->setFile(__DIR__ . "/../templates/Dashboard/default.latte");
            $this->getTemplate()->productsNumber = $this->orm->products->findAll()->countStored();
            $this->getTemplate()->categoriesNumber = $this->orm->categories->findAll()->countStored();
            $this->getTemplate()->quotesNumber = $this->orm->quotes->findAll()->countStored();
        }
        else{
            $this->getTemplate()->setFile(__DIR__ . "/../templates/Dashboard/loggedOut.latte");
        }
    }
}