<?php

namespace Eshopblank\FrontModule\Forms;

use Eshopblank\Model\QuoteService;
use Nette\Application\UI\Control;
use Nette\Application\UI\Form;
use Nette\Security\AuthenticationException;
use Tracy\Debugger;

interface INewQuoteFormFactory{
    /** @return NewQuoteForm */
    function create($id);
}

class NewQuoteForm extends Control{

    /** @var QuoteService */
    public $quoteService;

    /** @var int  */
    private $productId;

    public function __construct(QuoteService $quoteService, $id)
    {
        $this->quoteService = $quoteService;
        $this->productId = $id;
    }

    protected function createComponentNewQuoteForm(){
        $form = new Form();
        $form->addHidden("product", $this->productId);
        $form->addText("name")
            ->setRequired();
        $form->addEmail("email")
            ->setRequired();
        $form->addText("city");
        $form->addText("zip");
        $form->addTextArea('text');
        $form->addSubmit("submit");
        $form->onSuccess[] = [$this, 'newQuoteFormSucceeded'];
        return $form;
    }
    public function newQuoteFormSucceeded(Form $form, $values){

        $this->quoteService->newQuote($values);
        $this->getPresenter()->flashMessage("Poptávka byla zadána do systému");

        //$this->getPresenter()->redirect("Homepage:default");
    }
    public function render(){
        $this->getTemplate()->setFile(__DIR__  .  "/../../forms/NewQuote/NewQuote.latte");
        $this->getTemplate()->render();
    }

}