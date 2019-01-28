<?php

namespace Eshopblank\BackModule\Presenters;

use Eshopblank\BackModule\Forms\IOrdersFormFactory;
use Eshopblank\BackModule\Forms\IQuotesFormFactory;
use Eshopblank\Model\Orm;
use Tracy\Debugger;

class OrderPresenter extends BasePresenter{

    /** @var IOrdersFormFactory */
    public  $ordersFormFactory;

    /** @var int */
    public $quoteId;

    public function __construct(Orm $orm, IOrdersFormFactory $ordersFormFactory)
    {
        parent::__construct($orm);
        $this->ordersFormFactory = $ordersFormFactory;
    }

    public function renderDefault()
    {
        $this->getTemplate()->setFile(__DIR__ . "/../templates/Order/default.latte");
        $this->getTemplate()->orders = $this->orm->orders->findAll()->orderBy('createdAt', 'DESC');
    }

    public function renderDetail($id){
        $this->getTemplate()->setFile(__DIR__ . "/../templates/Order/detail.latte");
        $this->getTemplate()->order = $this->orm->orders->getById($id);
    }

    public function createComponentOrdersForm()
    {
        return $this->ordersFormFactory->create();
    }

    public function handleChangeState($id){
        $order = $this->orm->orders->getById($id);
        $order->state++;
        $order->createdAt = $order->createdAt;
        $this->orm->persistAndFlush($order);
    }

}