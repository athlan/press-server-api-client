<?php

namespace Example\EventStore;

use Example\EventStore\Exception\EventAlreadyInStoreException;

class SimpleFilesystemEventStore implements EventStoreInterface {

    private $path;

    function __construct($path) {
        $this->path = $path;
    }

    /**
     * @inheritdoc
     */
    function store(Event $e) {
        $eventId = $e->getEventId();

        // write in oplog
        $fhOplog = null;

        try {
            $fhOplog = fopen($this->path . '/oplog.log', 'a+');

            // check if operation already exists
            while (($buffer = fgets($fhOplog)) !== false) {
                if (strpos($buffer, $eventId) !== false) {
                    throw new EventAlreadyInStoreException(sprintf("Event id already occurred: %s", $eventId));
                }
            }

            fwrite($fhOplog, $eventId . PHP_EOL);
        }
        finally {
            if($fhOplog) {
                fclose($fhOplog);
            }
        }

        // store event content
        $fhOp = null;
        try {
            $fhOp = fopen($this->path . '/ops/' . $eventId . '.log', 'w+');
            fwrite($fhOp, serialize($e->getEvent()));
        }
        finally {
            if($fhOp) {
                fclose($fhOp);
            }
        }
    }

    /**
     * @inheritdoc
     */
    function getEvents() {

        // write in oplog
        $fhOplog = null;

        try {
            $fhOplog = fopen($this->path . '/oplog.log', 'r');

            // check if operation already exists
            while (($buffer = fgets($fhOplog)) !== false) {
                $eventId = trim($buffer);

                $op = file_get_contents($this->path . '/ops/' . $eventId . '.log');
                $op = unserialize($op);

                yield new Event($eventId, $op);
            }
        }
        finally {
            if($fhOplog) {
                fclose($fhOplog);
            }
        }
    }

    /**
     * @inheritdoc
     */
    function getEventsFrom($eventId) {
        $events = $this->getEvents();
        $eventMet = false;

        foreach($events as $event) {
            if($event->getEventId() == $eventId) {
                $eventMet = true;
            }

            if($eventMet) {
                yield $event;
            }
        }
    }
}
