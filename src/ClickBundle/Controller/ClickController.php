<?php

namespace ClickBundle\Controller;

use CoreDomain\Click\Model\Click;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ClickController
 *
 */
class ClickController extends Controller
{
    /**
     * Track click
     *
     * @param Request $request
     *
     * @return Response
     */
    public function trackAction(Request $request)
    {
        $clickDTO = $this->get('service.click.tracking')->trackClick(
            $request->headers->get('User-Agent'),
            $request->getClientIp(),
            $request->headers->get('referer'),
            $request->get('param1'),
            $request->get('param2')
        );
        $pageRouteName = 'click.track.error';
        if ($clickDTO->isNew()) {
            $pageRouteName = 'click.track.success';
        }

        return $this->redirectToRoute($pageRouteName, ['click' => $clickDTO->getClick()->getId(), 'isBadDomain' => $clickDTO->isBadDomain()]);
    }

    /**
     * Show error page
     *
     * @param Click $click
     *
     * @return Response
     */
    public function errorAction(Click $click)
    {
        return $this->render('ClickBundle:Click:error.html.twig', ['click' => $click]);
    }

    /**
     * Show success page
     *
     * @param Click $click
     *
     * @return Response
     */
    public function successAction(Click $click)
    {
        return $this->render('ClickBundle:Click:success.html.twig', ['click' => $click]);
    }
}
