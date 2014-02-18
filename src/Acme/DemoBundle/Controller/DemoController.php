<?php

namespace Acme\DemoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Form\ContactType;

// these import the "@Route" and "@Template" annotations
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DemoController extends Controller
{
    /**
     * @Route("/", name="_demo")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/test", name="_test")
     * @Template()
     */
    public function testAction()
    {
        $os = $this->get('acme.service.other');

        ld($os, $os->test(), $os->test2(), $os->test3(), $os->test4());

        return array();
    }

    /**
     * @Route("/trans-test", name="_trans_test")
     * @Template()
     */
    public function transAction()
    {
        $em = $this->get('doctrine')->getManager();
        $repo = $em->getRepository('Entity:Test');
        // $entity = $repo->find(1);
        // $list = $repo->findAll();
        $list = $repo->findAllWithTrans();

        // $entity->setName('name pl');
        // $entity->setTranslatableLocale('pl');
        // $em->persist($entity);
        // $em->flush();

        // $entity->setName('name en');
        // $entity->setTranslatableLocale('en');
        // $em->persist($entity);
        // $em->flush();

        return array(
            // 'entity' => $entity,
            'list'   => $list,
        );
    }

    /**
     * @Route("/hello/{name}", name="_demo_hello")
     * @Template()
     */
    public function helloAction($name)
    {
        return array('name' => $name);
    }

    /**
     * @Route("/contact", name="_demo_contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        $form = $this->createForm(new ContactType());
        $form->handleRequest($request);

        if ($form->isValid()) {
            $mailer = $this->get('mailer');

            // .. setup a message and send it
            // http://symfony.com/doc/current/cookbook/email.html

            $request->getSession()->getFlashBag()->set('notice', 'Message sent!');

            return new RedirectResponse($this->generateUrl('_demo'));
        }

        return array('form' => $form->createView());
    }
}
