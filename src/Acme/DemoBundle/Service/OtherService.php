<?php

namespace Acme\DemoBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.service.other")
 */
class OtherService
{
    /** @var \Doctrine\ORM\EntityManager */
    private $em;
    private $session;

    /**
     * @DI\InjectParams
     */
    public function __construct(EntityManager $em, SessionInterface $session)
    {
        $this->em      = $em;
        $this->session = $session;
    }

    public function test()
    {
        // ld($this->em->getRepository('Entity:Test'));
        return $this->em->getRepository('Entity:Test')->findAll();
    }

    public function test2()
    {
        return $this->em->getRepository('Entity:Test2')->findAll();
    }

    public function test3()
    {
        return $this->em->getRepository('AcmeControlBundle:Test')->findAll();
    }

    public function test4()
    {
        return $this->em->getRepository('AcmeControlBundle:Test2')->findAll();
    }
}
