<?php

namespace PressServerApi\Callback\Operation\Factory;

use PressServerApi\Callback\Operation\AnnouncementPhotoDeleteOperation;
use PressServerApi\Callback\OperationInterface;

class AnnouncementPhotoDeleteOperationFactory implements OperationFactoryInterface {

    /**
     * @param string $operation
     * @param mixed $params
     * @return OperationInterface|null
     */
    public function createOperation($operation, $params)
    {
        if(!preg_match('/^fotodel_([0-9]+)$/', $operation, $matches)) {
            return null;
        }

        $id = $this->extractParams($params);

        return new AnnouncementPhotoDeleteOperation(
            $operation,
            $id,
            []
        );
    }

    private function extractParams($params) {
        return base64_decode($params);
    }
}
