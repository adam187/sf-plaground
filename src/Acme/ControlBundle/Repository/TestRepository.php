<?php

namespace Acme\ControlBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TestRepository extends EntityRepository
{
    public function findAllWithTrans()
    {
        $query = $this->getEntityManager()->createQuery('SELECT t FROM Entity:Test t ');

        $query->setHint(
            \Doctrine\ORM\Query::HINT_CUSTOM_OUTPUT_WALKER,
            'Gedmo\\Translatable\\Query\\TreeWalker\\TranslationWalker'
        );

        // ld($query);

        return $query->getResult();
    }
}
