<?php

use Example\EventStore\Event;
use Example\EventStore\EventStoreInterface;
use Example\EventStore\SimpleFilesystemEventStore;

include 'vendor/autoload.php';

/* @var $eventStore EventStoreInterface */
$eventStore = new SimpleFilesystemEventStore('./eventstore');

$events = $eventStore->getEvents();

/* @var $event Event */
foreach($events as $event) {
    var_dump($event->getEvent());
}
