<?php

namespace ClickBundle\Factory;

use CoreDomain\Click\Specification\UniqueClickSpecification;

/**
 * Class UniqueClickFactory
 */
class UniqueClickFactory
{
    /**
     * Create click uniqueness
     *
     * @param string      $ua
     * @param string      $ip
     * @param string|null $ref
     * @param string|null $param1
     *
     * @return UniqueClickSpecification
     */
    public function create($ua, $ip, $ref, $param1)
    {
        return new UniqueClickSpecification($ua, $ip, $ref, $param1);
    }
}