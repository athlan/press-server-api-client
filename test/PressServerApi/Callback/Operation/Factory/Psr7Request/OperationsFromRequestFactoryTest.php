<?php

namespace PressServerApi\Callback\Operation\Factory\Psr7Request;

use PressServerApi\Callback\Operation\Factory\AnnouncementOperationFactory;
use PressServerApi\Callback\Operation\Factory\OperationFactoryInterface;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Psr7;

class CreateRequest extends TestCase
{
    /**
     * @var OperationsFromRequestFactory
     */
    private $operationsFromRequestFactory;

    /**
     * @before
     */
    public function init_factory()
    {
        /* @var $factories OperationFactoryInterface[] */
        $factories = [
            new AnnouncementOperationFactory()
        ];

        $this->operationsFromRequestFactory = new OperationsFromRequestFactory($factories);
    }

    /**
     * @test
     */
    public function factory_should_create_operations_from_request()
    {
        $body = file_get_contents("test/resources/requests/announements-update-raw.txt");

        $request = Psr7\parse_request($body);

        $operations = $this->operationsFromRequestFactory->createOperations($request);
        $operation1 = current($operations);

        $this->assertGreaterThanOrEqual(1, count($operations), "Should be one or more operations.");
        $this->assertInstanceOf("PressServerApi\\Callback\\Operation\\AnnouncementOperation", $operation1, "First operation hould be add an announcement.");
    }
}