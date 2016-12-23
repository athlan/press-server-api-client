<?php

namespace PressServerApi\Callback\Operation;

use PressServerApi\Callback\OperationInterface;

class UnknownOperation implements OperationInterface {

    /**
     * @var string
     */
    private $operationKey;

    /**
     * @var string
     */
    private $rawdata;

    function __construct($operationKey, $rawdata) {
        $this->operationKey = $operationKey;
        $this->rawdata = $rawdata;
    }


    /**
     * @return string
     */
    public function getOperationKey() {
        return $this->operationKey;
    }

    /**
     * @return string
     */
    public function getRawdata() {
        return $this->rawdata;
    }
}
