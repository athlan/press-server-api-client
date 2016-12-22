<?php

namespace PressServerApi\Callback\Operation\Factory;

use PressServerApi\Callback\Operation\AnnouncementDeleteOperation;
use PressServerApi\Callback\OperationInterface;

class AnnouncementDeleteOperationFactory implements OperationFactoryInterface {

    /**
     * @param string $operation
     * @param mixed $params
     * @return OperationInterface|null
     */
    public function createOperation($operation, $params)
    {
        if(!preg_match('/^delete_([0-9]+)$/', $operation, $matches)) {
            return null;
        }

        $announcementId = $this->extractParams($params);

        return new AnnouncementDeleteOperation(
            $operation,
            $announcementId,
            []
        );
    }

    private function extractParams($params) {
        return base64_decode($params);
    }
}
