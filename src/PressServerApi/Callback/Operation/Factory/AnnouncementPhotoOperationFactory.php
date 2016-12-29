<?php

namespace PressServerApi\Callback\Operation\Factory;

use PressServerApi\Callback\Operation\AnnouncementPhotoOperation;
use PressServerApi\Callback\OperationInterface;

class AnnouncementPhotoOperationFactory implements OperationFactoryInterface {

    /**
     * @param string $operation
     * @param mixed $params
     * @return OperationInterface|null
     */
    public function createOperation($operation, $params)
    {
        if(!preg_match('/^foto_([0-9]+)$/', $operation, $matches)) {
            return null;
        }

        $photoPath = $this->extractParams($params);
        if(!preg_match('/(.+)\.(.+)/', basename($photoPath), $matches)) {
            return null;
        }

        $id = (int) $matches[1];

        return new AnnouncementPhotoOperation(
            $operation,
            $photoPath,
            $id,
            []
        );
    }

    private function extractParams($params) {
        return base64_decode($params);
    }
}
