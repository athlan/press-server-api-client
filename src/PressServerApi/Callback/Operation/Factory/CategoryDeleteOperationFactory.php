<?php

namespace PressServerApi\Callback\Operation\Factory;

use PressServerApi\Callback\Operation\CategoryDeleteOperation;
use PressServerApi\Callback\OperationInterface;

class CategoryDeleteOperationFactory implements OperationFactoryInterface {

    /**
     * @param string $operation
     * @param mixed $params
     * @return OperationInterface|null
     */
    public function createOperation($operation, $params)
    {
        if(!preg_match('/^kategoria_usun_([0-9]+)$/', $operation, $matches)) {
            return null;
        }

        $operationParams = $this->extractParams($params);

        return new CategoryDeleteOperation(
            $operation,
            $operationParams['id'],
            []
        );
    }

    private function extractParams($params) {
        return unserialize(base64_decode($params));
    }
}
