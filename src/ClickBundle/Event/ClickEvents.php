<?php

namespace ClickBundle\Event;

/**
 * Class ClickEvents
 */
final class ClickEvents
{
    /**
     * Fires when error count must be increased
     */
    const INCREASE_ERROR_COUNT = 'click.increase.error.count';

    /**
     * Fires when referrer has been found in bad domains list
     */
    const BAD_DOMAIN = 'click.bad.domain';
}