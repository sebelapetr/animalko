<?php

namespace Eshopblank\Model;

use Nextras\Orm\Collection\ICollection;
use Nextras\Orm\Repository\Repository;

/**
 * Class NewsletterRepository
 * @package Eshopblank\Model
 *
 */

class NewslettersRepository extends Repository{

    /**
     * Returns possible entity class names for current repository.
     * @return string[]
     */
    public static function getEntityClassNames(): array
    {
        return [Newsletter::class];
    }
}