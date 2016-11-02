<?php

namespace ClickBundle\Factory;

use ClickBundle\DTO\ClickDTO;
use CoreDomain\BadDomain\Repository\BadDomainRepository;
use CoreDomain\Click\Model\Click;
use CoreDomain\Click\Repository\ClickRepository;

/**
 * Class ClickDTOFactory
 */
class ClickDTOFactory
{
    /**
     * @var ClickRepository
     */
    private $clickRepository;

    /**
     * @var BadDomainRepository
     */
    private $badDomainRepository;

    /**
     * @var ClickFactory
     */
    private $clickFactory;

    /**
     * @var UniqueClickFactory
     */
    private $uniqueClickFactory;

    /**
     * @param ClickRepository     $clickRepository
     * @param BadDomainRepository $badDomainRepository
     */
    public function __construct(ClickRepository $clickRepository, BadDomainRepository $badDomainRepository)
    {
        $this->clickRepository     = $clickRepository;
        $this->badDomainRepository = $badDomainRepository;
        $this->badDomainRepository = $badDomainRepository;
        $this->uniqueClickFactory  = new UniqueClickFactory();
        $this->clickFactory        = new ClickFactory();
        $this->clickFactory->setRepository($clickRepository);
    }

    /**
     * Create click
     *
     * @param string      $ua
     * @param string      $ip
     * @param string|null $ref
     * @param string|null $param1
     * @param string|null $param2
     *
     * @return ClickDTO
     */
    public function create($ua, $ip, $ref, $param1, $param2)
    {
        $uniqueClick = $this->uniqueClickFactory->create($ua, $ip, $ref, $param1);
        $click       = $this->clickRepository->getBySpecification($uniqueClick);
        $new         = false;
        if (!$click) {
            $click = $this->clickFactory->create($uniqueClick, $param2);
            $new   = true;
        }
        $badDomain = $this->checkDomain($click);

        return new ClickDTO($click, $new, $badDomain);
    }

    /**
     * @param Click $click
     *
     * @return boolean
     */
    protected function checkDomain(Click $click)
    {
        $badDomain = $this->badDomainRepository->findOneBy(['name' => $click->getUniqueClick()->getRef()]);

        return null !== $badDomain;
    }
}