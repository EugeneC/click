<?php

namespace ClickBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use CoreDomain\Click\Model\Click;

/**
 * Class ClickEvent
 */
class ClickEvent extends Event
{
    /**
     * @var Click
     */
    private $click;

    /**
     * ClickEvent constructor
     *
     * @param Click $click
     */
    public function __construct(Click $click)
    {
        $this->click = $click;
    }

    /**
     * @return Click
     */
    public function getClick()
    {
        return $this->click;
    }
}