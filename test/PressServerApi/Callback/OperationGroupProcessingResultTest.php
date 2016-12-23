<?php

namespace PressServerApi\Callback;

use GuzzleHttp\Psr7;
use PHPUnit\Framework\TestCase;
use PressServerApi\Callback\Operation\UnknownOperation;

class OperationGroupProcessingResultTest extends TestCase {

    /**
     * @test
     */
    public function should_store_empty_stack()
    {
        $resultGroup = new OperationGroupProcessingResult();

        $this->assertCount(0, $resultGroup->getResults());
    }

    /**
     * @test
     */
    public function should_store_items_in_stack()
    {
        $operation = new UnknownOperation("op", "data");
        $result = OperationProcessingResult::createResultSuccess($operation);
        $resultGroup = new OperationGroupProcessingResult();

        $resultGroup->addResult($result);

        $this->assertCount(1, $resultGroup->getResults());
        $this->assertEquals($result, $resultGroup->getResults()[0]);
    }
}