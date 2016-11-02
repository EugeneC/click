<?php

namespace CoreDomain\Click\Specification;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UniqueClickSpecification
 */
abstract class AbstractUniqueClick
{
    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $ua;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $ip;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $ref;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $param1;

    /**
     * @return string
     */
    public function getUa()
    {
        return $this->ua;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getParam1()
    {
        return $this->param1;
    }
}