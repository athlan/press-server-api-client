<?php

namespace PressServerApi\Callback\Operation\Factory;

use PressServerApi\Callback\Operation\UnknownOperation;
use PressServerApi\Callback\OperationInterface;

class UnknownOperationFactory implements OperationFactoryInterface {

    /**
     * @param string $operation
     * @param mixed $params
     * @return OperationInterface|null
     */
    public function createOperation($operation, $params)
    {
        return new UnknownOperation(
            $operation,
            $params
        );
    }
}
