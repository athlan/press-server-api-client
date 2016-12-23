<?php

namespace PressServerApi\Callback;

use GuzzleHttp\Psr7;
use PHPUnit\Framework\TestCase;
use PressServerApi\Callback\Operation\UnknownOperation;

class OperationProcessingResultTest extends TestCase {

    /**
     * @test
     */
    public function should_create_success_result()
    {
        $operation = new UnknownOperation("op", "data");
        $result = OperationProcessingResult::createResultSuccess($operation);

        $this->assertTrue($result->isSuccess());
        $this->assertEquals(null, $result->getMessage());
        $this->assertEquals($operation, $result->getOperation());
    }

    /**
     * @test
     */
    public function should_create_success_result_with_message()
    {
        $operation = new UnknownOperation("op", "data");
        $result = OperationProcessingResult::createResultSuccess($operation, "some message");

        $this->assertTrue($result->isSuccess());
        $this->assertEquals("some message", $result->getMessage());
        $this->assertEquals($operation, $result->getOperation());
    }

    /**
     * @test
     */
    public function should_create_failure_result()
    {
        $operation = new UnknownOperation("op", "data");
        $result = OperationProcessingResult::createResultFailure($operation);

        $this->assertFalse($result->isSuccess());
        $this->assertEquals(null, $result->getMessage());
        $this->assertEquals($operation, $result->getOperation());
    }

    /**
     * @test
     */
    public function should_create_failure_result_with_message()
    {
        $operation = new UnknownOperation("op", "data");
        $result = OperationProcessingResult::createResultFailure($operation, "some message");

        $this->assertFalse($result->isSuccess());
        $this->assertEquals("some message", $result->getMessage());
        $this->assertEquals($operation, $result->getOperation());
    }
}