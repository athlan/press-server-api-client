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

        $announcementParams = $this->extractParams($params);

        if(!isset($announcementParams['nazwa'])) {
            return null;
        }

        return new CategoryOperation(
            $operation,
            $announcementParams['id'],
            $announcementParams['id_nadkategorii'],
            $announcementParams['nazwa'],
            $announcementParams['lp'],
            $announcementParams
        );
    }

    private function extractParams($params) {
        return unserialize(base64_decode($params));
    }
}
