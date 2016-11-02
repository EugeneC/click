<?php

namespace CoreDomain\Click\Repository;

use CoreDomain\Base\Repository\AbstractRepository;
use CoreDomain\Click\Model\Click;
use CoreDomain\Click\Specification\UniqueClickSpecification;

/**
 * Class ClickRepository
 */
class ClickRepository extends AbstractRepository
{
    /**
     * @param UniqueClickSpecification $specification
     * 
     * @return null|Click
     */
    public function getBySpecification(UniqueClickSpecification $specification)
    {
        return $this->findOneBy(
            [
                'uniqueClick.ua' => $specification->getUa(),
                'uniqueClick.ip' => $specification->getIp(),
                'uniqueClick.ref' => $specification->getRef(),
                'uniqueClick.param1' => $specification->getParam1()
            ]
        );
    }

    /**
     * Increase error count
     *
     * @param Click $click
     *
     * @return mixed
     */
    public function increaseErrorCount(Click $click)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->update(null, 'c')
            ->set('c.error', $click->getError() + 1)
            ->where('c.id = :click')
            ->setParameter('click', $click);

        return $queryBuilder->getQuery()->execute();
    }

    /**
     * Set bad domain flag
     *
     * @param Click $click
     *
     * @return mixed
     */
    public function setBadDomain(Click $click)
    {
        $queryBuilder = $this->createQueryBuilder('c')
            ->update(null, 'c')
            ->set('c.badDomain', 1)
            ->where('c.id = :click')
            ->setParameter('click', $click);

        return $queryBuilder->getQuery()->execute();
    }
}