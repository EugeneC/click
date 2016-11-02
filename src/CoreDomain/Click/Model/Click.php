<?php

namespace CoreDomain\Click\Model;

use APY\DataGridBundle\Grid\Mapping as GRID;
use CoreDomain\Click\Specification\AbstractUniqueClick;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Click
 *
 * @ORM\Entity(repositoryClass="CoreDomain\Click\Repository\ClickRepository")
 * @ORM\Table(name="click")
 *
 * @GRID\Source(columns="id, ua, ip, ref, param1, param2, error, badDomain")
 */
class Click extends AbstractUniqueClick
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
     * @param AbstractUniqueClick $uniqueClick
     * @param string              $param2
     */
    public function __construct(AbstractUniqueClick $uniqueClick, $param2)
    {
        $this->ua     = $uniqueClick->getUa();
        $this->ip     = $uniqueClick->getIp();
        $this->ref    = $uniqueClick->getRef();
        $this->param1 = $uniqueClick->getParam1();
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