<?php

namespace Acme\DemoBundle\Service;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("acme.service.test")
 */
class TestService
{
    private $em;
    private $session;

    /**
     * @DI\InjectParams({
     *     "em" = @DI\Inject("doctrine.orm.entity_manager"),
     *     "session" = @DI\Inject("session")
     * })
     */
    public function __construct($em, $session)
    {
        $this->em = $em;
        $this->session = $session;
    }
}
