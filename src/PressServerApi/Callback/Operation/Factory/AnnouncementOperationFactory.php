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

        $announcementParams = $this->extractParams($params);

        return new AnnouncementOperation(
            $operation,
            $announcementParams['id'],
            \DateTimeImmutable::createFromFormat("U", $announcementParams['data_start']),
            \DateTimeImmutable::createFromFormat("U", $announcementParams['data_stop']),
            $announcementParams['kategoria'],
            $announcementParams['tresc'],
            $announcementParams
        );
    }

    private function extractParams($params) {
        return unserialize(base64_decode($params));
    }
}
