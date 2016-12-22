<?php

namespace PressServerApi\Callback\Operation\Factory;

use PressServerApi\Callback\OperationInterface;

interface OperationFactoryInterface {

    /**
     * @param string $operation
     * @param mixed $params
     * @return OperationInterface|null
     */
    public function createOperation($operation, $params);
}
