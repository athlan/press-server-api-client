<?php

namespace PressServerApi\Callback\Operation\Factory;

use PressServerApi\Callback\Operation\CategoryOperation;
use PressServerApi\Callback\OperationInterface;

class CategoryOperationFactory implements OperationFactoryInterface {

    /**
     * @param string $operation
     * @param mixed $params
     * @return OperationInterface|null
     */
    public function createOperation($operation, $params)
    {
        if(!preg_match('/^kategoria_([0-9]+)$/', $operation, $matches)) {
            return null;
        }

        $operationParams = $this->extractParams($params);

        return new CategoryOperation(
            $operation,
            $operationParams['id'],
            $operationParams['id_nadkategorii'],
            $operationParams['nazwa'],
            $operationParams['lp'],
            $operationParams
        );
    }

    private function extractParams($params) {
        return unserialize(base64_decode($params));
    }
}
