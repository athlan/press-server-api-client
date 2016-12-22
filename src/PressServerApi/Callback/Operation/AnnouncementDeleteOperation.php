<?php

namespace PressServerApi\Callback\Operation;

use PressServerApi\Callback\OperationInterface;

class AnnouncementDeleteOperation implements OperationInterface {

    /**
     * @var string
     */
    private $operationKey;

    /**
     * @var int
     */
    private $id;

    /**
     * @var array
     */
    private $rawdata;

    public function __construct($operationKey, $id, array $rawdata) {
        $this->operationKey = $operationKey;
        $this->id = $id;
        $this->rawdata = $rawdata;
    }

    /**
     * @return string
     */
    public function getOperationKey() {
        return $this->operationKey;
    }

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return array
     */
    public function getRawdata() {
        return $this->rawdata;
    }
}
