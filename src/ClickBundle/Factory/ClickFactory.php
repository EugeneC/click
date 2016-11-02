<?php

namespace ClickBundle\Factory;

use CoreDomain\Click\Model\Click;
use CoreDomain\Click\Repository\ClickRepository;
use CoreDomain\Click\Specification\UniqueClickSpecification;

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
     * @param UniqueClickSpecification $specification
     * @param string                   $param2
     *
     * @return Click
     */
    public function create(UniqueClickSpecification $specification, $param2)
    {
        $click = new Click($specification, $param2);
        $this->clickRepository->save($click);

        return $click;
    }
}