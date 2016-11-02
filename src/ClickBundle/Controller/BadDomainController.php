<?php

namespace ClickBundle\Controller;

use ClickBundle\Form\Type\BadDomainType;
use CoreDomain\BadDomain\Model\BadDomain;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class BadDomainController
 */
class BadDomainController extends Controller
{
    /**
     * Add bad domain
     *
     * @param Request $request
     *
     * @return Response
     */
    public function addAction(Request $request)
    {
        $form = $this->createForm(BadDomainType::class, new BadDomain());
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $badDomain = $form->getData();
            $this->get('repository.bad.domain')->save($badDomain);

            return $this->redirectToRoute('bad.domain.all');
        }

        return $this->render('ClickBundle:BadDomain:add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * Get all bad domains
     *
     * @return Response
     */
    public function allAction()
    {
        $badDomains = $this->get('repository.bad.domain')->findAll();

        return $this->render('ClickBundle:BadDomain:all.html.twig', ['badDomains' => $badDomains]);
    }
}
