<?php

namespace CoreDomain\Click\Specification;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class UniqueClickSpecification
 */
class UniqueClickSpecification extends AbstractUniqueClick
{
    /**
     * UniqueClickSpecification constructor.
     * 
     * @param string      $ua
     * @param string      $ip
     * @param string|null $ref
     * @param string|null $param1
     */
    public function __construct($ua, $ip, $ref, $param1)
    {
        $this->ua     = $ua;
        $this->ip     = $ip;
        $this->ref    = $ref;
        $this->param1 = $param1;
    }
}