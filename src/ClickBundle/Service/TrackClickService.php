<?php

namespace ClickBundle\Service;

use ClickBundle\DTO\ClickDTO;
use ClickBundle\Event\ClickEvent;
use ClickBundle\Event\ClickEvents;
use ClickBundle\Factory\ClickDTOFactory;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class TrackClickService
 */
class TrackClickService
{
    /**
     * @var ClickDTOFactory
     */
    private $clickDTOFactory;

    /**
     * @var EventDispatcherInterface
     */
    private $eventDispatcher;

    /**
     * @param ClickDTOFactory          $clickDTOFactory
     * @param EventDispatcherInterface $eventDispatcher
     */
    public function __construct(ClickDTOFactory $clickDTOFactory, EventDispatcherInterface $eventDispatcher)
    {
        $this->clickDTOFactory = $clickDTOFactory;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * Track click
     *
     * @param string $ua
     * @param string $ip
     * @param string $ref
     * @param string $param1
     * @param string $param2
     *
     * @return ClickDTO
     */
    public function trackClick($ua, $ip, $ref, $param1, $param2)
    {
        $clickDTO = $this->clickDTOFactory->create($ua, $ip, $ref, $param1, $param2);
        if (!$clickDTO->isNew() || $clickDTO->isBadDomain()) {
            $this->eventDispatcher->addListener(
                'kernel.terminate',
                function () use ($clickDTO) {
                    $this->eventDispatcher->dispatch(ClickEvents::INCREASE_ERROR_COUNT, new ClickEvent($clickDTO->getClick()));
                }
            );
        }
        if ($clickDTO->isBadDomain()) {
            $this->eventDispatcher->addListener(
                'kernel.terminate',
                function () use ($clickDTO) {
                    $this->eventDispatcher->dispatch(ClickEvents::BAD_DOMAIN, new ClickEvent($clickDTO->getClick()));
                }
            );
        }

        return $clickDTO;
    }
}