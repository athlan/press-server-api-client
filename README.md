# PressServer API Client

![travis](https://img.shields.io/travis/athlan/press-server-api-client/master.svg)
![license](https://img.shields.io/packagist/l/athlan/press-server-api-client.svg)
![version](https://img.shields.io/packagist/v/athlan/press-server-api-client.svg)

This library allows you to receive callback request from [Press Server](http://www.press-server.pl/).

## Recommendations

* **Keep in mind that order of events matters.**
  Try to retreive operations, reverse it order and store/process in correct order because of occuring dependencies. For example an announcement add event depends on category creation event.

* **Store events localy for futher processing.**

  Try to retreive events data from Press Server and store them locally for futher processing to not cause Press Server wait for your    processing. Just store event content to your local event sotre (files, database) and process them in separate thread or in scheduled task (for example cron).
  
  The example with simple filestore is included in `/example` directory.

## Example usage

Example usage is in `/example` directory.

```php

use GuzzleHttp\Psr7\ServerRequest;
use PressServerApi\Callback\OperationInterface;
use PressServerApi\Callback\Operation\Factory\Psr7Request\OperationsFromRequestFactory;
use PressServerApi\Callback\Operation\Factory\OperationFactoryInterface;
use PressServerApi\Callback\Operation\Factory\AnnouncementOperationFactory;
use PressServerApi\Callback\Operation\Factory\AnnouncementDeleteOperationFactory;
use PressServerApi\Callback\Operation\Factory\CategoryOperationFactory;
use PressServerApi\Callback\Operation\Factory\CategoryDeleteOperationFactory;
use PressServerApi\Callback\Operation\Factory\UnknownOperationFactory;
use PressServerApi\Callback\OperationGroupProcessingResult;
use PressServerApi\Callback\OperationProcessingResult;
use PressServerApi\Callback\Response\ProcessingResultResponseFactory;
use PressServerApi\Callback\Response\Psr7Response\ProcessingResultResponseFactory as ProcessingResultPsr7ResponseFactory;

use Example\EventStore\Event;
use Example\EventStore\EventStoreInterface;
use Example\EventStore\SimpleFilesystemEventStore;
use Example\EventStore\Exception\EventAlreadyInStoreException;

use function QuimCalpe\ResponseSender\send AS send_response;

include 'vendor/autoload.php';
ini_set('always_populate_raw_post_data', -1);

// Step 1. Configure Context (components).
$responseFactory = new ProcessingResultResponseFactory();
$responseFactoryPsr7 = new ProcessingResultPsr7ResponseFactory($responseFactory);

/* @var $factories OperationFactoryInterface[] */
$factories = [
    new AnnouncementOperationFactory(),
    new AnnouncementDeleteOperationFactory(),
    new CategoryOperationFactory(),
    new CategoryDeleteOperationFactory(),
    new UnknownOperationFactory(),
];

$operationsFromRequestFactory = new OperationsFromRequestFactory($factories);

// Step 2. Receive HTTP Request and get operations.
$request = ServerRequest::fromGlobals();

// validate
if($request->getMethod() != "POST") {
    return send_response(new \GuzzleHttp\Psr7\Response(401));
}

/* @var $eventStore EventStoreInterface */
$eventStore = new SimpleFilesystemEventStore('./eventstore');

/* @var $operations OperationInterface[] */
$operations = $operationsFromRequestFactory->createOperations($request);
$operations = array_reverse($operations);

$results = new OperationGroupProcessingResult();

foreach($operations as $operation) {
    // TODO process operation here...
    // here there is storing events for further processing, which is recommended way
    // to fast and reliable retrieve events from 3rd party callback
    try {
        $eventStore->store(new Event($operation->getOperationKey(), $operation));
    }
    catch(EventAlreadyInStoreException $e) {
    }

    // after processing, create the OperarionProcessingResult (success or failure)
    $result = OperationProcessingResult::createResultSuccess($operation);
    $results->addResult($result);
}

// Step 3. Prepare response.
$response = $responseFactoryPsr7->createProcessingResultResponse($results);

// Step 4. Send response.
return send_response($response);

```
