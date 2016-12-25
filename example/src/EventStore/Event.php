<?php

namespace Example\EventStore;

class Event {

    private $eventId;
    private $event;

    function __construct($eventId, $event) {
        $this->eventId = $eventId;
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getEventId() {
        return $this->eventId;
    }

    /**
     * @return mixed
     */
    public function getEvent() {
        return $this->event;
    }
}
