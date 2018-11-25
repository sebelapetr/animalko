<?php

namespace Eshopblank\Model;

use Nette\Security\Passwords;
use Tracy\Debugger;

class QuoteService
{

    /** @var Orm */
    private $orm;

    public function __construct(Orm $orm)
    {
        $this->orm = $orm;
    }

    public function newQuote($values)
    {
        if (!isset($values->product)) {
            $values->product = null;
        }
        else{
            $product = $this->orm->products->getById($values->product);
        }

        $quote = new Quote();
        $quote->name = $values->name;
        $quote->email = $values->email;
        $quote->city = $values->city;
        $quote->zip = $values->zip;
        $quote->product = $product;
        $quote->text = $values->text;
        $quote->createdAt = date("Y-m-d h:i:sa");
        $this->orm->persist($quote);
        $this->orm->flush();
    }
}