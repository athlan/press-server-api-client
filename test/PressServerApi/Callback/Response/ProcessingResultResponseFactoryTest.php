<?php

namespace PressServerApi\Callback;

use GuzzleHttp\Psr7;
use PHPUnit\Framework\TestCase;
use PressServerApi\Callback\Operation\UnknownOperation;
use PressServerApi\Callback\Response\ProcessingResultResponseFactory;

class ProcessingResultResponseFactoryTest extends TestCase {

    /**
     * @var ProcessingResultResponseFactory
     */
    private $factory;

    /**
     * @before
     */
    public function init_factory()
    {
        $this->factory = new ProcessingResultResponseFactory();
    }

    /**
     * @test
     */
    public function should_transform_operations_with_messages()
    {
        $resultGroup = new OperationGroupProcessingResult();

        $operation = new UnknownOperation("operation_0", "data");
        $result = OperationProcessingResult::createResultFailure($operation, "processing message 0");
        $resultGroup->addResult($result);

        $operation = new UnknownOperation("operation_1", "data");
        $result = OperationProcessingResult::createResultSuccess($operation, "processing message 1");
        $resultGroup->addResult($result);

        $operation = new UnknownOperation("operation_2", "data");
        $result = OperationProcessingResult::createResultFailure($operation, "processing message 2");
        $resultGroup->addResult($result);

        $content = serialize([
            "operation_0" => "processing message 0",
            "operation_1" => "ok",
            "operation_2" => "processing message 2",
        ]);
        $content = base64_encode($content);
        $content = "STREAM-START:" . $content . ":STREAM-STOP";

        $this->assertEquals($content, $this->factory->createProcessingResultResponse($resultGroup));
    }
}
