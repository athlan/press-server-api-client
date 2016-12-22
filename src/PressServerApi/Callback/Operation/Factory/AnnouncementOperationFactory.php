<?php

namespace PressServerApi\Callback\Operation\Factory;

use PressServerApi\Callback\Operation\AnnouncementOperation;
use PressServerApi\Callback\OperationInterface;

class AnnouncementOperationFactory implements OperationFactoryInterface {

    /**
     * @param string $operation
     * @param mixed $params
     * @return OperationInterface|null
     */
    public function createOperation($operation, $params)
    {
        if(!preg_match('/^ogloszenie_([0-9]+)$/', $operation, $matches)) {
            return null;
        }

        $id = $matches[1];
        $announcementParams = $this->extractParams($params);

        var_dump($id, $announcementParams);

        return new AnnouncementOperation();
    }

    private function extractParams($params) {
        return unserialize(base64_decode($params));
    }
}
