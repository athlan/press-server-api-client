<?php

namespace PressServerApi\Callback\Operation\Factory\Psr7Request;

use PressServerApi\Callback\Operation\Factory\AnnouncementOperationFactory;
use PressServerApi\Callback\Operation\Factory\AnnouncementDeleteOperationFactory;
use PressServerApi\Callback\Operation\Factory\CategoryDeleteOperationFactory;
use PressServerApi\Callback\Operation\Factory\CategoryOperationFactory;
use PressServerApi\Callback\Operation\Factory\OperationFactoryInterface;
use PressServerApi\Callback\Operation\Factory\UnknownOperationFactory;
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
            new AnnouncementOperationFactory(),
            new AnnouncementDeleteOperationFactory(),
            new CategoryOperationFactory(),
            new CategoryDeleteOperationFactory(),
            new UnknownOperationFactory(),
        ];

        $this->operationsFromRequestFactory = new OperationsFromRequestFactory($factories);
    }

    /**
     * @test
     */
    public function factory_should_create_unknown_operation_from_request()
    {
        $body = file_get_contents("test/resources/requests/unknown-raw.txt");

        $request = Psr7\parse_request($body);

        $operations = $this->operationsFromRequestFactory->createOperations($request);
        $operation1 = current($operations);

        $this->assertGreaterThanOrEqual(1, count($operations), "Should be one or more operations.");
        $this->assertInstanceOf("PressServerApi\\Callback\\Operation\\UnknownOperation", $operation1, "First operation hould be add an announcement.");
    }

    /**
     * @test
     */
    public function factory_should_create_announcement_operation_from_request()
    {
        $body = file_get_contents("test/resources/requests/announements-update-raw.txt");

        $request = Psr7\parse_request($body);

        $operations = $this->operationsFromRequestFactory->createOperations($request);
        $operation1 = current($operations);

        $this->assertGreaterThanOrEqual(1, count($operations), "Should be one or more operations.");
        $this->assertInstanceOf("PressServerApi\\Callback\\Operation\\AnnouncementOperation", $operation1, "First operation hould be add an announcement.");
    }

    /**
     * @test
     */
    public function factory_should_create_announcement_delete_operation_from_request()
    {
        $body = file_get_contents("test/resources/requests/announements-delete-raw.txt");

        $request = Psr7\parse_request($body);

        $operations = $this->operationsFromRequestFactory->createOperations($request);
        $operation1 = current($operations);

        $this->assertGreaterThanOrEqual(1, count($operations), "Should be one or more operations.");
        $this->assertInstanceOf("PressServerApi\\Callback\\Operation\\AnnouncementDeleteOperation", $operation1, "First operation hould be add an announcement.");
    }

    /**
     * @test
     */
    public function factory_should_create_category_operation_from_request()
    {
        $body = file_get_contents("test/resources/requests/categories-update-raw.txt");

        $request = Psr7\parse_request($body);

        $operations = $this->operationsFromRequestFactory->createOperations($request);
        $operation1 = current($operations);

        $this->assertGreaterThanOrEqual(1, count($operations), "Should be one or more operations.");
        $this->assertInstanceOf("PressServerApi\\Callback\\Operation\\CategoryOperation", $operation1, "First operation hould be add an announcement.");
    }

    /**
     * @test
     */
    public function factory_should_create_category_delete_operation_from_request()
    {
        $body = file_get_contents("test/resources/requests/categories-delete-raw.txt");

        $request = Psr7\parse_request($body);

        $operations = $this->operationsFromRequestFactory->createOperations($request);
        $operation1 = current($operations);

        $this->assertGreaterThanOrEqual(1, count($operations), "Should be one or more operations.");
        $this->assertInstanceOf("PressServerApi\\Callback\\Operation\\CategoryDeleteOperation", $operation1, "First operation hould be add an announcement.");
    }

}
