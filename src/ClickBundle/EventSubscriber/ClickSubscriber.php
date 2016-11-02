<?php

namespace ClickBundle\EventSubscriber;

use ClickBundle\Event\ClickEvent;
use ClickBundle\Event\ClickEvents;
use CoreDomain\Click\Repository\ClickRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Class ClickSubscriber
 */
class ClickSubscriber implements EventSubscriberInterface
{
    /**
     * @var ClickRepository
     */
    private $clickRepository;

    /**
     * @param ClickRepository $clickRepository
     */
    public function __construct(ClickRepository $clickRepository)
    {
        $this->clickRepository = $clickRepository;
    }

    /**
     * Get array of subscribed events
     *
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            ClickEvents::INCREASE_ERROR_COUNT => ['increaseErrorCount', 0],
            ClickEvents::BAD_DOMAIN => ['badDomain', 0]
        ];
    }

    /**
     * @param ClickEvent $clickEvent
     */
    public function increaseErrorCount(ClickEvent $clickEvent)
    {
        $this->clickRepository->increaseErrorCount($clickEvent->getClick());
    }

    /**
     * @param ClickEvent $clickEvent
     */
    public function badDomain(ClickEvent $clickEvent)
    {
        $this->clickRepository->setBadDomain($clickEvent->getClick());
    }
}