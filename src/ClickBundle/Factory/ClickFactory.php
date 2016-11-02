<?php

namespace ClickBundle\Factory;

use CoreDomain\Click\Model\Click;
use CoreDomain\Click\Repository\ClickRepository;
use CoreDomain\Click\Specification\AbstractUniqueClick;

/**
 * Class ClickFactory
 */
class ClickFactory
{
    /**
     * @var ClickRepository
     */
    private $clickRepository;

    /**
     * @param ClickRepository $clickRepository
     */
    public function setRepository(ClickRepository $clickRepository)
    {
        $this->clickRepository = $clickRepository;
    }

    /**
     * Create new click
     *
     * @param AbstractUniqueClick $uniqueClick
     * @param string              $param2
     *
     * @return Click
     */
    public function create(AbstractUniqueClick $uniqueClick, $param2)
    {
        $click = new Click($uniqueClick, $param2);
        $this->clickRepository->save($click);

        return $click;
    }
}