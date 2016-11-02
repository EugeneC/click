<?php

namespace CoreDomain\Click\Model;

use CoreDomain\Click\Specification\UniqueClickSpecification;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Click
 *
 * @ORM\Entity(repositoryClass="CoreDomain\Click\Repository\ClickRepository")
 * @ORM\Table(name="click")
 */
class Click
{
    /**
     * @var string
     *
     * @ORM\Column(type="guid")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Embedded(class = "CoreDomain\Click\Specification\UniqueClickSpecification", columnPrefix = false)
     */
    protected $uniqueClick;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $param2;

    /**
     * @var string
     *
     * @ORM\Column(type="integer")
     */
    protected $badDomain = 0;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $error = 0;

    /**
     * Click constructor.
     * 
     * @param UniqueClickSpecification $specification
     * @param string                   $param2
     */
    public function __construct(UniqueClickSpecification $specification, $param2)
    {
        $this->uniqueClick = $specification;
        $this->param2 = $param2;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return UniqueClickSpecification
     */
    public function getUniqueClick()
    {
        return $this->uniqueClick;
    }

    /**
     * @return string
     */
    public function getParam2()
    {
        return $this->param2;
    }

    /**
     * @return integer
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * @return integer
     */
    public function isBadDomain()
    {
        return $this->badDomain;
    }
}