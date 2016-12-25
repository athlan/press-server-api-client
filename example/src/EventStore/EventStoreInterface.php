<?php

namespace Example\EventStore;

use Example\EventStore\Exception\EventAlreadyInStoreException;

interface EventStoreInterface {

    /**
     * @param Event $e
     * @return boolean
     *
     * @throws EventAlreadyInStoreException
     */
    function store(Event $e);

    /**
     * @return Event[]
     */
    function getEvents();

    /**
     * @param mixed $eventId
     * @return Event[]
     */
    function getEventsFrom($eventId);
}
