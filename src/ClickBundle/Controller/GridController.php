<?php

namespace ClickBundle\Controller;

use APY\DataGridBundle\Grid\Source\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class GridController
 */
class GridController extends Controller
{
    /**
     * @return Response
     */
    public function clicksAction()
    {
        $source = new Entity('CoreClick:Model\Click');
        $grid = $this->get('grid');
        $grid->setSource($source);

        return $grid->getGridResponse('ClickBundle:Grid:clicks.html.twig');
    }
}
