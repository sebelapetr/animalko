<?php

namespace App\CronModule\Presenters;

use Eshopblank\FrontModule\Forms\INewsletterFormFactory;
use Nette\Application\UI\Presenter;
use Eshopblank\Model\Orm;

class BasePresenter extends Presenter{

    /** @var Orm  */
    protected $orm;

    public function __construct(Orm $orm)
    {
        parent::__construct();
        $this->orm = $orm;
    }
}