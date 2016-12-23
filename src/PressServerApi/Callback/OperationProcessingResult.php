<?php

namespace PressServerApi\Callback;

class OperationProcessingResult {

    /**
     * @var OperationInterface
     */
    private $operation;

    /**
     * @var boolean
     */
    private $success;

    /**
     * @var string
     */
    private $message;

    private function __construct(OperationInterface $operation, $isSuccess, $message = null) {
        $this->operation = $operation;
        $this->success = $isSuccess;
        $this->message = $message;
    }

    public static function createResultSuccess(OperationInterface $operation, $message = null) {
        return new OperationProcessingResult($operation, true, $message);
    }

    public static function createResultFailure(OperationInterface $operation, $message = null) {
        return new OperationProcessingResult($operation, false, $message);
    }

    /**
     * @return OperationInterface
     */
    public function getOperation() {
        return $this->operation;
    }

    /**
     * @return boolean
     */
    public function isSuccess() {
        return $this->success;
    }

    /**
     * @return string
     */
    public function getMessage() {
        return $this->message;
    }
}
