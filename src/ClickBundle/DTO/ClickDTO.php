<?php

namespace ClickBundle\DTO;

use CoreDomain\Click\Model\Click;

/**
 * Class ClickDTO
 */
class ClickDTO
{
    /**
     * @var boolean
     */
    protected $new;

    /**
     * @var boolean
     */
    protected $badDomain;

    /**
     * @var Click
     */
    protected $click;

    /**
     * ClickDTO constructor.
     * @param Click   $click
     * @param boolean $new
     * @param boolean $badDomain
     */
    public function __construct(Click $click, $new, $badDomain)
    {
        $this->click = $click;
        $this->new = $new;
        $this->badDomain = $badDomain;
    }

    /**
     * @return boolean
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * @return boolean
     */
    public function isBadDomain()
    {
        return $this->badDomain;
    }

    /**
     * @return Click
     */
    public function getClick()
    {
        return $this->click;
    }
}